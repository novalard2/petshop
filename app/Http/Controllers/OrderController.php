<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Midtrans\Notification;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }
        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['qty'];
        });
        return view('order.checkout', compact('cart', 'total'));
    }

    public function proses()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong.');
        }

        // Cek apakah masih ada order yang status pending
        $pendingOrder = Order::where('user_id', Auth::id())
            ->where('payment_status', 'pending')
            ->latest()
            ->first();

        if ($pendingOrder) {
            return redirect()
                ->route('orders.payment', $pendingOrder->invoice)
                ->with('warning', 'Masih ada pembayaran yang belum diselesaikan.');
        }

        // CEK STOK PRODUK
        foreach ($cart as $productId => $item) {

            $product = Product::find($productId);

            if (!$product) {
                return redirect()->route('cart.index')
                    ->with('error', 'Produk tidak ditemukan.');
            }

            if ($product->stok < $item['qty']) {
                return redirect()->route('cart.index')
                    ->with(
                        'error',
                        "Stok {$product->nama_product} tidak mencukupi. Sisa stok: {$product->stok}"
                    );
            }
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['qty'];
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice' => 'INV-' . time(),
            'total' => $total,
            'payment_status' => 'pending',
            'order_status' => 'diproses',
        ]);

        foreach ($cart as $productId => $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'qty' => $item['qty'],
                'price' => $item['harga'],
                'subtotal' => $item['qty'] * $item['harga'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.payment', $order->invoice)
            ->with('success', 'Order berhasil dibuat.');
    }

    public function payment($invoice)
    {
        $order = Order::with(['user','details.product'])
            ->where('invoice', $invoice)
            ->firstOrFail();

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        if (!$order->snap_token) {

            $params = [
                'transaction_details' => [
                    'order_id' => $order->invoice,
                    'gross_amount' => $order->total,
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->user->no_hp,
                ],
            ];

            $order->snap_token = \Midtrans\Snap::getSnapToken($params);
            $order->save();
        }

        return view('order.payment',[
            'order'=>$order,
            'snapToken'=>$order->snap_token
        ]);
    }

    public function show($invoice)
    {
       $order = Order::with([
            'user',
            'details.product',
            'employee'
        ])
        ->where('invoice', $invoice)
        ->firstOrFail();

        return view('order.show',compact('order'));
    }

    
    public function callback(Request $request)
    {
        Log::info('CALLBACK MASUK');
        Log::info($request->all());

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $orderId = $notification->order_id;

        $order = Order::with('details')->where('invoice', $orderId)->first();

        if (!$order) {
            return response()->json([
                'message' => 'Order tidak ditemukan'
            ], 404);
        }
        switch ($transaction) {
            case 'settlement':
            // Kurangi stok hanya jika baru pertama kali dibayar
            if ($order->payment_status != 'paid') {
                foreach ($order->details as $detail) {
                    $product = Product::find($detail->product_id);
                    if ($product && $product->stok >= $detail->qty) 
                    {
                        $product->decrement('stok', $detail->qty);
                    }
                }
            }
            $order->payment_status = 'paid';
            break;
            case 'pending':
                $order->payment_status = 'pending';
                break;
            case 'expire':
                $order->payment_status = 'expired';
                break;
            case 'cancel':
            case 'deny':
                $order->payment_status = 'failed';
                break;
        }

        $order->save();

        Log::info('STATUS ORDER DIUPDATE: '.$order->payment_status);
        return response()->json(['success' => true]);
    }
    
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('order.index', compact('orders'));
    }

    public function adminIndex()
    {
        $orders = Order::with('user')
            ->latest()
            ->get();
        return view('pages.dashboard.master_order.index', compact('orders'));
    }

    public function adminShow($id)
    {
       $order = Order::with(['user','details.product','employee'])
                ->findOrFail($id);

        $employees = Employee::where('jabatan', 'kurir')->get();

        return view('pages.dashboard.master_order.show', compact(
            'order',
            'employees'
        ));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('pages.dashboard.master_order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'order_status' => 'required',
        'employee_id' => 'nullable|exists:employees,id'
        ]);

        // Jika status dikirim tapi belum pilih kurir
        if ($request->order_status == 'siap_dikirim' && empty($request->employee_id)) {
            return back()
                ->withInput()
                ->with('error', 'Silakan pilih kurir terlebih dahulu.');
        }

        $order = Order::findOrFail($id);

        $order->update([
            'order_status' => $request->order_status,
            'employee_id' => $request->employee_id
        ]);

        return redirect()
            ->route('admin.order.index')
            ->with('success', 'Status berhasil diubah.');
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);

        if (!in_array($order->payment_status, ['failed', 'expired'])) {
            return back()->with('error', 'Order ini tidak dapat dihapus.');
        }

        $order->details()->delete();
        $order->delete();

        return back()->with('success', 'Order berhasil dihapus.');
    }
    
}
