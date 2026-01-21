

<?php $__env->startSection('content'); ?>
<div class="card shadow-sm p-4">
    <h4 class="mb-4">Tambah Pengumuman</h4>

    <form action="<?php echo e(route('admin.pengumuman.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>


        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi</label>
            <textarea name="isi" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/pengumuman/create.blade.php ENDPATH**/ ?>