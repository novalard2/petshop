@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-paw me-2"></i>
                    Master Animal
                </h3>
                <small>Kelola seluruh data hewan pelanggan.</small>
            </div>
            <a href="{{ route('animal.form') }}" class="btn btn-light">
                <i class="bi bi-plus-square-fill"></i>
                Tambah Animal
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="70">No</th>
                            <th>Pemilik</th>
                            <th>Nama Hewan</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Hewan</th>
                            <th>Jenis Kelamin</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($data as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">
                                {{ $value->user->name }}
                            </td>
                            <td>
                                {{ $value->name }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($value->tgl_lahir)->format('d M Y') }}
                            </td>
                            <td>
                                {{ $value->type->name ?? '-' }}
                            </td>
                            <td>
                                @if(strtolower(trim($value->jenis_kelamin)) === 'jantan')
                                    <span class="badge bg-primary text-white">
                                        Jantan
                                    </span>
                                @else
                                    <span class="badge bg-danger text-white">
                                        Betina
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('animal.form',$value->id) }}"
                                       class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('animal.delete',$value->id) }}"
                                          method="POST"
                                          class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            onclick="return confirm('Yakin ingin menghapus data hewan ini?')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-paw fa-3x text-secondary mb-3"></i>
                                <h5>Belum ada data hewan.</h5>
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