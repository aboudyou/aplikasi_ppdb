

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-megaphone"></i> Daftar Pengumuman</h3>
    <div class="card">
        <div class="card-body">

    <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="btn btn-primary mb-3">
        Tambah Pengumuman
    </a>

    <?php if($data->count() == 0): ?>
        <div class="alert alert-info">Belum ada pengumuman.</div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->judul); ?></td>
                    <td>
                        <span class="badge bg-<?php echo e($item->status == 'aktif' ? 'success' : 'secondary'); ?>">
                            <?php echo e($item->status); ?>

                        </span>
                    </td>
                    <td><?php echo e($item->created_at->format('d M Y')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/pengumuman/index.blade.php ENDPATH**/ ?>