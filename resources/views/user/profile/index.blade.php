@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h4 class="mb-4">Profil Saya</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr><th>Nama</th><td>{{ $biodata->nama_lengkap ?? '-' }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $biodata->jenis_kelamin ?? '-' }}</td></tr>
        <tr><th>No HP</th><td>{{ $biodata->no_hp ?? '-' }}</td></tr>
        <tr><th>Jurusan</th><td>{{ $biodata->jurusan->nama_jurusan ?? '-' }}</td></tr>
        <tr><th>Gelombang</th><td>{{ $biodata->gelombang->nama_gelombang ?? '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $biodata->alamat ?? '-' }}</td></tr>
    </table>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Biodata</a>
</div>
@endsection
