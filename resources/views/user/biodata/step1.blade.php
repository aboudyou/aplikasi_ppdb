@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        
        {{-- Step Indicator --}}
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-primary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">1</div>
                    <p class="mt-2 mb-0 fw-semibold text-primary">Data Diri</p>
                    <small class="text-muted">Saat Ini</small>
                </div>
                
                <div style="flex: 1; height: 2px; background-color: #ddd; margin: 0 10px; margin-top: 20px;"></div>
                
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-secondary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">2</div>
                    <p class="mt-2 mb-0">Alamat & Jurusan</p>
                    <small class="text-muted">Selanjutnya</small>
                </div>
            </div>
        </div>

        <h4 class="mb-4">
            <i class="bi bi-file-earmark-text"></i> Biodata Siswa - Data Diri
        </h4>

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 5px solid #dc3545;">
                <div style="font-weight: bold; margin-bottom: 10px;">
                    <i class="bi bi-exclamation-triangle-fill"></i> Data Anda Ada Kesalahan!
                </div>
                <p style="margin-bottom: 10px; font-size: 14px;">Mohon perbaiki error berikut sebelum lanjut:</p>
                <ul class="mb-0" style="margin-left: 15px;">
                    @foreach($errors->all() as $error)
                        <li style="margin-bottom: 5px;">{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="alert alert-info mb-4" role="alert">
            <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Isi semua field yang bertanda <span class="text-danger">*</span> dengan data yang benar.
        </div>

        <form action="{{ route('user.biodata.store.step1') }}" method="POST">
            @csrf

            <!-- Nama Lengkap -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                       placeholder="Contoh: Muhammad Reza Hidayat" required
                       value="{{ old('nama_lengkap', $biodata->nama_lengkap ?? '') }}">
                @error('nama_lengkap')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <!-- NISN & NIK -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NISN (10 Angka) <span class="text-danger">*</span></label>
                    <input type="number" name="nisn" class="form-control @error('nisn') is-invalid @enderror" 
                           inputmode="numeric" placeholder="Contoh: 1234567890" required
                           value="{{ old('nisn', $biodata->nisn ?? '') }}">
                    @error('nisn')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Hanya boleh angka, 10 digit</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NIK (16 Angka) <span class="text-danger">*</span></label>
                    <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                           inputmode="numeric" placeholder="Contoh: 1234567890123456" required
                           value="{{ old('nik', $biodata->nik ?? '') }}">
                    @error('nik')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Hanya boleh angka, 16 digit</small>
                </div>
            </div>

            <!-- Tempat Lahir, Tanggal Lahir -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                           placeholder="Contoh: Jakarta" required
                           value="{{ old('tempat_lahir', $biodata->tempat_lahir ?? '') }}">
                    @error('tempat_lahir')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <small class="text-muted">Hanya huruf dan spasi</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                           max="{{ now()->format('Y-m-d') }}" required
                           value="{{ old('tanggal_lahir', $biodata->tanggal_lahir ?? '') }}">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <small class="text-muted">Tidak boleh di masa depan</small>
                </div>
            </div>

            <!-- Jenis Kelamin, Agama -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div @error('jenis_kelamin') class="border border-danger rounded p-2" @else class="border border-light rounded p-2" @enderror>
                        <div class="form-check">
                            <input type="radio" name="jenis_kelamin" value="L" class="form-check-input" required 
                                   {{ old('jenis_kelamin', $biodata && $biodata->jenis_kelamin === 'Laki-laki' ? 'L' : old('jenis_kelamin')) === 'L' ? 'checked' : '' }}>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="jenis_kelamin" value="P" class="form-check-input"
                                   {{ old('jenis_kelamin', $biodata && $biodata->jenis_kelamin === 'Perempuan' ? 'P' : old('jenis_kelamin')) === 'P' ? 'checked' : '' }}>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    @error('jenis_kelamin')
                        <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                    <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                        <option value="">-- Pilih Agama --</option>
                        @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $ag)
                            <option value="{{ $ag }}" {{ old('agama', $biodata->agama ?? '') === $ag ? 'selected' : '' }}>{{ $ag }}</option>
                        @endforeach
                    </select>
                    @error('agama')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tinggi Badan & Berat Badan -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="tinggi_badan" class="form-control @error('tinggi_badan') is-invalid @enderror"
                           min="50" max="250" placeholder="Contoh: 170" required
                           value="{{ old('tinggi_badan', $biodata->tinggi_badan ?? '') }}">
                    @error('tinggi_badan')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <small class="text-muted">50-250 cm</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Berat Badan (kg) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="berat_badan" class="form-control @error('berat_badan') is-invalid @enderror"
                           min="20" max="200" placeholder="Contoh: 65" required
                           value="{{ old('berat_badan', $biodata->berat_badan ?? '') }}">
                    @error('berat_badan')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <small class="text-muted">20-200 kg</small>
                </div>
            </div>

            <!-- Asal Sekolah & Anak Ke -->
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Asal Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror"
                           placeholder="Contoh: SMP Negeri 1 Sidoarjo" required
                           value="{{ old('asal_sekolah', $biodata->asal_sekolah ?? '') }}">
                    @error('asal_sekolah')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Anak ke- <span class="text-danger">*</span></label>
                    <input type="number" name="anak_ke" class="form-control @error('anak_ke') is-invalid @enderror"
                           min="1" max="20" placeholder="Contoh: 1" required
                           value="{{ old('anak_ke', $biodata->anak_ke ?? '') }}">
                    @error('anak_ke')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <small class="text-muted">1-20</small>
                </div>
            </div>

            <!-- Tombol -->
            <div class="mt-4 d-flex gap-2 flex-wrap">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-arrow-right"></i> Lanjut ke Step 2
                </button>
                <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash"></i> Hapus & Isi Ulang
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle"></i> Hapus Biodata?
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2"><strong>Perhatian!</strong></p>
                <p class="mb-2">Anda akan menghapus semua data biodata Anda. Tindakan ini tidak dapat dibatalkan.</p>
                <p class="mb-2">Setelah dihapus, Anda dapat mengisinya kembali dari awal dengan data yang benar.</p>
                <p class="mb-0 text-danger"><strong>Apakah Anda yakin ingin melanjutkan?</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('user.profile.destroy') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Ya, Hapus Biodata
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
