@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">
                Detail Order
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="180">Invoice</th>
                            <td>{{ $order->invoice }}</td>
                        </tr>
                        <tr>
                            <th>Nama Customer</th>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $order->user->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>
                                Rp {{ number_format($order->total,0,',','.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Pembayaran</th>
                            <td>
                                @if($order->payment_status=="paid")
                                    <span class="badge badge-success">
                                        Paid
                                    </span>
                                @elseif($order->payment_status=="pending")
                                    <span class="badge badge-warning">
                                        Pending
                                    </span>
                                @elseif($order->payment_status=="failed")
                                    <span class="badge badge-danger">
                                        Failed
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        Expired
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <h4>Produk</h4>
            <table class="table table-bordered">
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
            <hr>
            <form action="{{ route('admin.order.update',$order->id) }}"
                method="POST">
                @csrf
                <div class="form-group">
                    <label>Status Pesanan</label>
                    <select
                        name="order_status"
                        class="form-control">
                        <option
                            value="diproses"
                            {{ $order->order_status=="diproses" ? 'selected':'' }}>
                            Diproses
                        </option>
                        <option
                            value="siap_dikirim"
                            {{ $order->order_status=="siap_dikirim" ? 'selected':'' }}>
                            Siap Dikirim
                        </option>
                        <option
                            value="dikirim"
                            {{ $order->order_status=="dikirim" ? 'selected':'' }}>
                            Dikirim
                        </option>
                        <option
                            value="selesai"
                            {{ $order->order_status=="selesai" ? 'selected':'' }}>
                            Selesai
                        </option>
                        <option
                            value="dibatalkan"
                            {{ $order->order_status=="dibatalkan" ? 'selected':'' }}>
                            Dibatalkan
                        </option>
                    </select>
                </div>
                <div class="form-group mt-3" id="kurir-group" style="{{ $order->order_status == 'siap_dikirim' ? '' : 'display:none;' }}">
                    <label>Pilih Kurir</label>

                    <select name="employee_id" class="form-control">
                        <option value="">-- Pilih Kurir --</option>

                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ $order->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success mt-3">
                    Simpan Status
                </button>
                <a href="{{ route('admin.order.index') }}"
                    class="btn btn-secondary mt-3">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const status = document.querySelector('[name="order_status"]');
            const kurir = document.getElementById('kurir-group');

            function toggleKurir() {
                if (status.value === 'siap_dikirim') {
                    kurir.style.display = 'block';
                } else {
                    kurir.style.display = 'none';
                }
            }

            toggleKurir();

            status.addEventListener('change', toggleKurir);

        });
    </script>
@endsection