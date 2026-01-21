@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        
        {{-- Step Indicator --}}
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-success text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;"><i class="bi bi-check"></i></div>
                    <p class="mt-2 mb-0 fw-semibold text-success">Data Ayah</p>
                    <small class="text-muted">Selesai</small>
                </div>
                
                <div style="flex: 1; height: 2px; background-color: #28a745; margin: 0 10px; margin-top: 20px;"></div>
                
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-primary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">2</div>
                    <p class="mt-2 mb-0 fw-semibold text-primary">Data Ibu & Wali</p>
                    <small class="text-muted">Saat Ini</small>
                </div>
            </div>
        </div>

        <h4 class="mb-4">
            <i class="bi bi-people"></i> Data Orang Tua - Data Ibu & Wali
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
            <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Lengkapi data ibu Anda. Data wali bersifat opsional.
        </div>

        <form action="{{ route('user.orangtua.store.step2') }}" method="POST">
            @csrf

            {{-- ===== DATA IBU ===== --}}
            <div class="card bg-light mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person-lines-fill"></i> Data Ibu</h5>
                </div>
                <div class="card-body">
                    {{-- Nama Ibu --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Ibu <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" 
                               pattern="[a-zA-Z\s]+" placeholder="Contoh: Siti Nurhaliza" required
                               value="{{ old('nama_ibu') }}">
                        @error('nama_ibu')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Hanya huruf dan spasi</small>
                    </div>

                    {{-- Tanggal Lahir & NIK Ibu --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir Ibu <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir_ibu" class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror"
                                   required value="{{ old('tanggal_lahir_ibu') }}">
                            @error('tanggal_lahir_ibu')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIK Ibu (16 Digit) <span class="text-danger">*</span></label>
                            <input type="number" name="nik_ibu" class="form-control @error('nik_ibu') is-invalid @enderror" 
                                   placeholder="Contoh: 1234567890123456" required
                                   value="{{ old('nik_ibu') }}">
                            @error('nik_ibu')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Hanya boleh angka, 16 digit</small>
                        </div>
                    </div>

                    {{-- Pekerjaan & Penghasilan Ibu --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Pekerjaan Ibu <span class="text-danger">*</span></label>
                            <input type="text" name="pekerjaan_ibu" class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                   placeholder="Contoh: Ibu Rumah Tangga" required
                                   value="{{ old('pekerjaan_ibu') }}">
                            @error('pekerjaan_ibu')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Penghasilan Ibu per Bulan (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="penghasilan_ibu" class="form-control @error('penghasilan_ibu') is-invalid @enderror"
                                   placeholder="Contoh: 3000000" required
                                   value="{{ old('penghasilan_ibu') }}">
                            @error('penghasilan_ibu')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Pendidikan & No HP Ibu --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Pendidikan Terakhir Ibu <span class="text-danger">*</span></label>
                            <select name="pendidikan_ibu" class="form-select @error('pendidikan_ibu') is-invalid @enderror" required>
                                <option value="">-- Pilih Pendidikan --</option>
                                @foreach(['SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3', 'Lainnya'] as $pend)
                                    <option value="{{ $pend }}" {{ old('pendidikan_ibu') === $pend ? 'selected' : '' }}>{{ $pend }}</option>
                                @endforeach
                            </select>
                            @error('pendidikan_ibu')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. HP Ibu <span class="text-danger">*</span></label>
                            <input type="tel" name="no_hp_ibu" class="form-control @error('no_hp_ibu') is-invalid @enderror"
                                   placeholder="Contoh: 08123456789" required
                                   value="{{ old('no_hp_ibu') }}">
                            @error('no_hp_ibu')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">10-13 digit</small>
                        </div>
                    </div>

                    {{-- Alamat Ibu --}}
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Alamat Ibu <span class="text-danger">*</span></label>
                        <textarea name="alamat_ibu" class="form-control @error('alamat_ibu') is-invalid @enderror" 
                                  rows="2" minlength="5" maxlength="255" placeholder="Masukkan alamat lengkap" required>{{ old('alamat_ibu') }}</textarea>
                        @error('alamat_ibu')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal 5 karakter</small>
                    </div>
                </div>
            </div>

            {{-- ===== DATA WALI (OPTIONAL) ===== --}}
            <div class="card bg-light mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-person"></i> Data Wali (Opsional)</h5>
                    <small>Jika ada/diperlukan</small>
                </div>
                <div class="card-body">
                    {{-- Nama Wali --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Wali</label>
                        <input type="text" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" 
                               pattern="[a-zA-Z\s]+" placeholder="Contoh: Ahmad Rifai"
                               value="{{ old('nama_wali') }}">
                        @error('nama_wali')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Hanya huruf dan spasi</small>
                    </div>

                    {{-- Tanggal Lahir & NIK Wali --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir Wali</label>
                            <input type="date" name="tanggal_lahir_wali" class="form-control @error('tanggal_lahir_wali') is-invalid @enderror"
                                   value="{{ old('tanggal_lahir_wali') }}">
                            @error('tanggal_lahir_wali')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIK Wali (16 Digit)</label>
                            <input type="number" name="nik_wali" class="form-control @error('nik_wali') is-invalid @enderror" 
                                   placeholder="Contoh: 1234567890123456"
                                   value="{{ old('nik_wali') }}">
                            @error('nik_wali')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Hanya boleh angka, 16 digit</small>
                        </div>
                    </div>

                    {{-- Pekerjaan & Penghasilan Wali --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pekerjaan Wali</label>
                            <input type="text" name="pekerjaan_wali" class="form-control @error('pekerjaan_wali') is-invalid @enderror"
                                   placeholder="Contoh: Karyawan Swasta"
                                   value="{{ old('pekerjaan_wali') }}">
                            @error('pekerjaan_wali')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penghasilan Wali per Bulan (Rp)</label>
                            <input type="number" name="penghasilan_wali" class="form-control @error('penghasilan_wali') is-invalid @enderror"
                                   placeholder="Contoh: 4000000"
                                   value="{{ old('penghasilan_wali') }}">
                            @error('penghasilan_wali')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Pendidikan & No HP Wali --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan Terakhir Wali</label>
                            <select name="pendidikan_wali" class="form-select @error('pendidikan_wali') is-invalid @enderror">
                                <option value="">-- Pilih Pendidikan --</option>
                                @foreach(['SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3', 'Lainnya'] as $pend)
                                    <option value="{{ $pend }}" {{ old('pendidikan_wali') === $pend ? 'selected' : '' }}>{{ $pend }}</option>
                                @endforeach
                            </select>
                            @error('pendidikan_wali')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. HP Wali</label>
                            <input type="tel" name="no_hp_wali" class="form-control @error('no_hp_wali') is-invalid @enderror"
                                   placeholder="Contoh: 08123456789"
                                   value="{{ old('no_hp_wali') }}">
                            @error('no_hp_wali')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">10-13 digit</small>
                        </div>
                    </div>

                    {{-- Alamat Wali --}}
                    <div class="mb-0">
                        <label class="form-label">Alamat Wali</label>
                        <textarea name="alamat_wali" class="form-control @error('alamat_wali') is-invalid @enderror" 
                                  rows="2" minlength="5" maxlength="255" placeholder="Masukkan alamat lengkap">{{ old('alamat_wali') }}</textarea>
                        @error('alamat_wali')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal 5 karakter</small>
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('user.orangtua.step1') }}" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Kembali ke Step 1
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Simpan Data Orang Tua
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
