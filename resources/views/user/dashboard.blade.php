@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Siswa</h3>
    <div class="row g-4">
        {{-- Biodata --}}
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp">
                <div class="card-body text-center">
                    <i class="bi bi-person-lines-fill dashboard-icon text-primary"></i>
                    <h5 class="card-title mt-3">Biodata</h5>
                    <p class="text-muted">Lengkapi data diri kamu</p>
                    <a href="{{ route('user.biodata') }}" class="btn btn-primary btn-sm">Isi Biodata</a>
                </div>
            </div>
        </div>
        {{-- Lihat Profil --}}
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.1s;">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle dashboard-icon text-info"></i>
                    <h5 class="card-title mt-3">Profil</h5>
                    <p class="text-muted">Lihat profil lengkap kamu</p>
                    <a href="{{ route('user.profile.index') }}" class="btn btn-info btn-sm">Lihat Profil</a>
                </div>
            </div>
        </div>
        {{-- Upload Dokumen --}}
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.2s;">
                <div class="card-body text-center">
                    <i class="bi bi-upload dashboard-icon text-success"></i>
                    <h5 class="card-title mt-3">Upload Dokumen</h5>
                    <p class="text-muted">Unggah berkas persyaratan</p>
                    <a href="{{ route('user.dokumen.index') }}" class="btn btn-success btn-sm">Upload</a>
                </div>
            </div>
        </div>
        {{-- Status Seleksi --}}
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.3s;">
                <div class="card-body text-center">
                    <i class="bi bi-check2-circle dashboard-icon text-warning"></i>
                    <h5 class="card-title mt-3">Status Seleksi</h5>
                    <p class="text-muted">Lihat hasil seleksi kamu</p>
                    <a href="{{ route('user.status') }}" class="btn btn-warning btn-sm">Cek Status</a>
                </div>
            </div>
        </div>
        {{-- Pembayaran PPDB --}}
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.4s;">
                <div class="card-body text-center">
                    <i class="bi bi-credit-card dashboard-icon text-danger"></i>
                    <h5 class="card-title mt-3">Pembayaran</h5>
                    <p class="text-muted">Upload bukti pembayaran biaya pendaftaran</p>
                    <a href="{{ route('user.pembayaran') }}" class="btn btn-danger btn-sm">Bayar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
