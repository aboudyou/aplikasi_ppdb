

<?php $__env->startSection('title', 'Verifikasi Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-credit-card"></i> Verifikasi Pembayaran</h3>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <div class="btn-group" role="group">
                <a href="<?php echo e(route('admin.pembayaran.index', ['status' => 'menunggu'])); ?>" class="btn btn-sm <?php echo e((isset($status) && $status=='menunggu') ? 'btn-primary' : 'btn-outline-secondary'); ?>">
                    <i class="bi bi-hourglass-split"></i> Menunggu (<?php echo e($pendingCount ?? 0); ?>)
                </a>
                <a href="<?php echo e(route('admin.pembayaran.index', ['status' => 'lunas'])); ?>" class="btn btn-sm <?php echo e((isset($status) && $status=='lunas') ? 'btn-success' : 'btn-outline-secondary'); ?>">
                    <i class="bi bi-check-circle"></i> Lunas (<?php echo e($verifiedCount ?? 0); ?>)
                </a>
                <a href="<?php echo e(route('admin.pembayaran.index', ['status' => 'all'])); ?>" class="btn btn-sm <?php echo e((isset($status) && $status=='all') ? 'btn-info' : 'btn-outline-secondary'); ?>">
                    <i class="bi bi-list-ul"></i> Semua
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Gelombang</th>
                                <th>Tanggal Upload</th>
                                <th>Jumlah Bayar</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data->isEmpty()): ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox"></i> Belum ada pembayaran
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($loop->iteration); ?></td>
                                    <td class="fw-500"><?php echo e($item->formulir->nama_lengkap); ?></td>
                                    <td>
                                        <span class="badge bg-info"><?php echo e($item->formulir->gelombang->nama_gelombang ?? '-'); ?></span>
                                    </td>
                                <td><?php echo e($item->created_at->format('d-m-Y H:i')); ?></td>
                                <td><strong style="color: #10b981;">Rp <?php echo e(number_format($item->jumlah_bayar ?? 0, 0, ',', '.')); ?></strong></td>
                                <td>
                                    <?php if($item->bukti_bayar): ?>
                                        <a href="<?php echo e(asset('uploads/pembayaran/'.$item->bukti_bayar)); ?>" target="_blank" class="btn btn-sm btn-info">
                                            <i class="bi bi-image"></i> Lihat
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($item->status == 'Lunas'): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning"><i class="bi bi-hourglass-split"></i> Menunggu</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.pembayaran.show', $item->id)); ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/pembayaran/index.blade.php ENDPATH**/ ?>