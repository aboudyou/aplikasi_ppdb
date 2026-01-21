

<?php $__env->startSection('title', 'Kelola Gelombang Pendaftaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-calendar-event"></i> Kelola Gelombang Pendaftaran</h3>

    
    <div class="card" data-aos="fade-up">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5><i class="bi bi-list"></i> Daftar Gelombang Pendaftaran</h5>
                <a href="<?php echo e(route('admin.gelombang.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Tambah Gelombang
                </a>
            </div>
        </div>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Cari gelombang..." style="width: 250px;">
                </div>
            </div>
        </div>

        <div class="card-body">
            <?php if($gelombang->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="gelombangTable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold text-muted">#</th>
                                <th class="border-0 fw-semibold text-muted">Nama Gelombang</th>
                                <th class="border-0 fw-semibold text-muted">Periode</th>
                                <th class="border-0 fw-semibold text-muted">Biaya</th>
                                <th class="border-0 fw-semibold text-muted">Kuota</th>
                                <th class="border-0 fw-semibold text-muted">Promo</th>
                                <th class="border-0 fw-semibold text-muted text-center">Status</th>
                                <th class="border-0 fw-semibold text-muted text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $gelombang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-bottom border-light">
                                <td class="fw-semibold text-muted"><?php echo e($loop->iteration); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                            <?php echo e(strtoupper(substr($item->nama_gelombang, 0, 1))); ?>

                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold"><?php echo e($item->nama_gelombang); ?></h6>
                                            <?php if($item->keterangan): ?>
                                                <small class="text-muted"><?php echo e(Str::limit($item->keterangan, 30)); ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted mb-1">
                                            <i class="ti ti-calendar me-1"></i><?php echo e(\Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y')); ?>

                                        </small>
                                        <small class="text-muted">
                                            <i class="ti ti-calendar-off me-1"></i><?php echo e(\Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y')); ?>

                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-success">Rp <?php echo e(number_format($item->nilai ?? 0, 0, ',', '.')); ?></span>
                                        <?php if($item->jenis_promo): ?>
                                            <small class="text-muted">Ada promo</small>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if($item->kuota_maksimal > 0): ?>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="progress" style="height: 6px; width: 80px;">
                                                <div class="progress-bar <?php echo e($item->getJumlahPeserta() >= $item->kuota_maksimal ? 'bg-danger' : 'bg-primary'); ?>"
                                                     style="width: <?php echo e($item->kuota_maksimal > 0 ? min(($item->getJumlahPeserta() / $item->kuota_maksimal) * 100, 100) : 0); ?>%"></div>
                                            </div>
                                            <small class="text-muted fw-semibold"><?php echo e($item->getJumlahPeserta()); ?>/<?php echo e($item->kuota_maksimal); ?></small>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border-0">
                                            <i class="ti ti-infinity me-1"></i>Unlimited
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($item->jenis_promo): ?>
                                        <div class="d-flex flex-column gap-1">
                                            <span class="badge bg-warning bg-opacity-10 text-warning border-0">
                                                <i class="ti ti-discount me-1"></i><?php echo e(ucfirst($item->jenis_promo)); ?>

                                            </span>
                                            <?php if($item->nilai_promo > 0): ?>
                                                <small class="text-muted fw-semibold">
                                                    <?php echo e($item->tipe_nilai_promo === 'persen' ? $item->nilai_promo . '%' : 'Rp ' . number_format($item->nilai_promo, 0, ',', '.')); ?>

                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                        $now = now();
                                        $isActive = $now->between($item->tanggal_mulai, $item->tanggal_selesai);
                                        $isUpcoming = $now->lt($item->tanggal_mulai);
                                        $isExpired = $now->gt($item->tanggal_selesai);
                                    ?>

                                    <?php if($isActive): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border-0">
                                            <i class="ti ti-circle-filled me-1"></i>Aktif
                                        </span>
                                    <?php elseif($isUpcoming): ?>
                                        <span class="badge bg-info bg-opacity-10 text-info border-0">
                                            <i class="ti ti-clock me-1"></i>Akan Datang
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border-0">
                                            <i class="ti ti-calendar-x me-1"></i>Selesai
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="<?php echo e(route('admin.gelombang.edit', $item->id)); ?>"
                                           class="btn btn-outline-primary btn-sm"
                                           data-bs-toggle="tooltip" title="Edit Gelombang">
                                            <i class="ti ti-edit me-1"></i>Edit
                                        </a>
                                        <form action="<?php echo e(route('admin.gelombang.destroy', $item->id)); ?>" method="POST" class="d-inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus gelombang ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="tooltip" title="Hapus Gelombang">
                                                <i class="ti ti-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="ti ti-calendar-x text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-muted">Belum ada gelombang pendaftaran</h5>
                    <p class="text-muted">Buat gelombang pendaftaran pertama untuk memulai proses penerimaan siswa.</p>
                    <a href="<?php echo e(route('admin.gelombang.create')); ?>" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i>Buat Gelombang Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#gelombangTable tbody tr');

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

.progress {
    border-radius: 3px;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/gelombang/index.blade.php ENDPATH**/ ?>