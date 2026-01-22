

<?php $__env->startSection('title', 'Log Aktivitas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-activity"></i> Log Aktivitas</h3>
    <div class="row g-4">
        <div class="col-12">
            <div class="card" data-aos="fade-up">
                <div class="card-header">
                    <h5 class="card-title mb-0">Riwayat Aktivitas Pengguna</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th><i class="bi bi-person"></i> User</th>
                                    <th><i class="bi bi-lightning"></i> Aktivitas</th>
                                    <th><i class="bi bi-chat-dots"></i> Deskripsi</th>
                                    <th><i class="bi bi-globe"></i> IP Address</th>
                                    <th><i class="bi bi-clock"></i> Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration + ($logs->currentPage() - 1) * $logs->perPage()); ?></td>
                                        <td>
                                            <strong><?php echo e($log->user->name ?? 'N/A'); ?></strong>
                                            <br><small class="text-muted"><?php echo e($log->user->email ?? ''); ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?php echo e($log->aktivitas); ?></span>
                                        </td>
                                        <td><?php echo e($log->deskripsi ?: '-'); ?></td>
                                        <td><code><?php echo e($log->ip_address ?: '-'); ?></code></td>
                                        <td><?php echo e($log->created_at->format('d M Y H:i:s')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="bi bi-info-circle text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">Belum ada log aktivitas.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($logs->hasPages()): ?>
                        <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4">
                            <ul class="pagination">
                                
                                <?php if($logs->onFirstPage()): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">← Previous</span>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($logs->previousPageUrl()); ?>">← Previous</a>
                                    </li>
                                <?php endif; ?>

                                
                                <?php $__currentLoopData = $logs->getUrlRange(1, $logs->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($page == $logs->currentPage()): ?>
                                        <li class="page-item active">
                                            <span class="page-link"><?php echo e($page); ?></span>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                                <?php if($logs->hasMorePages()): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($logs->nextPageUrl()); ?>">Next →</a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">Next →</span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/log_aktivitas/index.blade.php ENDPATH**/ ?>