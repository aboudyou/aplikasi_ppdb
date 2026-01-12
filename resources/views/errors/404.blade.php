@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 70vh;">
    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="404" width="150" class="mb-4">

    <h1 class="fw-bold text-primary mb-3">404</h1>
    <h4 class="fw-semibold mb-3">Halaman Tidak Ditemukan</h4>
    <p class="text-muted mb-4">Ups... Halaman yang kamu cari tidak tersedia atau sudah dihapus.</p>

    <a href="{{ url('/') }}" class="btn btn-primary px-4">Kembali ke Beranda</a>
</div>
@endsection
