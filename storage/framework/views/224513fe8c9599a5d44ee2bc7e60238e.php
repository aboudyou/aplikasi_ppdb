

<?php $__env->startSection('title', 'Detail Verifikasi Berkas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Detail Verifikasi Berkas</h3>
        <a href="<?php echo e(route('admin.verifikasi.index')); ?>" class="btn btn-sm btn-outline-secondary">Kembali</a>
    </div>

    <?php
        // Support both $formulir (from controller) or $siswa->formulir (older code)
        $form = $formulir ?? ($siswa->formulir ?? null);
    ?>

    <?php if(!$form): ?>
        <div class="alert alert-danger">Formulir tidak ditemukan.</div>
    <?php else: ?>
        <!-- Data Pendaftar -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Data Pendaftar</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Nama Lengkap</small>
                        <strong><?php echo $__env->make('components.empty-field', ['value' => $form->nama_lengkap ?: optional($form->user)->name], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">NISN</small>
                        <strong><?php echo $__env->make('components.empty-field', ['value' => $form->nisn ?: optional($form->user)->nisn], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Asal Sekolah</small>
                        <strong><?php echo $__env->make('components.empty-field', ['value' => $form->asal_sekolah ?: optional($form->user)->asal_sekolah], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Jenis Kelamin</small>
                        <strong><?php echo $__env->make('components.empty-field', ['value' => $form->jenis_kelamin], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Tempat Lahir</small>
                        <strong><?php echo $__env->make('components.empty-field', ['value' => $form->tempat_lahir], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Tanggal Lahir</small>
                        <strong>
                            <?php if($form->tanggal_lahir): ?>
                                <?php echo e(\Carbon\Carbon::parse($form->tanggal_lahir)->format('d-m-Y')); ?>

                            <?php else: ?>
                                <?php echo $__env->make('components.empty-field', ['value' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">No. HP</small>
                        <strong><?php echo $__env->make('components.empty-field', ['value' => $form->no_hp], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></strong>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Alamat</small>
                        <strong><?php echo $__env->make('components.empty-field', ['value' => $form->alamat], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Status Pendaftaran</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Status Saat Ini</small>
                        <strong>
                            <?php $status = $form->status_pendaftaran ?? null; ?>
                            <?php if($status === 'Draft'): ?>
                                <span class="badge bg-secondary">Draft</span>
                            <?php elseif($status === 'Lengkap'): ?>
                                <span class="badge bg-info text-dark">Lengkap</span>
                            <?php elseif($status === 'Diverifikasi'): ?>
                                <span class="badge bg-success">Diverifikasi</span>
                            <?php elseif($status === 'Lulus'): ?>
                                <span class="badge bg-success">Lulus</span>
                            <?php elseif($status === 'Tidak Lulus'): ?>
                                <span class="badge bg-danger">Tidak Lulus</span>
                            <?php else: ?>
                                <span class="text-muted">— Belum diisi</span>
                            <?php endif; ?>
                        </strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aksi -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Aksi Verifikasi</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Pilih aksi untuk melanjutkan verifikasi pendaftar ini.</p>
                <form action="<?php echo e(route('admin.verifikasi.approve', $form->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Setujui
                    </button>
                </form>

                <form action="<?php echo e(route('admin.verifikasi.reject', $form->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menolak pendaftar ini?')">
                        <i class="bi bi-x-circle"></i> Tolak
                    </button>
                </form>

                <a href="<?php echo e(route('admin.verifikasi.index')); ?>" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/verifikasi/show.blade.php ENDPATH**/ ?>