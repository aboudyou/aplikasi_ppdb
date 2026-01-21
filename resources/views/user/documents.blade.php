@extends('layouts.app')

@section('title', 'Upload Dokumen')

@section('content')
<div class="container mt-4">

    <h3 class="fw-bold mb-3"><i class="bi bi-file-earmark-arrow-up"></i> Upload Dokumen</h3>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 5px solid #dc3545;">
            <div style="font-weight: bold; margin-bottom: 8px;">
                <i class="bi bi-exclamation-triangle-fill"></i> Dokumen Sudah Ada!
            </div>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Alert Validation Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 5px solid #dc3545;">
            <div style="font-weight: bold; margin-bottom: 10px;">
                <i class="bi bi-exclamation-circle-fill"></i> Terjadi Kesalahan!
            </div>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($documents->count() == 5)
        {{-- Status Dokumen Lengkap (Seperti Pembayaran Lunas) --}}
        <div class="card border-success mb-3">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0">Status Dokumen</h6>
            </div>
            <div class="card-body text-center">
                <i class="bi bi-check-circle" style="font-size: 2.5rem; color: #28a745;"></i>
                <h5 class="card-title mt-3">Upload Dokumen</h5>
                <p class="text-muted"><strong>Sudah Lengkap</strong></p>
                
                <div class="alert alert-success mt-3 mb-3">
                    <p class="mb-1">Total dokumen yang diupload:</p>
                    <h5 class="text-success mb-0"><strong>5/5 Dokumen</strong></h5>
                </div>
                
                <small class="text-muted d-block mb-3">Semua dokumen yang diperlukan telah diupload. Anda dapat melanjutkan ke tahap berikutnya.</small>
                
                <a href="{{ route('user.dashboard') }}" class="btn btn-success btn-sm">Kembali ke Dashboard</a>
            </div>
        </div>

        {{-- Daftar Dokumen --}}
        <div class="card mt-3 mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-file-earmark-check"></i> Daftar Dokumen Anda</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            @foreach($documents as $doc)
                            <tr>
                                <td>
                                    <i class="bi bi-file-earmark-pdf text-danger"></i>
                                    <strong>{{ $doc->jenis_dokumen }}</strong>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Tersimpan</span>
                                </td>
                                <td class="text-end" style="width: 150px;">
                                    <a href="{{ route('user.dokumen.show', $doc->id) }}" target="_blank" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @elseif($documents->count() > 0)
        {{-- Status Dokumen Sebagian (Proses) --}}
        <div class="card mb-3">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0">Status Dokumen</h6>
            </div>
            <div class="card-body text-center">
                <i class="bi bi-file-earmark-arrow-up" style="font-size: 2.5rem; color: #ffc107;"></i>
                <h5 class="card-title mt-3">Upload Dokumen</h5>
                <p class="text-muted"><strong>Sedang Proses</strong></p>
                
                <div class="alert alert-info mt-3 mb-3">
                    <p class="mb-1">Total dokumen yang diupload:</p>
                    <h5 class="text-primary mb-0"><strong>{{ $documents->count() }}/5 Dokumen</strong></h5>
                </div>
                
                <small class="text-muted d-block mb-3">Silakan upload {{ 5 - $documents->count() }} dokumen lagi untuk melengkapi.</small>
            </div>
        </div>

        {{-- Daftar Dokumen --}}
        <div class="card mt-3 mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-file-earmark-check"></i> Dokumen yang Sudah Diupload</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            @foreach($documents as $doc)
                            <tr>
                                <td>
                                    <i class="bi bi-file-earmark-pdf text-danger"></i>
                                    <strong>{{ $doc->jenis_dokumen }}</strong>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Tersimpan</span>
                                </td>
                                <td class="text-end" style="width: 150px;">
                                    <a href="{{ route('user.dokumen.show', $doc->id) }}" target="_blank" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Form Upload Tambahan --}}
        <div class="upload-form-toggle">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="bi bi-plus-circle"></i> Upload Dokumen Tambahan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.dokumen.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Dokumen <span class="text-danger">*</span></label>
                            <select name="nama_dokumen" class="form-select @error('nama_dokumen') is-invalid @enderror" required>
                                <option value="">-- Pilih Dokumen --</option>
                                @php
                                    $dokumenList = ['Foto 3x4', 'Kartu Keluarga', 'Akte Kelahiran', 'Ijazah / SKL', 'KTP Orang Tua'];
                                    $uploadedDocs = $documents->pluck('jenis_dokumen')->toArray();
                                @endphp
                                @foreach($dokumenList as $dok)
                                    @if(in_array($dok, $uploadedDocs))
                                        <option value="{{ $dok }}" disabled style="color: #ccc;">{{ $dok }} ✓ (Sudah diupload)</option>
                                    @else
                                        <option value="{{ $dok }}" {{ old('nama_dokumen') === $dok ? 'selected' : '' }}>{{ $dok }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('nama_dokumen')
                                <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" 
                                   accept=".pdf,.jpg,.jpeg,.png" required>
                            @error('file')
                                <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle"></i> Tipe: JPG, JPEG, PNG, PDF — Maksimal: 2MB
                            </small>
                        </div>

                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-cloud-upload"></i> Upload Dokumen
                        </button>

                    </form>
                </div>
            </div>
        </div>

    @else
        {{-- Status Belum Ada Dokumen --}}
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">Status Dokumen</h6>
            </div>
            <div class="card-body text-center">
                <i class="bi bi-file-earmark-arrow-up" style="font-size: 2.5rem; color: #17a2b8;"></i>
                <h5 class="card-title mt-3">Upload Dokumen</h5>
                <p class="text-muted"><strong>Belum Ada Dokumen</strong></p>
                
                <div class="alert alert-info mt-3 mb-3">
                    <p class="mb-1">Total dokumen yang diupload:</p>
                    <h5 class="text-primary mb-0"><strong>0/5 Dokumen</strong></h5>
                </div>
                
                <small class="text-muted d-block mb-3">Silakan mulai upload dokumen untuk melengkapi pendaftaran Anda.</small>
            </div>
        </div>

        {{-- Form Upload Awal --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="bi bi-cloud-upload"></i> Upload Dokumen</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user.dokumen.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Dokumen <span class="text-danger">*</span></label>
                        <select name="nama_dokumen" class="form-select @error('nama_dokumen') is-invalid @enderror" required>
                            <option value="">-- Pilih Dokumen --</option>
                            @php
                                $dokumenList = [
                                    'Foto 3x4',
                                    'Kartu Keluarga',
                                    'Akte Kelahiran',
                                    'Ijazah / SKL',
                                    'KTP Orang Tua'
                                ];
                            @endphp
                            @foreach($dokumenList as $dok)
                                <option value="{{ $dok }}" {{ old('nama_dokumen') === $dok ? 'selected' : '' }}>{{ $dok }}</option>
                            @endforeach
                        </select>
                        @error('nama_dokumen')
                            <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih File <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" 
                               accept=".pdf,.jpg,.jpeg,.png" required>
                        @error('file')
                            <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i> Tipe: JPG, JPEG, PNG, PDF — Maksimal: 2MB
                        </small>
                    </div>

                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-cloud-upload"></i> Upload Dokumen
                    </button>

                </form>
            </div>
        </div>
    @endif

</div>
@endsection
