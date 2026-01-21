

<?php $__env->startSection('title', 'Detail Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="mb-1"><i class="bi bi-receipt"></i> Detail Pembayaran</h1>
                <p class="text-muted mb-0">Verifikasi bukti pembayaran dari calon siswa</p>
            </div>
            <a href="<?php echo e(route('admin.pembayaran.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">
            <!-- Informasi Pembayaran -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4"><i class="bi bi-person-circle"></i> Data Pembayar</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Nama Siswa</p>
                                <h6 class="mb-0"><?php echo e($data->formulir->nama_lengkap); ?></h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Gelombang</p>
                                <h6 class="mb-0">
                                    <span class="badge bg-info"><?php echo e($data->formulir->gelombang->nama_gelombang ?? '-'); ?></span>
                                </h6>
                            </div>
                        </div>
                        <hr>
                        <h5 class="card-title mb-4"><i class="bi bi-credit-card"></i> Detail Pembayaran</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Metode Pembayaran</p>
                                <h6 class="mb-0"><?php echo e($data->metode_bayar); ?></h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Jumlah Bayar</p>
                                <h5 class="mb-0" style="color: #10b981;">Rp <?php echo e(number_format($data->jumlah_bayar ?? 0, 0, ',', '.')); ?></h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Tanggal Upload</p>
                                <h6 class="mb-0"><?php echo e($data->created_at->format('d M Y H:i')); ?></h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Status</p>
                                <h6 class="mb-0">
                                    <?php if($data->status == 'Menunggu'): ?>
                                        <span class="badge bg-warning">
                                            <i class="bi bi-hourglass-split"></i> Menunggu Verifikasi
                                        </span>
                                    <?php elseif($data->status == 'Lunas'): ?>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> Lunas
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?php echo e(ucfirst($data->status)); ?></span>
                                    <?php endif; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4"><i class="bi bi-image"></i> Bukti Pembayaran</h5>
                        <?php if($data->bukti_bayar): ?>
                            <div class="text-center mb-3">
                                <img src="<?php echo e(asset('uploads/pembayaran/'.$data->bukti_bayar)); ?>" class="img-fluid rounded" style="max-width: 100%; max-height: 500px; object-fit: cover;">
                            </div>
                            <a href="<?php echo e(asset('uploads/pembayaran/'.$data->bukti_bayar)); ?>" target="_blank" class="btn btn-sm btn-info w-100">
                                <i class="bi bi-download"></i> Download Bukti
                            </a>
                        <?php else: ?>
                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-exclamation-triangle"></i> Tidak ada bukti pembayaran
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Action Panel -->
            <div class="col-lg-4">
                <?php if($data->status == 'Menunggu'): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><i class="bi bi-shield-check"></i> Verifikasi</h5>
                            <p class="text-muted small mb-3">Periksa kembali data pembayaran sebelum memverifikasi</p>
                            
                            <form action="<?php echo e(route('admin.pembayaran.approve', $data->id)); ?>" method="POST" class="mb-2">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-success w-100 mb-2">
                                    <i class="bi bi-check-circle"></i> Terima Pembayaran
                                </button>
                            </form>

                            <form action="<?php echo e(route('admin.pembayaran.reject', $data->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Yakin ingin menolak pembayaran ini?')">
                                    <i class="bi bi-x-circle"></i> Tolak Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success mb-0">
                                <i class="bi bi-check-circle"></i>
                                <strong>Sudah Diverifikasi</strong>
                                <p class="small mt-2 mb-0">Pembayaran ini telah diverifikasi oleh admin pada <?php echo e($data->verified_at->format('d M Y H:i')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/pembayaran/show.blade.php ENDPATH**/ ?>