@extends('layouts.landing_page')

@section('content')

<div class="payment-page">
    <div class="payment-wrapper">
        <div class="payment-card">
            <div class="payment-header">
                <h2>Checkout Pembayaran</h2>
                <p>Silakan periksa kembali pesanan sebelum melakukan pembayaran.</p>
            </div>
            <div class="payment-content">
                <div class="payment-info">
                    <div class="payment-item">
                        <span>Invoice</span>
                        <strong>{{ $order->invoice }}</strong>
                    </div>

                    <div class="payment-item">
                        <span>Nama</span>
                        <strong>{{ $order->user->name }}</strong>
                    </div>

                    <div class="payment-item">
                        <span>Email</span>
                        <strong>{{ $order->user->email }}</strong>
                    </div>
                </div>

                <div class="payment-product mt-4">
                    <h5>Daftar Produk</h5>
                    <table class="table payment-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($order->details as $detail)
                            <tr>
                                <td>{{ $detail->product->nama_product }}</td>
                                <td>
                                    Rp {{ number_format($detail->price,0,',','.') }}
                                </td>
                                <td>{{ $detail->qty }}</td>
                                <td>
                                    Rp {{ number_format($detail->subtotal,0,',','.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="payment-total">
                    <span>Total Pembayaran</span>
                    <strong>
                        Rp {{ number_format($order->total,0,',','.') }}
                    </strong>
                </div>

                <button id="pay-button" class="pay-now-btn">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
document.getElementById('pay-button').onclick=function(){
    snap.pay('{{ $snapToken }}',{
        onSuccess:function(result){

            window.location='{{ route("orders.index") }}';
        },
        onPending:function(result){

            console.log(result);
        },
        onError:function(result){

            alert('Pembayaran gagal');
        },
        onClose:function(){

            alert('Pembayaran belum diselesaikan.');
        }
    });
}
</script>
@endsection