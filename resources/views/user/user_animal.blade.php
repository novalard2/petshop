@extends('layouts.landing_page')

@section('content')
<div class="animal-container">
    <h2 class="title">Hewan Saya</h2>   
    <div class="animal-grid">
        @forelse($data as $animal)
            <div class="animal-card">
                <div class="animal-header">
                    <h3>Nama Hewan : {{ $animal->name }}</h3>
                    <span>Jenis Hewan : {{ $animal->type->name }}</span>
                </div>
                <div class="animal-body">
                    <p><strong>Tanggal Lahir</strong><br>{{ $animal->tgl_lahir }}</p>
                    <p><strong>Jenis Kelamin</strong><br>{{ ucfirst($animal->jenis_kelamin) }}</p>
                </div>
                <div class="user-animal-action">
                    <a href="{{ route('user.animal.edit',$animal->id) }}"
                        class="user-animal-btn-edit">
                        <i class="bi bi-pencil-square"></i>
                        Edit
                    </a>
                    <form action="{{ route('user.animal.delete',$animal->id) }}"
                        method="POST"
                        class="delete-animal-form">
                        @csrf
                        @method('DELETE')
                        <button class="user-animal-btn-delete">
                            <i class="bi bi-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-animal">
                <h4>Belum ada hewan</h4>
                <p>Silakan daftarkan hewan peliharaanmu terlebih dahulu.</p>
            </div>
        @endforelse
        <div class="text-center mt-4">
            <a href="{{ route('user.animal.form') }}" class="btn-add-animal">
                <i class="fa-solid fa-plus"></i>
                Tambah Hewan
            </a>
        </div>
    </div>
</div>
    <script>
        document.querySelectorAll('.delete-animal-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Hewan?',
                    text: 'Data hewan yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if(result.isConfirmed){
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection