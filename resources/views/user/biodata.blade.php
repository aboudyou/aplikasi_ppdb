@extends('layouts.dashboard')

@section('title', 'Isi Biodata')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Formulir Biodata Calon Siswa</h5>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('user.biodata.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" 
                               value="{{ old('nama', $biodata->nama ?? '') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                               value="{{ old('tempat_lahir', $biodata->tempat_lahir ?? '') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                               value="{{ old('tanggal_lahir', $biodata->tanggal_lahir ?? '') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control" required>{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy"></i> Simpan Biodata
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
