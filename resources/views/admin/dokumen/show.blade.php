@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="row">
        <!-- Biodata Siswa -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">👤 Data Siswa</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>: {{ $formulir->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td><strong>NISN</strong></td>
                            <td>: {{ $formulir->nisn }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIK</strong></td>
                            <td>: {{ $formulir->nik }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: {{ $formulir->user->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>No. HP</strong></td>
                            <td>: {{ $formulir->no_hp }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jurusan</strong></td>
                            <td>: {{ $formulir->jurusan->nama_jurusan ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Gelombang</strong></td>
                            <td>: {{ $formulir->gelombang->nama_gelombang ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>: 
                                @if($formulir->status_berkas === 'Terverifikasi')
                                    <span class="badge bg-success">✓ Terverifikasi</span>
                                @elseif($formulir->status_berkas === 'Ditolak')
                                    <span class="badge bg-danger">✗ Ditolak</span>
                                @else
                                    <span class="badge bg-warning">⏳ Menunggu</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($formulir->catatan_berkas)
                <div class="alert alert-warning">
                    <strong>📝 Catatan:</strong><br>
                    {{ $formulir->catatan_berkas }}
                </div>
            @endif
        </div>

        <!-- Daftar Dokumen -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📄 Dokumen ({{ $dokumen->count() }} file)</h5>
                </div>
                <div class="card-body">
                    @if($dokumen->isEmpty())
                        <div class="alert alert-warning">
                            ⚠️ Siswa belum mengunggah dokumen apapun
                        </div>
                    @else
                        <div class="row">
                            @forelse($dokumen as $doc)
                                <div class="col-md-6 mb-3">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <h6 class="card-title">📎 {{ $doc->jenis_dokumen }}</h6>
                                            <small class="text-muted">
                                                File: {{ $doc->path_file }}<br>
                                                Upload: {{ $doc->created_at->format('d M Y H:i') }}
                                            </small>
                                            <div class="mt-2">
                                                <a href="{{ route('admin.dokumen.view', $doc->id) }}" 
                                                    target="_blank" class="btn btn-sm btn-info">
                                                    👁️ Lihat
                                                </a>
                                                <a href="{{ route('admin.dokumen.download', $doc->id) }}" 
                                                    class="btn btn-sm btn-secondary">
                                                    ⬇️ Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-muted text-center">Tidak ada dokumen</p>
                                </div>
                            @endforelse
                        </div>
                    @endif
                </div>
            </div>

            <!-- Aksi Verifikasi -->
            @if($formulir->status_berkas !== 'Terverifikasi')
                <div class="card mt-3">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">⚙️ Aksi Verifikasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('admin.dokumen.approve', $formulir->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100" 
                                        onclick="return confirm('Setujui verifikasi dokumen ini?')">
                                        ✓ Setujui Dokumen
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                    ✗ Tolak Dokumen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-success mt-3">
                    ✓ Dokumen sudah diverifikasi
                </div>
            @endif

            <!-- Back Button -->
            <div class="mt-3">
                <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Tolak Dokumen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.dokumen.reject', $formulir->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Alasan Penolakan *</label>
                        <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" 
                            rows="4" placeholder="Jelaskan alasan penolakan dokumen..." required></textarea>
                        @error('alasan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Dokumen</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
