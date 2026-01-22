@extends('layouts.app')

@section('title', 'Edit Jurusan')

@section('content')
<div class="container-fluid px-3 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" data-aos="fade-up">
                <div class="card-header">
                    <h5>Edit Jurusan</h5>
                    <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                            <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" id="nama_jurusan" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}" required>
                            @error('nama_jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="number" class="form-control @error('kuota') is-invalid @enderror" id="kuota" name="kuota" value="{{ old('kuota', $jurusan->kuota) }}" min="0" required>
                            <small class="text-muted">Masukkan 0 jika tidak ada batasan kuota</small>
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <strong>Informasi:</strong> Saat ini sudah ada <strong>{{ $jurusan->getAcceptedCount() }}</strong> siswa yang diterima.
                            @if($jurusan->kuota > 0)
                                Sisa kuota: <strong>{{ $jurusan->getAvailableQuota() }} dari {{ $jurusan->kuota }}</strong>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection