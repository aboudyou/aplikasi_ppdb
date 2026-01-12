@extends('layouts.app')

@section('title', 'Detail Verifikasi Berkas')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Detail Verifikasi Berkas</h3>
        <a href="{{ route('admin.verifikasi.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
    </div>

    @php
        // Support both $formulir (from controller) or $siswa->formulir (older code)
        $form = $formulir ?? ($siswa->formulir ?? null);
    @endphp

    @if(!$form)
        <div class="alert alert-danger">Formulir tidak ditemukan.</div>
    @else
        <!-- Data Pendaftar -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Data Pendaftar</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Nama Lengkap</small>
                        <strong>@include('components.empty-field', ['value' => $form->nama_lengkap ?: optional($form->user)->name])</strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">NISN</small>
                        <strong>@include('components.empty-field', ['value' => $form->nisn ?: optional($form->user)->nisn])</strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Asal Sekolah</small>
                        <strong>@include('components.empty-field', ['value' => $form->asal_sekolah ?: optional($form->user)->asal_sekolah])</strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Jenis Kelamin</small>
                        <strong>@include('components.empty-field', ['value' => $form->jenis_kelamin])</strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Tempat Lahir</small>
                        <strong>@include('components.empty-field', ['value' => $form->tempat_lahir])</strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Tanggal Lahir</small>
                        <strong>
                            @if($form->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($form->tanggal_lahir)->format('d-m-Y') }}
                            @else
                                @include('components.empty-field', ['value' => null])
                            @endif
                        </strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">No. HP</small>
                        <strong>@include('components.empty-field', ['value' => $form->no_hp])</strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Alamat</small>
                        <strong>@include('components.empty-field', ['value' => $form->alamat])</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Status Pendaftaran</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Status Saat Ini</small>
                        <strong>
                            @php $status = $form->status_pendaftaran ?? null; @endphp
                            @if($status === 'Draft')
                                <span class="badge bg-secondary">Draft</span>
                            @elseif($status === 'Lengkap')
                                <span class="badge bg-info text-dark">Lengkap</span>
                            @elseif($status === 'Diverifikasi')
                                <span class="badge bg-success">Diverifikasi</span>
                            @elseif($status === 'Lulus')
                                <span class="badge bg-success">Lulus</span>
                            @elseif($status === 'Tidak Lulus')
                                <span class="badge bg-danger">Tidak Lulus</span>
                            @else
                                <span class="text-muted">— Belum diisi</span>
                            @endif
                        </strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aksi -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Aksi Verifikasi</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Pilih aksi untuk melanjutkan verifikasi pendaftar ini.</p>
                <form action="{{ route('admin.verifikasi.approve', $form->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Setujui
                    </button>
                </form>

                <form action="{{ route('admin.verifikasi.reject', $form->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menolak pendaftar ini?')">
                        <i class="bi bi-x-circle"></i> Tolak
                    </button>
                </form>

                <a href="{{ route('admin.verifikasi.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
    @endif

</div>
@endsection