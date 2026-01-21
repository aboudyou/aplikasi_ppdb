

<?php $__env->startSection('content'); ?>
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📋 Verifikasi Dokumen Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <form action="<?php echo e(route('admin.dokumen.index')); ?>" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama/NISN..." 
                                    value="<?php echo e(request('search')); ?>">
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="Lengkap" <?php echo e(request('status') === 'Lengkap' ? 'selected' : ''); ?>>Lengkap</option>
                                    <option value="Terverifikasi" <?php echo e(request('status') === 'Terverifikasi' ? 'selected' : ''); ?>>Terverifikasi</option>
                                    <option value="Ditolak" <?php echo e(request('status') === 'Ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="gelombang_id" class="form-control">
                                    <option value="">Semua Gelombang</option>
                                    <?php $__empty_1 = true; $__currentLoopData = \App\Models\GelombangPendaftaran::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($gel->id); ?>" <?php echo e(request('gelombang_id') == $gel->id ? 'selected' : ''); ?>>
                                            <?php echo e($gel->nama_gelombang); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="jurusan_id" class="form-control">
                                    <option value="">Semua Jurusan</option>
                                    <?php $__empty_1 = true; $__currentLoopData = \App\Models\Jurusan::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($jur->id); ?>" <?php echo e(request('jurusan_id') == $jur->id ? 'selected' : ''); ?>>
                                            <?php echo e($jur->nama_jurusan); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">🔍 Cari</button>
                            </div>
                        </div>
                    </form>

                    <?php if($pendaftar->isEmpty()): ?>
                        <div class="alert alert-info">
                            Tidak ada data pendaftar yang ditemukan
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama / NISN</th>
                                        <th>Jurusan</th>
                                        <th>Gelombang</th>
                                        <th>Dokumen</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $pendaftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($pendaftar->firstItem() + $key); ?></td>
                                            <td>
                                                <strong><?php echo e($item->nama_lengkap); ?></strong><br>
                                                <small class="text-muted">NISN: <?php echo e($item->nisn); ?></small><br>
                                                <small class="text-muted">User: <?php echo e($item->user->name ?? 'N/A'); ?></small>
                                            </td>
                                            <td><?php echo e($item->jurusan->nama_jurusan ?? 'N/A'); ?></td>
                                            <td><?php echo e($item->gelombang->nama_gelombang ?? 'N/A'); ?></td>
                                            <td>
                                                <?php if($item->dokumen->isEmpty()): ?>
                                                    <span class="badge bg-warning">Belum Upload</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success"><?php echo e($item->dokumen->count()); ?> File</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($item->status_berkas === 'Terverifikasi'): ?>
                                                    <span class="badge bg-success">✓ Terverifikasi</span>
                                                <?php elseif($item->status_berkas === 'Ditolak'): ?>
                                                    <span class="badge bg-danger">✗ Ditolak</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">⏳ Menunggu</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('admin.dokumen.show', $item->id)); ?>" 
                                                    class="btn btn-sm btn-info">
                                                    👁️ Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            <?php echo e($pendaftar->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/dokumen/index.blade.php ENDPATH**/ ?>