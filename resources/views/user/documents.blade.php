@extends('layouts.app')

@section('title', 'Upload Dokumen')

@section('content')
<div class="container mt-4">

    <h3 class="fw-bold mb-3">Upload Dokumen</h3>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Upload --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('user.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Dokumen</label>
                    <select name="nama_dokumen" class="form-select" required>
                        <option value="">-- Pilih Dokumen --</option>
                        <option>Foto 3x4</option>
                        <option>Kartu Keluarga</option>
                        <option>Akte Kelahiran</option>
                        <option>Ijazah / SKL</option>
                        <option>KTP Orang Tua</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih File</label>
                    <input type="file" name="file" class="form-control" required>
                    <small class="text-muted">Tipe: JPG, JPEG, PNG, PDF — Max 2MB</small>
                </div>

                <button class="btn btn-primary">
                    <i class="bi bi-cloud-upload"></i> Upload Dokumen
                </button>

            </form>
        </div>
    </div>

    <h5 class="fw-bold">Daftar Dokumen Anda</h5>

    {{-- List Dokumen --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @if($documents->count() == 0)
                <p class="text-muted">Belum ada dokumen yang diunggah.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Dokumen</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $doc)
                        <tr>
                            <td>{{ $doc->jenis_dokumen }}</td>
                            <td>
                                <a href="{{ asset('uploads/' . $doc->path_file) }}" target="_blank" class="btn btn-sm btn-info text-white">
                                    Lihat
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('user.dokumen.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

</div>
@endsection
