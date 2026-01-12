@extends('layouts.app')

@section('title', 'Verifikasi Berkas')

@section('content')
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-check-circle"></i> Verifikasi Berkas</h3>

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
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-2 opacity-75">Perlu Diverifikasi</h6>
                            <h2 class="mb-0 fw-bold">{{ $pendaftar->where('status_pendaftaran', 'Lengkap')->count() }}</h2>
                        </div>
                        <div class="opacity-75">
                            <i class="ti ti-file-text" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <small class="opacity-75">Berkas menunggu verifikasi</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-2 opacity-75">Sudah Diverifikasi</h6>
                            <h2 class="mb-0 fw-bold">{{ $pendaftar->where('status_pendaftaran', 'Diverifikasi')->count() }}</h2>
                        </div>
                        <div class="opacity-75">
                            <i class="ti ti-shield-check" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <small class="opacity-75">Berkas sudah diverifikasi</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-2 opacity-75">Total Pendaftar</h6>
                            <h2 class="mb-0 fw-bold">{{ $pendaftar->count() }}</h2>
                        </div>
                        <div class="opacity-75">
                            <i class="ti ti-users" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <small class="opacity-75">Total formulir terdaftar</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-3">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="ti ti-file-check me-2 text-primary"></i>Daftar Berkas Pendaftar
                </h5>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Cari pendaftar..." style="width: 250px;">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($pendaftar->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="verifikasiTable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold text-muted">#</th>
                                <th class="border-0 fw-semibold text-muted">Nama Lengkap</th>
                                <th class="border-0 fw-semibold text-muted">NISN</th>
                                <th class="border-0 fw-semibold text-muted">Asal Sekolah</th>
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
                                            {{ strtoupper(substr($p->nama_lengkap ?? $p->user->name ?? 'N', 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $p->nama_lengkap ?? $p->user->name ?? 'N/A' }}</h6>
                                            <small class="text-muted">{{ $p->user->email ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $p->nisn ?? $p->user->nisn ?? 'N/A' }}</td>
                                <td class="fw-semibold">{{ $p->asal_sekolah ?? $p->user->asal_sekolah ?? 'N/A' }}</td>
                                <td>
                                    @php $status = $p->status_pendaftaran ?? null; @endphp
                                    @if($status === 'Draft')
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border-0">
                                            <i class="ti ti-edit me-1"></i>Draft
                                        </span>
                                    @elseif($status === 'Lengkap')
                                        <span class="badge bg-info bg-opacity-10 text-info border-0">
                                            <i class="ti ti-check me-1"></i>Lengkap
                                        </span>
                                    @elseif($status === 'Diverifikasi')
                                        <span class="badge bg-success bg-opacity-10 text-success border-0">
                                            <i class="ti ti-shield-check me-1"></i>Diverifikasi
                                        </span>
                                    @elseif($status === 'diterima')
                                        <span class="badge bg-success bg-opacity-10 text-success border-0">
                                            <i class="ti ti-check-circle me-1"></i>Diterima
                                        </span>
                                    @elseif($status === 'ditolak')
                                        <span class="badge bg-danger bg-opacity-10 text-danger border-0">
                                            <i class="ti ti-x-circle me-1"></i>Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border-0">
                                            Belum Diproses
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.verifikasi.show', $p->id) }}"
                                       class="btn btn-primary btn-sm px-3"
                                       data-bs-toggle="tooltip" title="Periksa Berkas">
                                        <i class="ti ti-eye me-1"></i>Periksa
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="ti ti-file-x text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-muted">Tidak ada data pendaftar</h5>
                    <p class="text-muted">Belum ada berkas yang perlu diverifikasi.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#verifikasiTable tbody tr');

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
