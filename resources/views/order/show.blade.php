@extends('layouts.landing_page')

@section('content')
<div class="order-detail-page">
    <div class="detail-wrapper">
        <div class="back-wrapper">
            <a href="{{ route('orders.index') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Riwayat Pesanan
            </a>
        </div>
        <div class="detail-card">
            <div class="detail-header">
                <h2>Detail Pesanan</h2>
                <p>{{ $order->invoice }}</p>
            </div>
            <div class="detail-content">
                <div class="row">
                    <!-- Informasi Pesanan -->
                    <div class="col-md-6">
                        <div class="info-box">
                            <h5>Informasi Pesanan</h5>
                            <div class="info-item">
                                <span>Invoice</span>
                                <strong>{{ $order->invoice }}</strong>
                            </div>
                            <div class="info-item">
                                <span>Total</span>
                                <strong class="text-primary">
                                    Rp {{ number_format($order->total,0,',','.') }}
                                </strong>
                            </div>
                            <div class="info-item">
                                <span>Pembayaran</span>
                                @if($order->payment_status=='paid')
                                    <span class="badge badge-paid">
                                        Sudah Dibayar
                                    </span>
                                @elseif($order->payment_status=='pending')
                                    <span class="badge badge-pending">
                                        Pending
                                    </span>
                                @elseif($order->payment_status=='failed')
                                    <span class="badge badge-failed">
                                        Gagal
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                @endif
                            </div>
                            <div class="info-item">
                                <span>Status Pesanan</span>
                                @switch($order->order_status)
                                    @case('diproses')
                                        <span class="badge badge-process">
                                            Diproses
                                        </span>
                                    @break
                                    @case('siap_dikirim')
                                        <span class="badge badge-send">
                                            Siap Dikirim
                                        </span>
                                    @break
                                    @case('dikirim')
                                        <span class="badge badge-shipping">
                                            Dikirim
                                        </span>
                                    @break
                                    @case('selesai')
                                        <span class="badge badge-finish">
                                            Selesai
                                        </span>
                                    @break
                                    @case('dibatalkan')
                                        <span class="badge bg-danger">
                                            Dibatalkan
                                        </span>
                                    @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Data Pemesan -->
                    <div class="col-md-6">
                        <div class="info-box">
                            <h5>Data Pemesan</h5>
                            <div class="info-item">
                                <span>Nama</span>
                                <strong>{{ $order->user->name }}</strong>
                            </div>
                            <div class="info-item">
                                <span>Email</span>
                                <strong>{{ $order->user->email }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Informasi Status -->
                <div class="info-box mt-4">
                    <h5>Informasi Status Pesanan</h5>
                    @switch($order->order_status)
                        @case('diproses')
                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-hourglass-split"></i>
                                Pesanan Anda sedang diproses oleh tim kami.
                            </div>
                        @break
                        @case('siap_dikirim')
                            <div class="alert alert-info mb-0">
                                <i class="bi bi-box-seam"></i>
                                Pesanan Anda sedang disiapkan untuk dikirim oleh tim kami.

                                @if($order->employee)
                                    <hr>
                                    <strong>Nama Kurir :</strong>
                                    {{ $order->employee->name }}
                                @endif
                            </div>
                        @break
                        @case('dikirim')
                            <div class="alert alert-primary mb-0">
                                <i class="bi bi-truck"></i>
                                Pesanan Anda sedang dikirim oleh tim ekspedisi.
                                <br>
                                Kami akan mengirimkan nomor resi melalui WhatsApp Anda.
                            </div>
                        @break
                        @case('selesai')
                            <div class="alert alert-success mb-0">
                                <i class="bi bi-check-circle-fill"></i>
                                Pesanan Anda telah selesai.
                                <br>
                                Terima kasih telah berbelanja di PetShop Kami.
                            </div>
                        @break
                        @case('dibatalkan')
                            <div class="alert alert-danger mb-0">
                                <i class="bi bi-x-circle-fill"></i>
                                Maaf, pesanan Anda dibatalkan.
                            </div>
                        @break
                    @endswitch
                </div>
                <br>
                <!-- Daftar Produk -->
                <div class="product-box mt-4">
                    <h5>Daftar Produk</h5>
                    <div class="table-responsive">
                        <table class="table order-table">
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
                                        <td>
                                            {{ $detail->product->nama_product }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($detail->price,0,',','.') }}
                                        </td>
                                        <td>
                                            {{ $detail->qty }}
                                        </td>
                                        <td class="fw-bold">
                                            Rp {{ number_format($detail->subtotal,0,',','.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection