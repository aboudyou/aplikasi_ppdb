@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        
        {{-- Step Indicator --}}
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-primary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">1</div>
                    <p class="mt-2 mb-0 fw-semibold text-primary">Data Ayah</p>
                    <small class="text-muted">Saat Ini</small>
                </div>
                
                <div style="flex: 1; height: 2px; background-color: #ddd; margin: 0 10px; margin-top: 20px;"></div>
                
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-secondary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">2</div>
                    <p class="mt-2 mb-0">Data Ibu & Wali</p>
                    <small class="text-muted">Selanjutnya</small>
                </div>
            </div>
        </div>

        <h4 class="mb-4">
            <i class="bi bi-people"></i> Data Orang Tua - Data Ayah
        </h4>

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 5px solid #dc3545;">
                <div style="font-weight: bold; margin-bottom: 10px;">
                    <i class="bi bi-exclamation-triangle-fill"></i> Data Anda Ada Kesalahan!
                </div>
                <ul class="mb-0" style="margin-left: 15px;">
                    @foreach($errors->all() as $error)
                        <li style="margin-bottom: 5px;">{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="alert alert-info mb-4" role="alert">
            <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Lengkapi data ayah Anda dengan benar.
        </div>

        <form action="{{ route('user.orangtua.store.step1') }}" method="POST">
            @csrf

            {{-- Nama Ayah --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Ayah <span class="text-danger">*</span></label>
                <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" 
                       pattern="[a-zA-Z\s]+" placeholder="Contoh: Budi Santoso" required
                       value="{{ old('nama_ayah') }}">
                @error('nama_ayah')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted">Hanya huruf dan spasi</small>
            </div>

            {{-- Tanggal Lahir & NIK Ayah --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir Ayah <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir_ayah" class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror"
                           required value="{{ old('tanggal_lahir_ayah') }}">
                    @error('tanggal_lahir_ayah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NIK Ayah (16 Digit) <span class="text-danger">*</span></label>
                    <input type="number" name="nik_ayah" class="form-control @error('nik_ayah') is-invalid @enderror" 
                           placeholder="Contoh: 1234567890123456" required
                           value="{{ old('nik_ayah') }}">
                    @error('nik_ayah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Hanya boleh angka, 16 digit</small>
                </div>
            </div>

            {{-- Pekerjaan & Penghasilan --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Pekerjaan Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ayah" class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                           placeholder="Contoh: Karyawan Swasta" required
                           value="{{ old('pekerjaan_ayah') }}">
                    @error('pekerjaan_ayah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Penghasilan Ayah per Bulan (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="penghasilan_ayah" class="form-control @error('penghasilan_ayah') is-invalid @enderror"
                           placeholder="Contoh: 5000000" required
                           value="{{ old('penghasilan_ayah') }}">
                    @error('penghasilan_ayah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Pendidikan & No HP --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Pendidikan Terakhir Ayah <span class="text-danger">*</span></label>
                    <select name="pendidikan_ayah" class="form-select @error('pendidikan_ayah') is-invalid @enderror" required>
                        <option value="">-- Pilih Pendidikan --</option>
                        @foreach(['SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3', 'Lainnya'] as $pend)
                            <option value="{{ $pend }}" {{ old('pendidikan_ayah') === $pend ? 'selected' : '' }}>{{ $pend }}</option>
                        @endforeach
                    </select>
                    @error('pendidikan_ayah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">No. HP Ayah <span class="text-danger">*</span></label>
                    <input type="tel" name="no_hp_ayah" class="form-control @error('no_hp_ayah') is-invalid @enderror"
                           placeholder="Contoh: 08123456789" required
                           value="{{ old('no_hp_ayah') }}">
                    @error('no_hp_ayah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">10-13 digit</small>
                </div>
            </div>

            {{-- Alamat Ayah --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat Ayah <span class="text-danger">*</span></label>
                <textarea name="alamat_ayah" class="form-control @error('alamat_ayah') is-invalid @enderror" 
                          rows="3" minlength="5" maxlength="255" placeholder="Masukkan alamat lengkap" required>{{ old('alamat_ayah') }}</textarea>
                @error('alamat_ayah')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 5 karakter</small>
            </div>

            {{-- Tombol --}}
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-arrow-right"></i> Lanjut ke Step 2
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
