

<?php $__env->startSection('title', 'Laporan Pendaftaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-file-earmark-text"></i> Laporan Pendaftaran</h3>
        <div>
            <a href="<?php echo e(route('admin.laporan.export.csv')); ?>" class="btn btn-sm btn-outline-secondary" target="_blank">Export CSV</a>
            <a href="#" class="btn btn-sm btn-primary">Export PDF</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            <div class="card p-3">
                <small class="text-muted">Total Pendaftar</small>
                <div class="h4"><?php echo e($totalPendaftar); ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card p-3">
                <small class="text-muted">Pendaftar per Jurusan</small>
                <ul class="mb-0 list-unstyled mt-2">
                    <?php $__currentLoopData = $perJurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="d-flex justify-content-between"><span><?php echo e($nama); ?></span><span><?php echo e($jumlah); ?></span></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card p-3">
                <small class="text-muted">Pendaftar per Gelombang</small>
                <ul class="mb-0 list-unstyled mt-2">
                    <?php $__currentLoopData = $perGelombang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="d-flex justify-content-between"><span><?php echo e($nama); ?></span><span><?php echo e($jumlah); ?></span></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Daftar Pendaftar</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Pendaftaran</th>
                            <th>Jurusan</th>
                            <th>Gelombang</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pendaftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($pendaftar->firstItem() + $key); ?></td>
                                <td><?php echo e($p->nama_lengkap); ?></td>
                                <td><?php echo e($p->nomor_pendaftaran ?? '-'); ?></td>
                                <td><?php echo e($p->jurusan->nama_jurusan ?? '-'); ?></td>
                                <td><?php echo e($p->gelombang->nama_gelombang ?? '-'); ?></td>
                                <td><?php echo e($p->status_pendaftaran); ?></td>
                                <td><?php echo e($p->created_at->format('d M Y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($pendaftar->links()); ?>

            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/laporan/index.blade.php ENDPATH**/ ?>