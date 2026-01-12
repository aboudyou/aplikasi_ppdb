@extends('layouts.app')


@section('content')
<div class="card shadow-sm p-4">
    <h4 class="mb-4">
        <i class="bi bi-file-earmark-text"></i> Formulir Biodata Siswa
    </h4>

    <div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
    </div>

    @unless($data)
    <form action="{{ route('user.biodata.save') }}" method="POST">
        @csrf

        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control">
        </div>

        <!-- NISN & NIK -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control">
            </div>
        </div>

        <!-- Tempat Lahir, Tanggal Lahir -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>
        </div>

        <!-- Jenis Kelamin, Agama -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Jenis Kelamin</label>
                <div>
                    <input type="radio" name="jenis_kelamin" value="L"> Laki-laki
                    &nbsp;&nbsp;
                    <input type="radio" name="jenis_kelamin" value="P"> Perempuan
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Agama</label>
                <select name="agama" class="form-control">
                    <option value="">-- Pilih Agama --</option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Konghucu</option>
                </select>
            </div>
        </div>

        <!-- Tinggi Badan & Berat Badan -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tinggi Badan (cm)</label>
                <input type="number" step="0.01" name="tinggi_badan" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Berat Badan (kg)</label>
                <input type="number" step="0.01" name="berat_badan" class="form-control">
            </div>
        </div>

        <!-- Asal Sekolah & Anak Ke -->
        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label">Asal Sekolah</label>
                <input type="text" name="asal_sekolah" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Anak ke</label>
                <input type="number" name="anak_ke" class="form-control">
            </div>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2"></textarea>
        </div>

        <!-- Desa, Kelurahan, Kecamatan, Kota -->
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Desa</label>
                <input type="text" name="desa" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Kelurahan</label>
                <input type="text" name="kelurahan" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Kota</label>
                <input type="text" name="kota" class="form-control">
            </div>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>

        <!-- Jurusan & Gelombang -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pilih Jurusan</label>
                <select name="jurusan_id" class="form-control">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Gelombang Pendaftaran</label>
                <select name="gelombang_id" class="form-control">
                    <option value="">-- Pilih Gelombang --</option>
                    @foreach($gelombang as $g)
                        <option value="{{ $g->id }}">{{ $g->nama_gelombang }}</option>
                    @endforeach
                </select>
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
        <div class="card mt-2 p-3 border-success bg-light">
            <div class="d-flex align-items-center">
                @if(!empty($data->foto))
                    <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto" class="rounded" style="width:96px;height:96px;object-fit:cover;margin-right:16px;">
                @endif
                <div>
                    <h5 class="mb-1">Biodata sudah tersimpan</h5>
                    <p class="mb-1"><strong>Nama:</strong> {{ $data->nama_lengkap ?? '-' }}</p>
                    <p class="mb-1"><strong>Nomor Pendaftaran:</strong> {{ $data->nomor_pendaftaran ?? '-' }}</p>
                    <p class="mb-1"><strong>Jurusan:</strong> {{ optional($data->jurusan)->nama_jurusan ?? '-' }}</p>
                    <p class="mb-0 text-muted"><small>Terakhir diperbarui: {{ $data->updated_at ? $data->updated_at->format('d M Y H:i') : '-' }}</small></p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('user.profile.index') }}" class="btn btn-outline-primary">Lihat Profil</a>
                <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Edit Profil</a>
            </div>
        </div>
    @endunless
</div>

@endsection