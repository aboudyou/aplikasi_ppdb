@extends('layouts.app')

@section('title', 'Seleksi Pendaftar')

@section('content')
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-list-check"></i> Seleksi Pendaftar</h3>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="ti ti-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-2 opacity-75">Menunggu Seleksi</h6>
                            <h2 class="mb-0 fw-bold">{{ $pendaftar->count() }}</h2>
                        </div>
                        <div class="opacity-75">
                            <i class="ti ti-clock-pause" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-2 opacity-75">Total Diterima</h6>
                            <h2 class="mb-0 fw-bold">{{ $pendaftar->where('status_pendaftaran', 'diterima')->count() }}</h2>
                        </div>
                        <div class="opacity-75">
                            <i class="ti ti-check-circle" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-2 opacity-75">Total Ditolak</h6>
                            <h2 class="mb-0 fw-bold">{{ $pendaftar->where('status_pendaftaran', 'ditolak')->count() }}</h2>
                        </div>
                        <div class="opacity-75">
                            <i class="ti ti-x-circle" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-2 opacity-75">Proses Selesai</h6>
                            <h2 class="mb-0 fw-bold">{{ $pendaftar->whereIn('status_pendaftaran', ['diterima', 'ditolak'])->count() }}</h2>
                        </div>
                        <div class="opacity-75">
                            <i class="ti ti-trophy" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-3">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="ti ti-users me-2 text-primary"></i>Daftar Calon Siswa
                </h5>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Cari siswa..." style="width: 250px;">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($pendaftar->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="seleksiTable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold text-muted">#</th>
                                <th class="border-0 fw-semibold text-muted">Nama Lengkap</th>
                                <th class="border-0 fw-semibold text-muted">NISN</th>
                                <th class="border-0 fw-semibold text-muted">Jurusan</th>
                                <th class="border-0 fw-semibold text-muted">Gelombang</th>
                                <th class="border-0 fw-semibold text-muted">Status</th>
                                <th class="border-0 fw-semibold text-muted text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftar as $p)
                            <tr class="border-bottom border-light">
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                            {{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $p->nama_lengkap }}</h6>
                                            <small class="text-muted">{{ $p->user->email ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $p->nisn }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $p->jurusan->nama_jurusan }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border-0">{{ $p->gelombang->nama_gelombang }}</span>
                                </td>
                                <td>
                                    @if($p->status_pendaftaran == 'Draft')
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border-0">
                                            <i class="ti ti-edit me-1"></i>Draft
                                        </span>
                                    @elseif($p->status_pendaftaran == 'Lengkap')
                                        <span class="badge bg-info bg-opacity-10 text-info border-0">
                                            <i class="ti ti-check me-1"></i>Lengkap
                                        </span>
                                    @elseif($p->status_pendaftaran == 'Diverifikasi')
                                        <span class="badge bg-primary bg-opacity-10 text-primary border-0">
                                            <i class="ti ti-shield-check me-1"></i>Diverifikasi
                                        </span>
                                    @elseif($p->status_pendaftaran == 'diterima')
                                        <span class="badge bg-success bg-opacity-10 text-success border-0">
                                            <i class="ti ti-check-circle me-1"></i>Diterima
                                        </span>
                                    @elseif($p->status_pendaftaran == 'ditolak')
                                        <span class="badge bg-danger bg-opacity-10 text-danger border-0">
                                            <i class="ti ti-x-circle me-1"></i>Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border-0">
                                            {{ $p->status_pendaftaran ?? 'Belum Diproses' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($p->status_pendaftaran == 'Diverifikasi')
                                        <div class="d-flex gap-2 justify-content-center">
                                            <form action="{{ route('admin.seleksi.update', $p->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status_pendaftaran" value="diterima">
                                                <button type="submit" class="btn btn-success btn-sm px-3"
                                                        onclick="return confirm('Apakah Anda yakin ingin MENERIMA siswa ini?')"
                                                        data-bs-toggle="tooltip" title="Terima Siswa">
                                                    <i class="ti ti-check me-1"></i>Terima
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.seleksi.update', $p->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status_pendaftaran" value="ditolak">
                                                <button type="submit" class="btn btn-danger btn-sm px-3"
                                                        onclick="return confirm('Apakah Anda yakin ingin MENOLAK siswa ini?')"
                                                        data-bs-toggle="tooltip" title="Tolak Siswa">
                                                    <i class="ti ti-x me-1"></i>Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted small">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="ti ti-users text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-muted">Tidak ada data pendaftar</h5>
                    <p class="text-muted">Belum ada siswa yang siap untuk diseleksi.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#seleksiTable tbody tr');

    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

<style>
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,123,255,0.05);
}

.avatar {
    flex-shrink: 0;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.badge {
    font-weight: 500;
    padding: 0.375rem 0.75rem;
}

.alert {
    border-radius: 12px;
}
</style>
@endsection
