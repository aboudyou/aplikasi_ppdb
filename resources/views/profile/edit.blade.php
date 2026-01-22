@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Profil
                    </h5>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Ada kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($biodata)
                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Foto Profil -->
                            <div class="mb-4">
                                <label class="form-label">Foto Profil</label>
                                <div class="text-center mb-3">
                                    @if($biodata->foto)
                                        <img src="{{ asset('storage/' . $biodata->foto) }}" alt="Foto Profil" 
                                            id="fotoPreview" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <div id="fotoPreview" class="rounded-circle bg-light shadow d-inline-flex align-items-center justify-content-center" 
                                            style="width: 150px; height: 150px;">
                                            <i class="bi bi-camera-fill" style="font-size: 3rem; color: #ccc;"></i>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg" id="fotoInput">
                                <small class="text-muted">Format: JPG, PNG | Maksimal: 2MB</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" class="form-control" 
                                    value="{{ old('nama_lengkap', $biodata->nama_lengkap) }}" required>
                            </div>

                            <!-- NISN & NIK -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NISN *</label>
                                    <input type="text" name="nisn" class="form-control" 
                                        value="{{ old('nisn', $biodata->nisn) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK *</label>
                                    <input type="text" name="nik" class="form-control" 
                                        value="{{ old('nik', $biodata->nik) }}" required>
                                </div>
                            </div>

                            <!-- Tempat & Tanggal Lahir -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat Lahir *</label>
                                    <input type="text" name="tempat_lahir" class="form-control" 
                                        value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" 
                                        value="{{ old('tanggal_lahir', $biodata->tanggal_lahir) }}" required>
                                </div>
                            </div>

                            <!-- Jenis Kelamin & Agama -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin *</label>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                                value="L" id="lakiLaki" 
                                                {{ old('jenis_kelamin', $biodata->jenis_kelamin === 'Laki-laki' ? 'L' : 'P') === 'L' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="lakiLaki">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                                value="P" id="perempuan"
                                                {{ old('jenis_kelamin', $biodata->jenis_kelamin === 'Laki-laki' ? 'L' : 'P') === 'P' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agama *</label>
                                    <select name="agama" class="form-select" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam" {{ old('agama', $biodata->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama', $biodata->agama) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama', $biodata->agama) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama', $biodata->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama', $biodata->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama', $biodata->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Data Fisik -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" name="tinggi_badan" class="form-control" 
                                        value="{{ old('tinggi_badan', $biodata->tinggi_badan) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Berat Badan (kg)</label>
                                    <input type="number" name="berat_badan" class="form-control" 
                                        value="{{ old('berat_badan', $biodata->berat_badan) }}">
                                </div>
                            </div>

                            <!-- Asal Sekolah & Anak Ke -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" class="form-control" 
                                        value="{{ old('asal_sekolah', $biodata->asal_sekolah) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Anak Ke-</label>
                                    <input type="number" name="anak_ke" class="form-control" 
                                        value="{{ old('anak_ke', $biodata->anak_ke) }}" min="1">
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label class="form-label">Alamat *</label>
                                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $biodata->alamat) }}</textarea>
                            </div>

                            <!-- Desa/Kelurahan & Kecamatan -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Desa/Kelurahan</label>
                                    <input type="text" name="kelurahan" class="form-control" 
                                        value="{{ old('kelurahan', $biodata->kelurahan_desa) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control" 
                                        value="{{ old('kecamatan', $biodata->kecamatan) }}">
                                </div>
                            </div>

                            <!-- Kota & No HP -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota/Kabupaten</label>
                                    <input type="text" name="kota" class="form-control" 
                                        value="{{ old('kota', $biodata->kota) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. HP</label>
                                    <input type="text" name="no_hp" class="form-control" 
                                        value="{{ old('no_hp', $biodata->no_hp) }}">
                                </div>
                            </div>

                            <!-- Jurusan & Gelombang -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jurusan Pilihan *</label>
                                    <select name="jurusan_id" class="form-select" required>
                                        <option value="">-- Pilih Jurusan --</option>
                                        @foreach($jurusan as $jur)
                                            <option value="{{ $jur->id }}" 
                                                {{ old('jurusan_id', $biodata->jurusan_id) == $jur->id ? 'selected' : '' }}>
                                                {{ $jur->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gelombang Pendaftaran *</label>
                                    <select name="gelombang_id" class="form-select" required>
                                        <option value="">-- Pilih Gelombang --</option>
                                        @foreach($gelombang as $gel)
                                            <option value="{{ $gel->id }}" 
                                                {{ old('gelombang_id', $biodata->gelombang_id) == $gel->id ? 'selected' : '' }}>
                                                {{ $gel->nama_gelombang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('user.profile.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Batal
                                </a>
                            </div>
                        </form>

                        <!-- Tombol Hapus Biodata -->
                        <div class="alert alert-danger mt-4">
                            <h6 class="alert-heading">⚠️ Danger Zone</h6>
                            <p class="mb-3">Hapus semua biodata Anda jika ada kesalahan data dan ingin mengisinya kembali dari awal.</p>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash"></i> Hapus & Isi Ulang Biodata
                            </button>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> Data biodata tidak ditemukan. 
                            <a href="{{ route('user.biodata') }}">Silakan isi biodata terlebih dahulu</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
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
    // Preview foto saat user memilih file
    document.getElementById('fotoInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('fotoPreview');
                preview.innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 100%; object-fit: cover;" class="rounded-circle">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
