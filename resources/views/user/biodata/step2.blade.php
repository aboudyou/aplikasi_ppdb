@extends('layouts.app')

@section('content')
@php
    // Initialize biodata object jika tidak ada
    if (!isset($biodata)) {
        $biodata = new \stdClass();
    }
@endphp
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        
        {{-- Step Indicator --}}
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-success text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;"><i class="bi bi-check"></i></div>
                    <p class="mt-2 mb-0 fw-semibold text-success">Data Diri</p>
                    <small class="text-muted">Selesai</small>
                </div>
                
                <div style="flex: 1; height: 2px; background-color: #28a745; margin: 0 10px; margin-top: 20px;"></div>
                
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-primary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">2</div>
                    <p class="mt-2 mb-0 fw-semibold text-primary">Alamat & Jurusan</p>
                    <small class="text-muted">Saat Ini</small>
                </div>
            </div>
        </div>

        <h4 class="mb-4">
            <i class="bi bi-geo-alt"></i> Biodata Siswa - Alamat & Jurusan
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
            <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Lengkapi data alamat dan pilih jurusan yang Anda inginkan.
        </div>

        <form action="{{ route('user.biodata.store.step2') }}" method="POST">
            @csrf

            <!-- Alamat Lengkap -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" 
                          minlength="5" maxlength="255" placeholder="Masukkan alamat lengkap Anda" required>{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 5 karakter</small>
            </div>

            <!-- Desa, Kelurahan, Kecamatan, Kota -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Desa/Kelurahan (Opsional)</label>
                    <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror"
                           placeholder="Desa/Kelurahan" value="{{ old('desa', $biodata->kelurahan_desa ?? '') }}">
                    @error('desa')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Kecamatan <span class="text-danger">*</span></label>
                    <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror"
                           placeholder="Contoh: Sukodono" required
                           value="{{ old('kecamatan', $biodata->kecamatan ?? '') }}">
                    @error('kecamatan')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Kota <span class="text-danger">*</span></label>
                    <input type="text" name="kota" class="form-control @error('kota', $biodata->kota ?? '') is-invalid @enderror"
                           placeholder="Contoh: Sidoarjo" required
                           value="{{ old('kota', $biodata->kota ?? '') }}">
                    @error('kota')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- No HP -->
            <div class="mb-3">
                <label class="form-label">No. HP (Opsional)</label>
                <input type="tel" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                       inputmode="numeric" placeholder="Contoh: 08123456789"
                       value="{{ old('no_hp', $biodata->no_hp ?? '') }}">
                @error('no_hp')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted">Hanya boleh angka, 10-13 digit. Mulai dengan 08...</small>
            </div>

            <!-- Jurusan & Gelombang -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Pilih Jurusan <span class="text-danger">*</span></label>
                    <select name="jurusan_id" class="form-select @error('jurusan_id') is-invalid @enderror" id="jurusanSelect" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($jurusan as $j)
                            <option value="{{ $j->id }}" data-kuota="{{ $j->kuota }}" data-accepted="{{ $j->getAcceptedCount() }}" {{ old('jurusan_id', $biodata->jurusan_id ?? '') == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <small class="text-muted d-block mt-2" id="kuotaInfo"></small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Gelombang Pendaftaran <span class="text-danger">*</span></label>
                    <select name="gelombang_id" class="form-select @error('gelombang_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Gelombang --</option>
                        @foreach($gelombang as $g)
                            <option value="{{ $g->id }}" {{ old('gelombang_id', $biodata->gelombang_id ?? '') == $g->id ? 'selected' : '' }}>{{ $g->nama_gelombang }}</option>
                        @endforeach
                    </select>
                    @error('gelombang_id')
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tombol -->
            <div class="mt-4 d-flex gap-2 flex-wrap">
                <a href="{{ route('user.biodata.step1') }}" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Kembali ke Step 1
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Simpan Biodata
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jurusanSelect = document.getElementById('jurusanSelect');
    const kuotaInfo = document.getElementById('kuotaInfo');

    function updateKuotaInfo() {
        const selectedOption = jurusanSelect.options[jurusanSelect.selectedIndex];
        
        if (!selectedOption.value) {
            kuotaInfo.innerHTML = '';
            return;
        }

        const kuota = parseInt(selectedOption.dataset.kuota);
        const accepted = parseInt(selectedOption.dataset.accepted);
        const jurusanName = selectedOption.text;

        let html = '';

        if (kuota <= 0) {
            // Tidak ada batasan kuota
            html = `<i class="bi bi-info-circle"></i> <strong>${jurusanName}</strong> tidak memiliki batasan kuota`;
        } else {
            const remaining = kuota - accepted;
            const percentage = (accepted / kuota) * 100;

            if (remaining > 0) {
                // Kuota masih tersedia
                html = `
                    <div class="mb-2">
                        <i class="bi bi-check-circle-fill text-success"></i> 
                        <strong>Kuota Tersedia!</strong> 
                        Sisa kuota: <strong>${remaining} dari ${kuota}</strong>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: ${100 - percentage}%" aria-valuenow="${100 - percentage}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                `;
            } else {
                // Kuota penuh
                html = `
                    <div class="alert alert-warning mb-2 py-2 px-3">
                        <i class="bi bi-exclamation-triangle-fill"></i> 
                        <strong>Kuota Penuh!</strong> 
                        Jurusan <strong>${jurusanName}</strong> sudah mencapai batas penerimaan (${kuota}/${kuota})
                    </div>
                `;
            }
        }

        kuotaInfo.innerHTML = html;
    }

    // Trigger saat page load jika ada nilai selected
    updateKuotaInfo();

    // Trigger saat user memilih jurusan
    jurusanSelect.addEventListener('change', updateKuotaInfo);
});
</script>
@endsection
