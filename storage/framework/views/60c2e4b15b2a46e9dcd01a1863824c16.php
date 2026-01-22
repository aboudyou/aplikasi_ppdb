

<?php $__env->startSection('title', 'Kelola Jurusan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-book"></i> Kelola Jurusan</h3>

    
    <div class="row g-4 mb-4" style="margin-left: -20px;">
        
        <div class="col-md-4">
            <div class="card mb-3" data-aos="fade-up">
                <div class="card-body text-center">
                    <i class="bi bi-book dashboard-icon text-primary"></i>
                    <h5 class="card-title mt-3">Total Jurusan</h5>
                    <p class="text-muted"><?php echo e($jurusan->count()); ?> jurusan</p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card" data-aos="fade-up">
        <div class="card-header">
            <h5>Daftar Jurusan</h5>
            <a href="<?php echo e(route('admin.jurusan.create')); ?>" class="btn btn-primary">Tambah Jurusan</a>
        </div>
        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Jurusan</th>
                            <th>Kuota</th>
                            <th>Diterima</th>
                            <th>Sisa Kuota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($j->id); ?></td>
                                <td><?php echo e($j->nama_jurusan); ?></td>
                                <td>
                                    <?php if($j->kuota > 0): ?>
                                        <span class="badge bg-info"><?php echo e($j->kuota); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tanpa Batas</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-warning"><?php echo e($j->getAcceptedCount()); ?></span>
                                </td>
                                <td>
                                    <?php if($j->kuota > 0): ?>
                                        <?php if($j->getAvailableQuota() > 0): ?>
                                            <span class="badge bg-success"><?php echo e($j->getAvailableQuota()); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">0 (Penuh)</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.jurusan.edit', $j->id)); ?>" class="btn btn-sm btn-warning" style="width: 70px;">Edit</a>
                                    <form action="<?php echo e(route('admin.jurusan.destroy', $j->id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" style="width: 70px;" onclick="return confirm('Yakin hapus jurusan ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada jurusan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/jurusan/index.blade.php ENDPATH**/ ?>