@extends('layouts.nice')

@section('content')
    <div class="container mt-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">
                    <i class="bi bi-box-seam-fill me-2"></i>
                    {{ $data ? 'Edit Product' : 'Tambah Product' }}
                </h3>
                <small>
                    Lengkapi data produk dengan benar.
                </small>
            </div>
            <div class="card-body">
                <h4 class="text-md">Form Product</h4>
                <form action="{{ $data ==null ? route('product.tambah'):route('product.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($data !== null)
                    <div class="mb-3">
                        <label for="id" class="form-label">id Product</label>
                        <input type="text" name="id_product" class="form-control" id="nama_product" value="{{ $data->id??'' }}" readonly placeholder="Masukan Nama">
                    </div>

                     @endif
                    <div class="mb-3">
                        <label for="nama_product" class="form-label">Nama Product</label>
                        <input type="text" name="nama_product" class="form-control" id="nama_product" value="{{ $data->nama_product??'' }}" placeholder="Masukan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Pilih Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Pilih Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $data && $data->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" id="harga" value="{{ $data->harga??'' }}" placeholder="Masukan Harga">
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{ $data->stok??'' }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description"  id="description" rows="3">{{ $data->description??'' }}</textarea>
                    </div>
                    <div class="mb-3">
                        @if(!empty($data->foto))
                            <p>Foto saat ini: {{ $data->foto }}</p>
                        @endif

                        <input class="form-control"
                            type="file"
                            name="foto">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Jenis Product</label>
                        <select name="jenis" class="form-control">
                            <option value="">Pilih jenis</option>
                            <option value="store" {{ ($data->jenis ?? '') == 'store' ? 'selected' : '' }}>Store</option>
                            <option value="grooming" {{ ($data->jenis ?? '') == 'grooming' ? 'selected' : '' }}>Grooming</option>
                            <option value="hotel" {{ ($data->jenis ?? '') == 'hotel' ? 'selected' : '' }}>Hotel</option>
                            <option value="medical" {{ ($data->jenis ?? '') == 'medical' ? 'selected' : '' }}>Medical</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection