@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📋 Verifikasi Dokumen Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <form action="{{ route('admin.dokumen.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama/NISN..." 
                                    value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="Lengkap" {{ request('status') === 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
                                    <option value="Terverifikasi" {{ request('status') === 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                    <option value="Ditolak" {{ request('status') === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="gelombang_id" class="form-control">
                                    <option value="">Semua Gelombang</option>
                                    @forelse(\App\Models\GelombangPendaftaran::all() as $gel)
                                        <option value="{{ $gel->id }}" {{ request('gelombang_id') == $gel->id ? 'selected' : '' }}>
                                            {{ $gel->nama_gelombang }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="jurusan_id" class="form-control">
                                    <option value="">Semua Jurusan</option>
                                    @forelse(\App\Models\Jurusan::all() as $jur)
                                        <option value="{{ $jur->id }}" {{ request('jurusan_id') == $jur->id ? 'selected' : '' }}>
                                            {{ $jur->nama_jurusan }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">🔍 Cari</button>
                            </div>
                        </div>
                    </form>

                    @if($pendaftar->isEmpty())
                        <div class="alert alert-info">
                            Tidak ada data pendaftar yang ditemukan
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama / NISN</th>
                                        <th>Jurusan</th>
                                        <th>Gelombang</th>
                                        <th>Dokumen</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendaftar as $key => $item)
                                        <tr>
                                            <td>{{ $pendaftar->firstItem() + $key }}</td>
                                            <td>
                                                <strong>{{ $item->nama_lengkap }}</strong><br>
                                                <small class="text-muted">NISN: {{ $item->nisn }}</small><br>
                                                <small class="text-muted">User: {{ $item->user->name ?? 'N/A' }}</small>
                                            </td>
                                            <td>{{ $item->jurusan->nama_jurusan ?? 'N/A' }}</td>
                                            <td>{{ $item->gelombang->nama_gelombang ?? 'N/A' }}</td>
                                            <td>
                                                @if($item->dokumen->isEmpty())
                                                    <span class="badge bg-warning">Belum Upload</span>
                                                @else
                                                    <span class="badge bg-success">{{ $item->dokumen->count() }} File</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status_berkas === 'Terverifikasi')
                                                    <span class="badge bg-success">✓ Terverifikasi</span>
                                                @elseif($item->status_berkas === 'Ditolak')
                                                    <span class="badge bg-danger">✗ Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning">⏳ Menunggu</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.dokumen.show', $item->id) }}" 
                                                    class="btn btn-sm btn-info">
                                                    👁️ Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $pendaftar->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
