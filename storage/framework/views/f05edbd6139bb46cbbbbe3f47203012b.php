

<?php $__env->startSection('content'); ?>
<div class="container-fluid pt-4">
    <div class="row">
        <!-- Biodata Siswa -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">👤 Data Siswa</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>: <?php echo e($formulir->nama_lengkap); ?></td>
                        </tr>
                        <tr>
                            <td><strong>NISN</strong></td>
                            <td>: <?php echo e($formulir->nisn); ?></td>
                        </tr>
                        <tr>
                            <td><strong>NIK</strong></td>
                            <td>: <?php echo e($formulir->nik); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: <?php echo e($formulir->user->email ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>No. HP</strong></td>
                            <td>: <?php echo e($formulir->no_hp); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Jurusan</strong></td>
                            <td>: <?php echo e($formulir->jurusan->nama_jurusan ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Gelombang</strong></td>
                            <td>: <?php echo e($formulir->gelombang->nama_gelombang ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>: 
                                <?php if($formulir->status_berkas === 'Terverifikasi'): ?>
                                    <span class="badge bg-success">✓ Terverifikasi</span>
                                <?php elseif($formulir->status_berkas === 'Ditolak'): ?>
                                    <span class="badge bg-danger">✗ Ditolak</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">⏳ Menunggu</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php if($formulir->catatan_berkas): ?>
                <div class="alert alert-warning">
                    <strong>📝 Catatan:</strong><br>
                    <?php echo e($formulir->catatan_berkas); ?>

                </div>
            <?php endif; ?>
        </div>

        <!-- Daftar Dokumen -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📄 Dokumen (<?php echo e($dokumen->count()); ?> file)</h5>
                </div>
                <div class="card-body">
                    <?php if($dokumen->isEmpty()): ?>
                        <div class="alert alert-warning">
                            ⚠️ Siswa belum mengunggah dokumen apapun
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php $__empty_1 = true; $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <h6 class="card-title">📎 <?php echo e($doc->jenis_dokumen); ?></h6>
                                            <small class="text-muted">
                                                File: <?php echo e($doc->path_file); ?><br>
                                                Upload: <?php echo e($doc->created_at->format('d M Y H:i')); ?>

                                            </small>
                                            <div class="mt-2">
                                                <a href="<?php echo e(route('admin.dokumen.view', $doc->id)); ?>" 
                                                    target="_blank" class="btn btn-sm btn-info">
                                                    👁️ Lihat
                                                </a>
                                                <a href="<?php echo e(route('admin.dokumen.download', $doc->id)); ?>" 
                                                    class="btn btn-sm btn-secondary">
                                                    ⬇️ Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-12">
                                    <p class="text-muted text-center">Tidak ada dokumen</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Aksi Verifikasi -->
            <?php if($formulir->status_berkas !== 'Terverifikasi'): ?>
                <div class="card mt-3">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">⚙️ Aksi Verifikasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="<?php echo e(route('admin.dokumen.approve', $formulir->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success w-100" 
                                        onclick="return confirm('Setujui verifikasi dokumen ini?')">
                                        ✓ Setujui Dokumen
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                    ✗ Tolak Dokumen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-success mt-3">
                    ✓ Dokumen sudah diverifikasi
                </div>
            <?php endif; ?>

            <!-- Back Button -->
            <div class="mt-3">
                <a href="<?php echo e(route('admin.dokumen.index')); ?>" class="btn btn-secondary">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Tolak Dokumen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo e(route('admin.dokumen.reject', $formulir->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Alasan Penolakan *</label>
                        <textarea name="alasan" class="form-control <?php $__errorArgs = ['alasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                            rows="4" placeholder="Jelaskan alasan penolakan dokumen..." required></textarea>
                        <?php $__errorArgs = ['alasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Dokumen</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/dokumen/show.blade.php ENDPATH**/ ?>