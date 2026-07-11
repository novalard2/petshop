@extends('layouts.landing_page')

@section('content')
<div class="order-page">
    <div class="container order-container">
        <div class="order-card">
            <div class="order-header">
                <h2>
                    <i class="bi bi-bag-check-fill"></i>
                    Pesanan Saya
                </h2>
                <p>Lihat seluruh riwayat pesanan dan status pembayarannya.</p>
            </div>
            @if($orders->count())
            <div class="table-responsive">
                <table class="table order-table align-middle">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <strong>{{ $order->invoice }}</strong>
                            </td>
                            <td>
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($order->total,0,',','.') }}
                            </td>

                            <td>
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
                            </td>

                            <td>
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

                                    @default
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                @endswitch
                            </td>

                            <td>
                                @if($order->payment_status == 'pending')
                                    <a href="{{ route('orders.payment', $order->invoice) }}" class="btn-detail">
                                        Lanjutkan Pembayaran
                                    </a>
                                @else
                                    <a href="{{ route('orders.show', $order->invoice) }}" class="btn-detail">
                                        Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-order">
                <i class="bi bi-bag-x"></i>
                <h3>Belum ada pesanan</h3>

                <p>Silahkan pilih produk favoritmu terlebih dahulu.</p>

                <a href="{{ route('store') }}" class="shop-btn">
                    Belanja Sekarang
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection