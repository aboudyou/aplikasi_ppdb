<?php $__env->startSection('content'); ?>
<div class="container">
    <h3 class="mb-4">Status Seleksi</h3>

    
    <?php if($status): ?>
        <div class="card p-4">
            <h5>
                Status:
                <?php if($status->status_pendaftaran == 'diterima'): ?>
                    <span class="badge bg-success">Diterima</span>
                <?php elseif($status->status_pendaftaran == 'ditolak'): ?>
                    <span class="badge bg-danger">Ditolak</span>
                <?php elseif($status->status_pendaftaran == 'pending'): ?>
                    <span class="badge bg-secondary">Menunggu Verifikasi</span>
                <?php else: ?>
                    <span class="badge bg-secondary"><?php echo e($status->status_pendaftaran); ?></span>
                <?php endif; ?>
            </h5>

            
            <?php if($status->keterangan ?? false): ?>
                <p>Keterangan: <?php echo e($status->keterangan); ?></p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        
        <div class="alert alert-warning mt-3">
            Anda belum mengisi formulir pendaftaran.
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/user/status.blade.php ENDPATH**/ ?>