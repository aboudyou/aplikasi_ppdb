@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-person-circle"></i> Profil Saya
                    </h5>
                </div>

                <div class="card-body">
                    @if($biodata)
                        <!-- Foto Profil -->
                        <div class="text-center mb-4">
                            @if($biodata->foto)
                                <img src="{{ asset('storage/' . $biodata->foto) }}" alt="Foto Profil" 
                                    class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light shadow d-inline-flex align-items-center justify-content-center" 
                                    style="width: 150px; height: 150px;">
                                    <i class="bi bi-person-circle" style="font-size: 5rem; color: #ccc;"></i>
                                </div>
                            @endif
                        </div>
                        <h6 class="mb-3 text-primary"><strong>Data Pribadi</strong></h6>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Nama Lengkap</label>
                                <p class="mb-0"><strong>{{ $biodata->nama_lengkap }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Jenis Kelamin</label>
                                <p class="mb-0"><strong>{{ $biodata->jenis_kelamin }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">NISN</label>
                                <p class="mb-0"><strong>{{ $biodata->nisn }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">NIK</label>
                                <p class="mb-0"><strong>{{ $biodata->nik }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Tempat Lahir</label>
                                <p class="mb-0"><strong>{{ $biodata->tempat_lahir }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Tanggal Lahir</label>
                                <p class="mb-0"><strong>{{ \Carbon\Carbon::parse($biodata->tanggal_lahir)->format('d-m-Y') }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Agama</label>
                                <p class="mb-0"><strong>{{ $biodata->agama }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Anak Ke-</label>
                                <p class="mb-0"><strong>{{ $biodata->anak_ke }}</strong></p>
                            </div>
                        </div>

                        <!-- Data Fisik -->
                        <h6 class="mb-3 text-primary"><strong>Data Fisik</strong></h6>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Tinggi Badan (cm)</label>
                                <p class="mb-0"><strong>{{ $biodata->tinggi_badan }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Berat Badan (kg)</label>
                                <p class="mb-0"><strong>{{ $biodata->berat_badan }}</strong></p>
                            </div>
                        </div>

                        <!-- Data Alamat -->
                        <h6 class="mb-3 text-primary"><strong>Data Alamat</strong></h6>
                        <div class="row mb-4">
                            <div class="col-md-12 mb-2">
                                <label class="text-muted small">Alamat</label>
                                <p class="mb-0"><strong>{{ $biodata->alamat }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Desa/Kelurahan</label>
                                <p class="mb-0"><strong>{{ $biodata->kelurahan_desa }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Kecamatan</label>
                                <p class="mb-0"><strong>{{ $biodata->kecamatan }}</strong></p>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="text-muted small">Kota/Kabupaten</label>
                                <p class="mb-0"><strong>{{ $biodata->kota }}</strong></p>
                            </div>
                        </div>

                        <!-- Data Pendidikan -->
                        <h6 class="mb-3 text-primary"><strong>Data Pendidikan</strong></h6>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Asal Sekolah</label>
                                <p class="mb-0"><strong>{{ $biodata->asal_sekolah }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">No. HP</label>
                                <p class="mb-0"><strong>{{ $biodata->no_hp }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Jurusan Pilihan</label>
                                <p class="mb-0"><strong>{{ $jurusan ? $jurusan->nama_jurusan : '-' }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Gelombang Pendaftaran</label>
                                <p class="mb-0"><strong>{{ $gelombang ? $gelombang->nama_gelombang : '-' }}</strong></p>
                            </div>
                        </div>

                        <!-- Status Pendaftaran -->
                        <h6 class="mb-3 text-primary"><strong>Status</strong></h6>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Nomor Pendaftaran</label>
                                <p class="mb-0"><strong>{{ $biodata->nomor_pendaftaran }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Status</label>
                                <p class="mb-0">
                                    <span class="badge bg-warning">{{ $biodata->status_pendaftaran }}</span>
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Anda belum mengisi biodata. 
                            <a href="{{ route('user.biodata') }}">Lengkapi biodata Anda sekarang</a>
                        </div>
                    @endif
                </div>

                <div class="card-footer bg-light">
                    @if($biodata)
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Edit Profil
                        </a>
                    @else
                        <a href="{{ route('user.biodata') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-file-earmark-text"></i> Isi Biodata
                        </a>
                    @endif
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
