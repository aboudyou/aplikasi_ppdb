<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Admin</h3>
    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill dashboard-icon text-primary"></i>
                    <h5 class="card-title mt-3">Total Pendaftar</h5>
                    <p class="text-muted"><?php echo e($totalPendaftar); ?> pendaftar terdaftar</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle-fill dashboard-icon text-success"></i>
                    <h5 class="card-title mt-3">Data Lengkap</h5>
                    <p class="text-muted"><?php echo e($lengkap); ?> formulir lengkap</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body text-center">
                    <i class="bi bi-shield-check dashboard-icon text-info"></i>
                    <h5 class="card-title mt-3">Diverifikasi</h5>
                    <p class="text-muted"><?php echo e($diverifikasi); ?> sudah diverifikasi</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card-body text-center">
                    <i class="bi bi-trophy-fill dashboard-icon text-warning"></i>
                    <h5 class="card-title mt-3">Diterima</h5>
                    <p class="text-muted"><?php echo e($lulus); ?> lolos seleksi</p>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card-body text-center">
                    <i class="bi bi-credit-card dashboard-icon text-success"></i>
                    <h5 class="card-title mt-3">Status Pembayaran</h5>
                    <p class="text-muted"><?php echo e($totalPembayaran); ?> lunas, <?php echo e($pembayaranMenunggu); ?> menunggu</p>
                    <a href="<?php echo e(route('admin.pembayaran.index')); ?>" class="btn btn-success btn-sm">Lihat Pembayaran</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up" data-aos-delay="500">
                <div class="card-body text-center">
                    <i class="bi bi-gear dashboard-icon text-primary"></i>
                    <h5 class="card-title mt-3">Informasi Sistem</h5>
                    <p class="text-muted"><?php echo e($totalJurusan); ?> jurusan, <?php echo e($totalGelombang); ?> gelombang</p>
                    <a href="<?php echo e(route('admin.gelombang.index')); ?>" class="btn btn-primary btn-sm">Kelola Sistem</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up" data-aos-delay="600">
                <div class="card-body text-center">
                    <i class="bi bi-lightning dashboard-icon text-warning"></i>
                    <h5 class="card-title mt-3">Aksi Cepat</h5>
                    <p class="text-muted">Tindakan administrasi cepat</p>
                    <div class="d-grid gap-1">
                        <a href="<?php echo e(route('admin.seleksi.index')); ?>" class="btn btn-primary btn-sm">Seleksi</a>
                        <a href="<?php echo e(route('admin.verifikasi.index')); ?>" class="btn btn-info btn-sm">Verifikasi</a>
                        <a href="<?php echo e(route('admin.jurusan.index')); ?>" class="btn btn-success btn-sm">Kelola Jurusan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card mt-4" data-aos="fade-up">
        <div class="card-header">
            <h5><i class="bi bi-clock"></i> Pendaftar Terbaru</h5>
        </div>
        <div class="card-body">
            <?php if($pendaftarTerbaru->count() > 0): ?>
                <div class="list-group list-group-flush">
                    <?php $__currentLoopData = $pendaftarTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?php echo e($p->nama_lengkap); ?></h6>
                                <small><?php echo e($p->created_at->format('d M Y')); ?></small>
                            </div>
                            <p class="mb-1"><?php echo e($p->jurusan->nama_jurusan ?? '-'); ?></p>
                            <small class="text-muted">Status: <?php echo e($p->status_pendaftaran ?? 'Belum Diproses'); ?></small>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-center text-muted">Belum ada pendaftar terbaru.</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="card mt-4" data-aos="fade-up">
        <div class="card-header">
            <h5><i class="bi bi-link"></i> Quick Links</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <a href="<?php echo e(route('admin.log_aktivitas.index')); ?>" class="btn btn-outline-primary w-100">
                        <i class="bi bi-activity"></i> Log Aktivitas
                    </a>
                </div>
                <!-- Tambahkan link lain jika perlu -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>