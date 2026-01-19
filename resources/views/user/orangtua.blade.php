@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h4 class="mb-4">
        <i class="bi bi-people"></i> Biodata Orang Tua
    </h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($orangTua)
        {{-- Tampilan Data Sudah Diisi --}}
        <div class="alert alert-info">
            <i class="bi bi-check-circle-fill"></i> Data orang tua sudah diisi. Jika perlu diubah, klik tombol "Edit Data".
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5>Data Ayah</h5>
                <table class="table table-borderless">
                    <tr><td><strong>Nama:</strong></td><td>{{ $orangTua->nama_ayah }}</td></tr>
                    <tr><td><strong>Tanggal Lahir:</strong></td><td>{{ $orangTua->tanggal_lahir_ayah ? \Carbon\Carbon::parse($orangTua->tanggal_lahir_ayah)->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td><strong>Pekerjaan:</strong></td><td>{{ $orangTua->pekerjaan_ayah }}</td></tr>
                    <tr><td><strong>Penghasilan:</strong></td><td>Rp {{ number_format($orangTua->penghasilan_ayah, 0, ',', '.') }}</td></tr>
                    <tr><td><strong>Pendidikan:</strong></td><td>{{ $orangTua->pendidikan_ayah }}</td></tr>
                    <tr><td><strong>Alamat:</strong></td><td>{{ $orangTua->alamat_ayah }}</td></tr>
                    <tr><td><strong>No HP:</strong></td><td>{{ $orangTua->no_hp_ayah }}</td></tr>
                    <tr><td><strong>NIK:</strong></td><td>{{ $orangTua->nik_ayah }}</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Data Ibu</h5>
                <table class="table table-borderless">
                    <tr><td><strong>Nama:</strong></td><td>{{ $orangTua->nama_ibu }}</td></tr>
                    <tr><td><strong>Tanggal Lahir:</strong></td><td>{{ $orangTua->tanggal_lahir_ibu ? \Carbon\Carbon::parse($orangTua->tanggal_lahir_ibu)->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td><strong>Pekerjaan:</strong></td><td>{{ $orangTua->pekerjaan_ibu }}</td></tr>
                    <tr><td><strong>Penghasilan:</strong></td><td>Rp {{ number_format($orangTua->penghasilan_ibu, 0, ',', '.') }}</td></tr>
                    <tr><td><strong>Pendidikan:</strong></td><td>{{ $orangTua->pendidikan_ibu }}</td></tr>
                    <tr><td><strong>Alamat:</strong></td><td>{{ $orangTua->alamat_ibu }}</td></tr>
                    <tr><td><strong>No HP:</strong></td><td>{{ $orangTua->no_hp_ibu }}</td></tr>
                    <tr><td><strong>NIK:</strong></td><td>{{ $orangTua->nik_ibu }}</td></tr>
                </table>
            </div>
        </div>

        @if($orangTua->nama_wali)
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Data Wali</h5>
                <table class="table table-borderless">
                    <tr><td><strong>Nama:</strong></td><td>{{ $orangTua->nama_wali }}</td></tr>
                    <tr><td><strong>Tanggal Lahir:</strong></td><td>{{ $orangTua->tanggal_lahir_wali ? \Carbon\Carbon::parse($orangTua->tanggal_lahir_wali)->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td><strong>Pekerjaan:</strong></td><td>{{ $orangTua->pekerjaan_wali }}</td></tr>
                    <tr><td><strong>Penghasilan:</strong></td><td>Rp {{ number_format($orangTua->penghasilan_wali, 0, ',', '.') }}</td></tr>
                    <tr><td><strong>Pendidikan:</strong></td><td>{{ $orangTua->pendidikan_wali }}</td></tr>
                    <tr><td><strong>Alamat:</strong></td><td>{{ $orangTua->alamat_wali }}</td></tr>
                    <tr><td><strong>No HP:</strong></td><td>{{ $orangTua->no_hp_wali }}</td></tr>
                    <tr><td><strong>NIK:</strong></td><td>{{ $orangTua->nik_wali }}</td></tr>
                </table>
            </div>
        </div>
        @endif

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            <button type="button" class="btn btn-warning" onclick="toggleEdit()">Edit Data</button>
        </div>

        <div id="editForm" style="display: none;">
    @else
        {{-- Jika belum ada data, langsung tampilkan form --}}
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('user.orangtua.save') }}" method="POST" id="orangTuaForm">
        @csrf

        <h5>Data Ayah</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $orangTua->nama_ayah ?? '') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir Ayah</label>
                <input type="date" name="tanggal_lahir_ayah" class="form-control" value="{{ old('tanggal_lahir_ayah', $orangTua->tanggal_lahir_ayah ?? '') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $orangTua->pekerjaan_ayah ?? '') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Penghasilan Ayah (per bulan)</label>
                <input type="number" name="penghasilan_ayah" class="form-control" value="{{ old('penghasilan_ayah', $orangTua->penghasilan_ayah ?? '') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat Ayah</label>
                <textarea name="alamat_ayah" class="form-control" rows="2" required>{{ old('alamat_ayah', $orangTua->alamat_ayah ?? '') }}</textarea>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">No HP Ayah</label>
                <input type="text" name="no_hp_ayah" class="form-control" value="{{ old('no_hp_ayah', $orangTua->no_hp_ayah ?? '') }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">NIK Ayah</label>
                <input type="text" name="nik_ayah" class="form-control" value="{{ old('nik_ayah', $orangTua->nik_ayah ?? '') }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Pendidikan Terakhir Ayah</label>
                <select name="pendidikan_ayah" class="form-control" required>
                    <option value="">Pilih Pendidikan</option>
                    <option value="SD" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA/SMK" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                    <option value="D1" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'D1' ? 'selected' : '' }}>D1</option>
                    <option value="D2" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'D2' ? 'selected' : '' }}>D2</option>
                    <option value="D3" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="S1" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'S3' ? 'selected' : '' }}>S3</option>
                    <option value="Lainnya" {{ old('pendidikan_ayah', $orangTua->pendidikan_ayah ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
        </div>

        <hr>

        <h5>Data Ibu</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $orangTua->nama_ibu ?? '') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir Ibu</label>
                <input type="date" name="tanggal_lahir_ibu" class="form-control" value="{{ old('tanggal_lahir_ibu', $orangTua->tanggal_lahir_ibu ?? '') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', $orangTua->pekerjaan_ibu ?? '') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Penghasilan Ibu (per bulan)</label>
                <input type="number" name="penghasilan_ibu" class="form-control" value="{{ old('penghasilan_ibu', $orangTua->penghasilan_ibu ?? '') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat Ibu</label>
                <textarea name="alamat_ibu" class="form-control" rows="2" required>{{ old('alamat_ibu', $orangTua->alamat_ibu ?? '') }}</textarea>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">No HP Ibu</label>
                <input type="text" name="no_hp_ibu" class="form-control" value="{{ old('no_hp_ibu', $orangTua->no_hp_ibu ?? '') }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">NIK Ibu</label>
                <input type="text" name="nik_ibu" class="form-control" value="{{ old('nik_ibu', $orangTua->nik_ibu ?? '') }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Pendidikan Terakhir Ibu</label>
                <select name="pendidikan_ibu" class="form-control" required>
                    <option value="">Pilih Pendidikan</option>
                    <option value="SD" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA/SMK" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                    <option value="D1" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'D1' ? 'selected' : '' }}>D1</option>
                    <option value="D2" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'D2' ? 'selected' : '' }}>D2</option>
                    <option value="D3" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="S1" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'S3' ? 'selected' : '' }}>S3</option>
                    <option value="Lainnya" {{ old('pendidikan_ibu', $orangTua->pendidikan_ibu ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
        </div>

        <hr>

        <h5>Data Wali (Opsional)</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Wali</label>
                <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali', $orangTua->nama_wali ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir Wali</label>
                <input type="date" name="tanggal_lahir_wali" class="form-control" value="{{ old('tanggal_lahir_wali', $orangTua->tanggal_lahir_wali ?? '') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pekerjaan Wali</label>
                <input type="text" name="pekerjaan_wali" class="form-control" value="{{ old('pekerjaan_wali', $orangTua->pekerjaan_wali ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Penghasilan Wali (per bulan)</label>
                <input type="number" name="penghasilan_wali" class="form-control" value="{{ old('penghasilan_wali', $orangTua->penghasilan_wali ?? '') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat Wali</label>
                <textarea name="alamat_wali" class="form-control" rows="2">{{ old('alamat_wali', $orangTua->alamat_wali ?? '') }}</textarea>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">No HP Wali</label>
                <input type="text" name="no_hp_wali" class="form-control" value="{{ old('no_hp_wali', $orangTua->no_hp_wali ?? '') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">NIK Wali</label>
                <input type="text" name="nik_wali" class="form-control" value="{{ old('nik_wali', $orangTua->nik_wali ?? '') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Pendidikan Terakhir Wali</label>
                <select name="pendidikan_wali" class="form-control">
                    <option value="">Pilih Pendidikan</option>
                    <option value="SD" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA/SMK" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                    <option value="D1" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'D1' ? 'selected' : '' }}>D1</option>
                    <option value="D2" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'D2' ? 'selected' : '' }}>D2</option>
                    <option value="D3" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="S1" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'S3' ? 'selected' : '' }}>S3</option>
                    <option value="Lainnya" {{ old('pendidikan_wali', $orangTua->pendidikan_wali ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data Orang Tua</button>
        </div>
    </form>

    @if($orangTua)
        </div> {{-- End of editForm --}}
    @endif
</div>

<script>
function toggleEdit() {
    const form = document.getElementById('editForm');
    const button = document.querySelector('button[onclick="toggleEdit()"]');
    if (form.style.display === 'none') {
        form.style.display = 'block';
        button.textContent = 'Batal Edit';
    } else {
        form.style.display = 'none';
        button.textContent = 'Edit Data';
    }
}
</script>
@endsection