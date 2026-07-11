<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
    $cart = session()->get('cart', []);
    $total = collect($cart)->sum(function ($item) {
        return $item['harga'] * $item['qty'];
    });
    // dd(session('cart'));
    return view('pages/dashboard/master_cart/index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $user = Auth::user();
        if (empty($user->alamat) || empty($user->no_hp)) {
            return redirect()
                ->route('user.profile')
                ->with('error', 'Silakan lengkapi alamat dan nomor handphone terlebih dahulu sebelum berbelanja.');
        }

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
        } else {
            $cart[$product->id] = [
                'nama'   => $product->nama_product,
                'harga'  => $product->harga,
                'gambar' => $product->foto,
                'qty'    => 1
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        }
        session()->put('cart', $cart);
        return back();
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty']--;
            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
        }
        session()->put('cart', $cart);
        return back();
    }
}
