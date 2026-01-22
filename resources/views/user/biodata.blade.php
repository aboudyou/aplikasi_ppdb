@extends('layouts.app')


@section('content')
<div class="card shadow-sm p-4">
    <h4 class="mb-4">
        <i class="bi bi-file-earmark-text"></i> Formulir Biodata Siswa
    </h4>

    <div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 5px solid #dc3545;">
                <div style="font-weight: bold; margin-bottom: 10px;">
                    <i class="bi bi-exclamation-triangle-fill"></i> ⚠️ Data Anda Ada Kesalahan!
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
    </div>

    @unless($data)
    <!-- Informasi untuk User -->
    <div class="alert alert-info mb-4" role="alert">
        <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Lengkapi data diri Anda dengan benar. Data yang sudah tersimpan tidak perlu diisi ulang.
    </div>

    <form action="{{ route('user.biodata.save') }}" method="POST">
        @csrf

        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                   pattern="[a-zA-Z\s]+" placeholder="Contoh: Muhammad Reza Hidayat" required
                   value="{{ old('nama_lengkap') }}">
            @error('nama_lengkap')
                <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <small class="text-muted">Hanya huruf dan spasi, tanpa angka atau simbol</small>
        </div>

        <!-- NISN & NIK -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NISN (10 Angka) <span class="text-danger">*</span></label>
                <input type="number" name="nisn" class="form-control @error('nisn') is-invalid @enderror" 
                       maxlength="10" inputmode="numeric" placeholder="Contoh: 1234567890" required>
                @error('nisn')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="text-muted">Hanya boleh angka, 10 digit</small>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">NIK (16 Angka) <span class="text-danger">*</span></label>
                <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                       maxlength="16" inputmode="numeric" placeholder="Contoh: 1234567890123456" required>
                @error('nik')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="text-muted">Hanya boleh angka, 16 digit</small>
            </div>
        </div>

        <!-- Tempat Lahir, Tanggal Lahir -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                       pattern="[a-zA-Z\s]+" placeholder="Contoh: Jakarta" required
                       value="{{ old('tempat_lahir') }}">
                @error('tempat_lahir')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted">Hanya huruf dan spasi</small>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                       max="{{ now()->subYears(12)->format('Y-m-d') }}" required
                       value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 12 tahun, tidak boleh di masa depan</small>
            </div>
        </div>

        <!-- Jenis Kelamin, Agama -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                <div @error('jenis_kelamin') class="border border-danger rounded p-2" @enderror>
                    <div class="form-check">
                        <input type="radio" name="jenis_kelamin" value="L" class="form-check-input" required 
                               {{ old('jenis_kelamin') === 'L' ? 'checked' : '' }}>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="jenis_kelamin" value="P" class="form-check-input"
                               {{ old('jenis_kelamin') === 'P' ? 'checked' : '' }}>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
                @error('jenis_kelamin')
                    <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Agama <span class="text-danger">*</span></label>
                <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                    <option value="">-- Pilih Agama --</option>
                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $ag)
                        <option value="{{ $ag }}" {{ old('agama') === $ag ? 'selected' : '' }}>{{ $ag }}</option>
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
                <label class="form-label">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="tinggi_badan" class="form-control @error('tinggi_badan') is-invalid @enderror"
                       min="50" max="250" placeholder="Contoh: 170" required
                       value="{{ old('tinggi_badan') }}">
                @error('tinggi_badan')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted">50-250 cm</small>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Berat Badan (kg) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="berat_badan" class="form-control @error('berat_badan') is-invalid @enderror"
                       min="20" max="200" placeholder="Contoh: 65" required
                       value="{{ old('berat_badan') }}">
                @error('berat_badan')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted">20-200 kg</small>
            </div>
        </div>

        <!-- Asal Sekolah & Anak Ke -->
        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label">Asal Sekolah <span class="text-danger">*</span></label>
                <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror"
                       placeholder="Contoh: SMP Negeri 1 Sidoarjo" required
                       value="{{ old('asal_sekolah') }}">
                @error('asal_sekolah')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Anak ke- <span class="text-danger">*</span></label>
                <input type="number" name="anak_ke" class="form-control @error('anak_ke') is-invalid @enderror"
                       min="1" max="20" placeholder="Contoh: 1" required
                       value="{{ old('anak_ke') }}">
                @error('anak_ke')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted">1-20</small>
            </div>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" 
                      minlength="5" maxlength="255" placeholder="Masukkan alamat lengkap Anda" required>{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <small class="text-muted">Minimal 5 karakter</small>
        </div>

        <!-- Desa, Kelurahan, Kecamatan, Kota -->
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Desa (Opsional)</label>
                <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror"
                       placeholder="Desa/Kelurahan" value="{{ old('desa') }}">
                @error('desa')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Kelurahan (Opsional)</label>
                <input type="text" name="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror"
                       placeholder="Kelurahan" value="{{ old('kelurahan') }}">
                @error('kelurahan')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror"
                       placeholder="Contoh: Sukodono" required
                       value="{{ old('kecamatan') }}">
                @error('kecamatan')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Kota <span class="text-danger">*</span></label>
                <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror"
                       placeholder="Contoh: Sidoarjo" required
                       value="{{ old('kota') }}">
                @error('kota')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label class="form-label">No. HP (Opsional)</label>
            <input type="tel" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                   inputmode="numeric" placeholder="Contoh: 08123456789" min="10" max="13"
                   value="{{ old('no_hp') }}">
            @error('no_hp')
                <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <small class="text-muted">Hanya boleh angka, 10-13 digit. Mulai dengan 08...</small>
        </div>

        <!-- Jurusan & Gelombang -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pilih Jurusan <span class="text-danger">*</span></label>
                <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" id="jurusanSelectBiodata" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}" data-kuota="{{ $j->kuota }}" data-accepted="{{ $j->getAcceptedCount() }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
                @error('jurusan_id')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted d-block mt-2" id="kuotaInfoBiodata"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Gelombang Pendaftaran <span class="text-danger">*</span></label>
                <select name="gelombang_id" class="form-control @error('gelombang_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Gelombang --</option>
                    @foreach($gelombang as $g)
                        <option value="{{ $g->id }}" {{ old('gelombang_id') == $g->id ? 'selected' : '' }}>{{ $g->nama_gelombang }}</option>
                    @endforeach
                </select>
                @error('gelombang_id')
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Tombol Simpan -->
        <button class="btn btn-primary px-4">
            <i class="bi bi-save"></i> Simpan
        </button>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary px-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

    </form>
    @else
        <!-- Data Sudah Tersimpan -->
        <div class="card mt-2 p-3 border-success bg-light">
            <div class="d-flex align-items-center">
                @if(!empty($data->foto))
                    <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto" class="rounded" style="width:96px;height:96px;object-fit:cover;margin-right:16px;">
                @endif
                <div>
                    <h5 class="mb-1"><i class="bi bi-check-circle text-success"></i> Biodata Sudah Tersimpan</h5>
                    <p class="mb-1"><strong>Nama:</strong> {{ $data->nama_lengkap ?? '-' }}</p>
                    <p class="mb-1"><strong>Nomor Pendaftaran:</strong> {{ $data->nomor_pendaftaran ?? '-' }}</p>
                    <p class="mb-1"><strong>Jurusan:</strong> {{ optional($data->jurusan)->nama_jurusan ?? '-' }}</p>
                    <p class="mb-0 text-muted"><small>Terakhir diperbarui: {{ $data->updated_at ? $data->updated_at->format('d M Y H:i') : '-' }}</small></p>
                </div>
            </div>

            <!-- Detail Data -->
            <div class="mt-4 p-3 border-top">
                <h6 class="mb-3"><strong>Detail Biodata</strong></h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p><strong>NISN:</strong> {{ $data->nisn ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p><strong>NIK:</strong> {{ $data->nik ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p><strong>Tempat Lahir:</strong> {{ $data->tempat_lahir ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p><strong>Tanggal Lahir:</strong> {{ $data->tanggal_lahir ? \Carbon\Carbon::parse($data->tanggal_lahir)->format('d M Y') : '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p><strong>Jenis Kelamin:</strong> {{ $data->jenis_kelamin ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p><strong>Agama:</strong> {{ $data->agama ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p><strong>Tinggi Badan:</strong> {{ $data->tinggi_badan ? $data->tinggi_badan . ' cm' : '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p><strong>Berat Badan:</strong> {{ $data->berat_badan ? $data->berat_badan . ' kg' : '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-2">
                        <p><strong>Asal Sekolah:</strong> {{ $data->asal_sekolah ?? '-' }}</p>
                    </div>
                    <div class="col-md-4 mb-2">
                        <p><strong>Anak Ke-:</strong> {{ $data->anak_ke ?? '-' }}</p>
                    </div>
                </div>

                <p class="mb-2"><strong>Alamat Lengkap:</strong> {{ $data->alamat ?? '-' }}</p>

                <div class="row">
                    <div class="col-md-3 mb-2">
                        <p><strong>Kecamatan:</strong> {{ $data->kecamatan ?? '-' }}</p>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p><strong>Kota:</strong> {{ $data->kota ?? '-' }}</p>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p><strong>No. HP:</strong> {{ $data->no_hp ?? '-' }}</p>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p><strong>Gelombang:</strong> {{ optional($data->gelombang)->nama_gelombang ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-4 pt-3 border-top">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-success">
                        <i class="bi bi-check"></i> Lanjut ke Step Berikutnya
                    </a>
                    <a href="{{ route('user.biodata.step1') }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit Data Diri
                    </a>
                    <a href="{{ route('user.biodata.step2') }}" class="btn btn-info">
                        <i class="bi bi-pencil"></i> Edit Alamat & Jurusan
                    </a>
                    <a href="{{ route('user.profile.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i> Lihat Profil Lengkap
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash"></i> Hapus & Isi Ulang
                    </button>
                </div>
            </div>
        </div>
    @endunless
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
    const jurusanSelect = document.getElementById('jurusanSelectBiodata');
    const kuotaInfo = document.getElementById('kuotaInfoBiodata');

    if (!jurusanSelect) return;

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
@endsection