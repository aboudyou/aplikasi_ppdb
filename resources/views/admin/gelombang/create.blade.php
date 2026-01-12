@extends('layouts.app')

@section('title', 'Tambah Gelombang Pendaftaran')

@section('content')
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-calendar-plus"></i> Tambah Gelombang Pendaftaran</h3>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Form Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="bi bi-calendar-event me-2 text-primary"></i>Informasi Gelombang
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.gelombang.store') }}" method="POST">
                @csrf

                <!-- Basic Information -->
                <div class="row g-4 mb-4">
                    <div class="col-md-12">
                        <label for="nama_gelombang" class="form-label fw-semibold text-dark">
                            <i class="bi bi-tag me-1 text-primary"></i>Nama Gelombang <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-lg @error('nama_gelombang') is-invalid @enderror"
                               id="nama_gelombang" name="nama_gelombang"
                               value="{{ old('nama_gelombang') }}"
                               placeholder="Contoh: Gelombang 1 Tahun 2025"
                               required>
                        @error('nama_gelombang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Masukkan nama gelombang yang jelas dan deskriptif</small>
                    </div>
                </div>

                <!-- Date Range -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="tanggal_mulai" class="form-label fw-semibold text-dark">
                            <i class="bi bi-calendar me-1 text-success"></i>Tanggal Mulai <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control form-control-lg @error('tanggal_mulai') is-invalid @enderror"
                               id="tanggal_mulai" name="tanggal_mulai"
                               value="{{ old('tanggal_mulai') }}" required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_selesai" class="form-label fw-semibold text-dark">
                            <i class="bi bi-calendar-x me-1 text-danger"></i>Tanggal Selesai <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control form-control-lg @error('tanggal_selesai') is-invalid @enderror"
                               id="tanggal_selesai" name="tanggal_selesai"
                               value="{{ old('tanggal_selesai') }}" required>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Pricing and Quota -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="nilai" class="form-label fw-semibold text-dark">
                            <i class="bi bi-cash me-1 text-warning"></i>Biaya Pendaftaran <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror"
                                   id="nilai" name="nilai"
                                   value="{{ old('nilai') }}"
                                   placeholder="0"
                                   min="0" required>
                            @error('nilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Biaya pendaftaran dalam Rupiah</small>
                    </div>
                    <div class="col-md-6">
                        <label for="kuota_maksimal" class="form-label fw-semibold text-dark">
                            <i class="bi bi-people me-1 text-info"></i>Kuota Maksimal
                        </label>
                        <input type="number" class="form-control form-control-lg @error('kuota_maksimal') is-invalid @enderror"
                               id="kuota_maksimal" name="kuota_maksimal"
                               value="{{ old('kuota_maksimal') }}"
                               placeholder="Tidak terbatas"
                               min="0">
                        @error('kuota_maksimal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Kosongkan jika tidak ada batas kuota</small>
                    </div>
                </div>

                <!-- Promo Section -->
                <div class="card border border-primary border-opacity-25 bg-light mb-4">
                    <div class="card-header bg-primary bg-opacity-10 border-bottom border-primary border-opacity-25">
                        <h6 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-percent me-2"></i>Promo & Diskon (Opsional)
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label for="jenis_promo" class="form-label fw-semibold">
                                    Jenis Promo
                                </label>
                                <select class="form-select form-select-lg @error('jenis_promo') is-invalid @enderror"
                                        id="jenis_promo" name="jenis_promo">
                                    <option value="">Tidak ada promo</option>
                                    <option value="diskon" {{ old('jenis_promo') == 'diskon' ? 'selected' : '' }}>Diskon</option>
                                    <option value="potongan" {{ old('jenis_promo') == 'potongan' ? 'selected' : '' }}>Potongan Tetap</option>
                                </select>
                                @error('jenis_promo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="nilai_promo" class="form-label fw-semibold">
                                    Nilai Promo
                                </label>
                                <input type="number" class="form-control form-control-lg @error('nilai_promo') is-invalid @enderror"
                                       id="nilai_promo" name="nilai_promo"
                                       value="{{ old('nilai_promo') }}"
                                       placeholder="0"
                                       min="0">
                                @error('nilai_promo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tipe_nilai_promo" class="form-label fw-semibold">
                                    Tipe Nilai
                                </label>
                                <select class="form-select form-select-lg @error('tipe_nilai_promo') is-invalid @enderror"
                                        id="tipe_nilai_promo" name="tipe_nilai_promo">
                                    <option value="nominal" {{ old('tipe_nilai_promo') == 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                                    <option value="persen" {{ old('tipe_nilai_promo') == 'persen' ? 'selected' : '' }}>Persentase (%)</option>
                                </select>
                                @error('tipe_nilai_promo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="catatan" class="form-label fw-semibold text-dark">
                            <i class="bi bi-sticky me-1 text-secondary"></i>Catatan Internal
                        </label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror"
                                  id="catatan" name="catatan" rows="3"
                                  placeholder="Catatan internal untuk admin...">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Catatan ini hanya terlihat oleh admin</small>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan" class="form-label fw-semibold text-dark">
                            <i class="bi bi-info-circle me-1 text-info"></i>Keterangan Publik
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan" name="keterangan" rows="3"
                                  placeholder="Informasi tambahan untuk siswa...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Informasi ini akan ditampilkan ke siswa</small>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex justify-content-end gap-3 pt-4 border-top">
                    <a href="{{ route('admin.gelombang.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="bi bi-x me-1"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-floppy me-1"></i>Simpan Gelombang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #e1e5e9;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    transform: translateY(-1px);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.input-group-text {
    border-radius: 8px 0 0 8px;
    background-color: #f8f9fa;
    border-color: #e1e5e9;
}

.alert {
    border-radius: 12px;
}
</style>

<script>
// Auto-format currency input
document.getElementById('nilai').addEventListener('input', function(e) {
    // Remove non-numeric characters except decimal point
    let value = e.target.value.replace(/[^\d.]/g, '');
    e.target.value = value;
});

// Set minimum date for start date
document.getElementById('tanggal_mulai').min = new Date().toISOString().split('T')[0];

// Auto-set minimum end date when start date changes
document.getElementById('tanggal_mulai').addEventListener('change', function() {
    document.getElementById('tanggal_selesai').min = this.value;
});

// Promo type change handler
document.getElementById('jenis_promo').addEventListener('change', function() {
    const nilaiPromo = document.getElementById('nilai_promo');
    const tipeNilai = document.getElementById('tipe_nilai_promo');

    if (this.value === '') {
        nilaiPromo.disabled = true;
        tipeNilai.disabled = true;
        nilaiPromo.value = '';
    } else {
        nilaiPromo.disabled = false;
        tipeNilai.disabled = false;
    }
});

// Initialize promo fields on page load
document.addEventListener('DOMContentLoaded', function() {
    const jenisPromo = document.getElementById('jenis_promo');
    const nilaiPromo = document.getElementById('nilai_promo');
    const tipeNilai = document.getElementById('tipe_nilai_promo');

    if (jenisPromo.value === '') {
        nilaiPromo.disabled = true;
        tipeNilai.disabled = true;
    }
});
</script>

                <div class="mb-3">
                    <label for="nilai" class="form-label">Biaya Pendaftaran (Rp)</label>
                    <input type="number" class="form-control @error('nilai') is-invalid @enderror" 
                           id="nilai" name="nilai" 
                           value="{{ old('nilai', 0) }}" 
                           step="1" min="0" required>
                    @error('nilai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: 500000 untuk Rp 500.000</small>
                </div>

                <div class="mb-3">
                    <label for="kuota_maksimal" class="form-label">Kuota Maksimal Peserta (Opsional)</label>
                    <input type="number" class="form-control @error('kuota_maksimal') is-invalid @enderror" 
                           id="kuota_maksimal" name="kuota_maksimal" 
                           value="{{ old('kuota_maksimal', 0) }}" 
                           min="0" step="1">
                    @error('kuota_maksimal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Masukkan 0 atau kosongkan jika tidak ada batasan kuota. Contoh: 100 untuk maksimal 100 peserta</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jenis_promo" class="form-label">Jenis Promo (Opsional)</label>
                        <select class="form-control @error('jenis_promo') is-invalid @enderror" 
                                id="jenis_promo" name="jenis_promo" onchange="togglePromoFields()">
                            <option value="">-- Pilih --</option>
                            <option value="diskon" {{ old('jenis_promo') === 'diskon' ? 'selected' : '' }}>Diskon</option>
                            <option value="potongan" {{ old('jenis_promo') === 'potongan' ? 'selected' : '' }}>Potongan</option>
                        </select>
                        @error('jenis_promo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3" id="tipe-nilai-promo-group" style="display: none">
                        <label for="tipe_nilai_promo" class="form-label">Tipe Nilai Promo</label>
                        <select class="form-control @error('tipe_nilai_promo') is-invalid @enderror" 
                                id="tipe_nilai_promo" name="tipe_nilai_promo">
                            <option value="nominal" {{ old('tipe_nilai_promo') === 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                            <option value="persen" {{ old('tipe_nilai_promo') === 'persen' ? 'selected' : '' }}>Persentase (%)</option>
                        </select>
                        @error('tipe_nilai_promo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3" id="nilai-promo-group" style="display: none">
                        <label for="nilai_promo" class="form-label">Nilai Promo (Opsional)</label>
                        <input type="number" class="form-control @error('nilai_promo') is-invalid @enderror" 
                               id="nilai_promo" name="nilai_promo" 
                               value="{{ old('nilai_promo', 0) }}" 
                               step="0.01" min="0">
                        @error('nilai_promo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted" id="promo-helper">
                            Contoh: 50000 untuk Rp 50.000 atau 10 untuk 10%
                        </small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan (Opsional)</label>
                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                              id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.gelombang.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function togglePromoFields() {
    const jenisPromo = document.getElementById('jenis_promo').value;
    const tipeNilaiGroup = document.getElementById('tipe-nilai-promo-group');
    const nilaiPromoGroup = document.getElementById('nilai-promo-group');
    
    if (jenisPromo) {
        tipeNilaiGroup.style.display = 'block';
        nilaiPromoGroup.style.display = 'block';
    } else {
        tipeNilaiGroup.style.display = 'none';
        nilaiPromoGroup.style.display = 'none';
    }
}

// Update helper text ketika tipe nilai promo berubah
document.getElementById('tipe_nilai_promo').addEventListener('change', function() {
    const helper = document.getElementById('promo-helper');
    const tipeNilai = this.value;
    
    if (tipeNilai === 'persen') {
        helper.textContent = 'Contoh: 10 untuk 10% atau 25 untuk 25%';
    } else {
        helper.textContent = 'Contoh: 50000 untuk Rp 50.000';
    }
});
</script>
@endsection