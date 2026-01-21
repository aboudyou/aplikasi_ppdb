<?php $__env->startSection('title', 'Dashboard Siswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Siswa</h3>
    <p class="text-muted mb-4"><small>Ikuti alur pengisian berikut untuk melengkapi data pendaftaran Anda</small></p>
    
    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp border-primary">
                <div class="card-header bg-primary text-white">
                    <span class="badge bg-light text-primary">Step 1</span>
                </div>
                <div class="card-body text-center">
                    <?php if($biodata): ?>
                        <i class="bi bi-check-circle dashboard-icon text-success"></i>
                        <h5 class="card-title mt-3">Biodata</h5>
                        <p class="text-muted"><small>Sudah Tersimpan</small></p>
                        <a href="<?php echo e(route('user.biodata')); ?>" class="btn btn-success btn-sm">Lihat / Edit</a>
                    <?php else: ?>
                        <i class="bi bi-person-lines-fill dashboard-icon text-primary"></i>
                        <h5 class="card-title mt-3">Biodata</h5>
                        <p class="text-muted">Lengkapi data diri kamu</p>
                        <a href="<?php echo e(route('user.biodata')); ?>" class="btn btn-primary btn-sm">Isi Biodata</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.1s;">
                <div class="card-header bg-info text-white">
                    <span class="badge bg-light text-info">Step 2</span>
                </div>
                <div class="card-body text-center">
                    <?php if($orangTua): ?>
                        <i class="bi bi-check-circle dashboard-icon text-success"></i>
                        <h5 class="card-title mt-3">Data Orang Tua</h5>
                        <p class="text-muted"><small>Sudah Tersimpan</small></p>
                        <a href="<?php echo e(route('user.orangtua')); ?>" class="btn btn-success btn-sm">Lihat / Edit</a>
                    <?php else: ?>
                        <i class="bi bi-people dashboard-icon text-info"></i>
                        <h5 class="card-title mt-3">Data Orang Tua</h5>
                        <p class="text-muted">Isi data ayah, ibu, dan wali</p>
                        <a href="<?php echo e(route('user.orangtua')); ?>" class="btn btn-info btn-sm">Isi Data</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.2s;">
                <div class="card-header bg-success text-white">
                    <span class="badge bg-light text-success">Step 3</span>
                </div>
                <div class="card-body text-center">
                    <?php if($dokumen->count() == 5): ?>
                        <i class="bi bi-check-circle dashboard-icon text-success"></i>
                        <h5 class="card-title mt-3">Upload Dokumen</h5>
                        <p class="text-muted"><small>Sudah Lengkap</small></p>
                        <a href="<?php echo e(route('user.dokumen.index')); ?>" class="btn btn-success btn-sm">Lihat / Edit</a>
                    <?php elseif($dokumen->count() > 0): ?>
                        <i class="bi bi-file-earmark-arrow-up dashboard-icon text-warning"></i>
                        <h5 class="card-title mt-3">Upload Dokumen</h5>
                        <p class="text-muted"><small><?php echo e($dokumen->count()); ?>/5 Dokumen</small></p>
                        <a href="<?php echo e(route('user.dokumen.index')); ?>" class="btn btn-warning btn-sm">Lanjutkan</a>
                    <?php else: ?>
                        <i class="bi bi-file-earmark-arrow-up dashboard-icon text-success"></i>
                        <h5 class="card-title mt-3">Upload Dokumen</h5>
                        <p class="text-muted">Unggah berkas persyaratan</p>
                        <a href="<?php echo e(route('user.dokumen.index')); ?>" class="btn btn-success btn-sm">Upload</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.3s;">
                <div class="card-header bg-warning text-dark">
                    <span class="badge bg-light text-warning">Step 4</span>
                </div>
                <div class="card-body text-center">
                    <?php if($pembayaran && $pembayaran->status == 'Lunas'): ?>
                        <i class="bi bi-check-circle dashboard-icon text-success"></i>
                        <h5 class="card-title mt-3">Pembayaran</h5>
                        <p class="text-muted"><small>Sudah Lunas</small></p>
                        <a href="<?php echo e(route('user.pembayaran')); ?>" class="btn btn-success btn-sm">Lihat / Edit</a>
                    <?php else: ?>
                        <i class="bi bi-credit-card dashboard-icon text-warning"></i>
                        <h5 class="card-title mt-3">Pembayaran</h5>
                        <p class="text-muted">Upload bukti pembayaran biaya pendaftaran</p>
                        <a href="<?php echo e(route('user.pembayaran')); ?>" class="btn btn-warning btn-sm">Bayar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.4s;">
                <div class="card-header bg-danger text-white">
                    <span class="badge bg-light text-danger">Step 5</span>
                </div>
                <div class="card-body text-center">
                    <i class="bi bi-check2-circle dashboard-icon text-danger"></i>
                    <h5 class="card-title mt-3">Status Seleksi</h5>
                    <p class="text-muted">Lihat hasil seleksi kamu</p>
                    <a href="<?php echo e(route('user.status')); ?>" class="btn btn-danger btn-sm">Cek Status</a>
                </div>
            </div>
        </div>

        
        <?php if($biodata && $biodata->status_pendaftaran === 'diterima'): ?>
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.45s; border-color: #28a745; border-width: 2px;">
                <div class="card-header bg-success text-white">
                    <span class="badge bg-light text-success">✓ Diterima</span>
                </div>
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-pdf dashboard-icon text-success"></i>
                    <h5 class="card-title mt-3">Surat Penerimaan</h5>
                    <p class="text-muted"><small>Download surat penerimaan Anda</small></p>
                    <a href="<?php echo e(route('user.surat_penerimaan')); ?>" class="btn btn-success btn-sm" target="_blank">
                        <i class="bi bi-download"></i> Unduh PDF
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="col-md-4">
            <div class="card mb-3 animate__animated animate__fadeInUp" style="animation-delay:0.5s;">
                <div class="card-header bg-secondary text-white">
                    <span class="badge bg-light text-secondary">Bonus</span>
                </div>
                <div class="card-body text-center">
                    <i class="bi bi-person-circle dashboard-icon text-secondary"></i>
                    <h5 class="card-title mt-3">Profil Lengkap</h5>
                    <p class="text-muted">Lihat dan verifikasi profil kamu</p>
                    <a href="<?php echo e(route('user.profile.index')); ?>" class="btn btn-secondary btn-sm">Lihat Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/user/dashboard.blade.php ENDPATH**/ ?>