@extends('layouts.nice')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">
                <i class="fas fa-shopping-bag"></i>
                Master Order
            </h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Data Order
            </h3>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table id="datatable" class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th width="50">No</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Alamat</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status Order</th>
                        <th>Tanggal</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $key => $order)
                    <tr>
                        <td>
                            {{ $key+1 }}
                        </td>
                        <td>
                            {{ $order->invoice }}
                        </td>
                        <td>
                            {{ $order->user->name }}
                        </td>
                        <td>
                            {{ $order->user->alamat }}
                        </td>
                        <td>
                            Rp {{ number_format($order->total,0,',','.') }}
                        </td>
                        <td>

                            @if($order->payment_status=='paid')
                                <span class="badge badge-success">
                                    Paid
                                </span>
                            @elseif($order->payment_status=='pending')
                                <span class="badge badge-warning">
                                    Pending
                                </span>
                            @elseif($order->payment_status=='failed')
                                <span class="badge badge-danger">
                                    Failed
                                </span>
                            @elseif($order->payment_status=='expired')
                                <span class="badge badge-secondary">
                                    Expired
                                </span>
                            @endif
                        </td>

                        <td>
                            @switch($order->order_status)
                                @case('diproses')
                                    <span class="badge badge-info">
                                        Diproses
                                    </span>
                                    @break
                                @case('siap_dikirim')
                                    <span class="badge badge-primary">
                                        Siap Dikirim
                                    </span>
                                    @break
                                @case('dikirim')
                                    <span class="badge badge-warning">
                                        Dikirim
                                    </span>
                                    @break
                                @case('selesai')
                                    <span class="badge badge-success">
                                        Selesai
                                    </span>
                                    @break
                                @case('dibatalkan')
                                    <span class="badge badge-danger">
                                        Dibatalkan
                                    </span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            {{ $order->created_at->format('d M Y H:i') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.order.show', $order->id) }}"
                                class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(in_array($order->payment_status,['failed','expired']))
                                <form action="{{ route('admin.order.delete',$order->id) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus order ini?')">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection