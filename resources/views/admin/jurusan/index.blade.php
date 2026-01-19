@extends('layouts.app')

@section('title', 'Kelola Jurusan')

@section('content')
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-book"></i> Kelola Jurusan</h3>

    {{-- Statistics Cards --}}
    <div class="row g-4 mb-4" style="margin-left: -20px;">
        {{-- Total Jurusan --}}
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up">
                <div class="card-body text-center">
                    <i class="bi bi-book dashboard-icon text-primary"></i>
                    <h5 class="card-title mt-3">Total Jurusan</h5>
                    <p class="text-muted">{{ $jurusan->count() }} jurusan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Jurusan --}}
    <div class="card" data-aos="fade-up">
        <div class="card-header">
            <h5>Daftar Jurusan</h5>
            <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary">Tambah Jurusan</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jurusan as $j)
                            <tr>
                                <td>{{ $j->id }}</td>
                                <td>{{ $j->nama_jurusan }}</td>
                                <td>
                                    <a href="{{ route('admin.jurusan.edit', $j->id) }}" class="btn btn-sm btn-warning" style="width: 70px;">Edit</a>
                                    <form action="{{ route('admin.jurusan.destroy', $j->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="width: 70px;" onclick="return confirm('Yakin hapus jurusan ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada jurusan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection