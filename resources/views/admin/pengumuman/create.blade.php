@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h4 class="mb-4">Tambah Pengumuman</h4>

    <form action="{{ route('admin.pengumuman.store') }}" method="POST">
    @csrf


        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi</label>
            <textarea name="isi" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
