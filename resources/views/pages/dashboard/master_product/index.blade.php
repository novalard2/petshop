@extends('layouts.nice')

@section('content')

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-box-open me-2"></i>
                    Master Product
                </h3>
                <small>Kelola seluruh data produk PetShop.</small>
            </div>
            <a href="{{ route('product.form') }}" class="btn btn-light">
                <i class="bi bi-plus-square-fill"></i>
                Tambah Product
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Produk</th>
                            <th>Category</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td width="110">
                                <img
                                    src="{{ asset('storage/product/'.$value->foto) }}"
                                    class="img-thumbnail"
                                    style="width:80px;height:80px;object-fit:cover;">
                            </td>
                            <td>
                                <strong>{{ $value->nama_product }}</strong>
                            </td>
                            <td class="fw-semibold text-secondary">
                                {{ $value->category->name ?? '-' }}
                            </td>
                            <td>
                                <strong class="text-success">
                                    Rp {{ number_format($value->harga,0,',','.') }}
                                </strong>
                            </td>
                            <td>
                            @if($value->stok > 10)
                                <span class="text-success fw-bold">
                                    {{ $value->stok }}
                                </span>
                            @elseif($value->stok > 0)
                                <span class="text-warning fw-bold">
                                    {{ $value->stok }}
                                </span>
                            @else
                                <span class="text-danger fw-bold">
                                    Habis
                                </span>
                            @endif
                        </td>
                            <td>
                                {{ $value->jenis }}
                            </td>
                            <td style="max-width:220px;">
                                {{ Str::limit($value->description,40) }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <a href="{{ route('product.form',$value->id) }}"
                                    class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('product.delete',$value->id) }}"
                                        method="POST" class="ms-3">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-secondary mb-3"></i>
                                <h5>Belum ada produk.</h5>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection