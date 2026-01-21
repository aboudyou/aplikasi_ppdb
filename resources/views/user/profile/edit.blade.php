@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h4 class="mb-4"><i class="bi bi-file-earmark-text"></i> Formulir Biodata Siswa</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $biodata->nama_lengkap ?? '') }}">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NISN (10 Angka) <span class="text-danger">*</span></label>
                <input type="number" name="nisn" class="form-control @error('nisn') is-invalid @enderror" 
                       value="{{ old('nisn', $biodata->nisn ?? '') }}" 
                       maxlength="10" inputmode="numeric" placeholder="Contoh: 1234567890" required>
                @error('nisn')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="text-muted">Hanya boleh angka, 10 digit</small>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">NIK (16 Angka) <span class="text-danger">*</span></label>
                <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                       value="{{ old('nik', $biodata->nik ?? '') }}" 
                       maxlength="16" inputmode="numeric" placeholder="Contoh: 1234567890123456" required>
                @error('nik')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="text-muted">Hanya boleh angka, 16 digit</small>
            </div>
        </div>

        <!-- contoh radio jenis kelamin -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Jenis Kelamin</label>
                <label><input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'L' ? 'checked' : '' }}> Laki-laki</label>
                &nbsp;&nbsp;
                <label><input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'P' ? 'checked' : '' }}> Perempuan</label>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Agama</label>
                <select name="agama" class="form-control">
                    <option value="">-- Pilih Agama --</option>
                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $a)
                        <option value="{{ $a }}" {{ old('agama', $biodata->agama ?? '') == $a ? 'selected' : '' }}>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label class="form-label">No. HP (Opsional)</label>
            <input type="tel" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                   value="{{ old('no_hp', $biodata->no_hp ?? '') }}" 
                   inputmode="numeric" placeholder="Contoh: 08123456789">
            @error('no_hp')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            <small class="text-muted">Hanya boleh angka, 10-13 digit</small>
        </div>

        <!-- Jurusan & Gelombang -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pilih Jurusan</label>
                <select name="jurusan_id" class="form-control" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}" {{ old('jurusan_id', $biodata->jurusan_id ?? '') == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Gelombang Pendaftaran</label>
                <select name="gelombang_id" class="form-control" required>
                    <option value="">-- Pilih Gelombang --</option>
                    @foreach($gelombang as $g)
                        <option value="{{ $g->id }}" {{ old('gelombang_id', $biodata->gelombang_id ?? '') == $g->id ? 'selected' : '' }}>
                            {{ $g->nama_gelombang }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button class="btn btn-primary px-4" type="submit"><i class="bi bi-save"></i> Simpan</button>
    </form>
</div>
@endsection
