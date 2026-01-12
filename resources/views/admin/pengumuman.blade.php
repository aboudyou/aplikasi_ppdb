@extends('layouts.app')
@section('title', 'Pengumuman')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Pengumuman Hasil Seleksi</h3>
        <a href="{{ auth()->user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Isi tabel pengumuman di sini --}}
            <p class="text-muted">Tidak ada pengumuman saat ini.</p>
        </div>
    </div>
</div>
@endsection
