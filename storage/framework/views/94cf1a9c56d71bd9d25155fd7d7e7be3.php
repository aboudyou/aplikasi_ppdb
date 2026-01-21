<?php $__env->startSection('title', 'Upload Dokumen'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h3 class="fw-bold mb-3"><i class="bi bi-file-earmark-arrow-up"></i> Upload Dokumen</h3>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 5px solid #dc3545;">
            <div style="font-weight: bold; margin-bottom: 8px;">
                <i class="bi bi-exclamation-triangle-fill"></i> Dokumen Sudah Ada!
            </div>
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 5px solid #dc3545;">
            <div style="font-weight: bold; margin-bottom: 10px;">
                <i class="bi bi-exclamation-circle-fill"></i> Terjadi Kesalahan!
            </div>
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($documents->count() == 5): ?>
        
        <div class="card border-success mb-3">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0">Status Dokumen</h6>
            </div>
            <div class="card-body text-center">
                <i class="bi bi-check-circle" style="font-size: 2.5rem; color: #28a745;"></i>
                <h5 class="card-title mt-3">Upload Dokumen</h5>
                <p class="text-muted"><strong>Sudah Lengkap</strong></p>
                
                <div class="alert alert-success mt-3 mb-3">
                    <p class="mb-1">Total dokumen yang diupload:</p>
                    <h5 class="text-success mb-0"><strong>5/5 Dokumen</strong></h5>
                </div>
                
                <small class="text-muted d-block mb-3">Semua dokumen yang diperlukan telah diupload. Anda dapat melanjutkan ke tahap berikutnya.</small>
                
                <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-success btn-sm">Kembali ke Dashboard</a>
            </div>
        </div>

        
        <div class="card mt-3 mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-file-earmark-check"></i> Daftar Dokumen Anda</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <i class="bi bi-file-earmark-pdf text-danger"></i>
                                    <strong><?php echo e($doc->jenis_dokumen); ?></strong>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Tersimpan</span>
                                </td>
                                <td class="text-end" style="width: 150px;">
                                    <a href="<?php echo e(route('user.dokumen.show', $doc->id)); ?>" target="_blank" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php elseif($documents->count() > 0): ?>
        
        <div class="card mb-3">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0">Status Dokumen</h6>
            </div>
            <div class="card-body text-center">
                <i class="bi bi-file-earmark-arrow-up" style="font-size: 2.5rem; color: #ffc107;"></i>
                <h5 class="card-title mt-3">Upload Dokumen</h5>
                <p class="text-muted"><strong>Sedang Proses</strong></p>
                
                <div class="alert alert-info mt-3 mb-3">
                    <p class="mb-1">Total dokumen yang diupload:</p>
                    <h5 class="text-primary mb-0"><strong><?php echo e($documents->count()); ?>/5 Dokumen</strong></h5>
                </div>
                
                <small class="text-muted d-block mb-3">Silakan upload <?php echo e(5 - $documents->count()); ?> dokumen lagi untuk melengkapi.</small>
            </div>
        </div>

        
        <div class="card mt-3 mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-file-earmark-check"></i> Dokumen yang Sudah Diupload</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <i class="bi bi-file-earmark-pdf text-danger"></i>
                                    <strong><?php echo e($doc->jenis_dokumen); ?></strong>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Tersimpan</span>
                                </td>
                                <td class="text-end" style="width: 150px;">
                                    <a href="<?php echo e(route('user.dokumen.show', $doc->id)); ?>" target="_blank" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="upload-form-toggle">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="bi bi-plus-circle"></i> Upload Dokumen Tambahan</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('user.dokumen.store')); ?>" method="POST" enctype="multipart/form-data" novalidate>
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Dokumen <span class="text-danger">*</span></label>
                            <select name="nama_dokumen" class="form-select <?php $__errorArgs = ['nama_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- Pilih Dokumen --</option>
                                <?php
                                    $dokumenList = ['Foto 3x4', 'Kartu Keluarga', 'Akte Kelahiran', 'Ijazah / SKL', 'KTP Orang Tua'];
                                    $uploadedDocs = $documents->pluck('jenis_dokumen')->toArray();
                                ?>
                                <?php $__currentLoopData = $dokumenList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($dok, $uploadedDocs)): ?>
                                        <option value="<?php echo e($dok); ?>" disabled style="color: #ccc;"><?php echo e($dok); ?> ✓ (Sudah diupload)</option>
                                    <?php else: ?>
                                        <option value="<?php echo e($dok); ?>" <?php echo e(old('nama_dokumen') === $dok ? 'selected' : ''); ?>><?php echo e($dok); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['nama_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   accept=".pdf,.jpg,.jpeg,.png" required>
                            <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle"></i> Tipe: JPG, JPEG, PNG, PDF — Maksimal: 2MB
                            </small>
                        </div>

                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-cloud-upload"></i> Upload Dokumen
                        </button>

                    </form>
                </div>
            </div>
        </div>

    <?php else: ?>
        
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">Status Dokumen</h6>
            </div>
            <div class="card-body text-center">
                <i class="bi bi-file-earmark-arrow-up" style="font-size: 2.5rem; color: #17a2b8;"></i>
                <h5 class="card-title mt-3">Upload Dokumen</h5>
                <p class="text-muted"><strong>Belum Ada Dokumen</strong></p>
                
                <div class="alert alert-info mt-3 mb-3">
                    <p class="mb-1">Total dokumen yang diupload:</p>
                    <h5 class="text-primary mb-0"><strong>0/5 Dokumen</strong></h5>
                </div>
                
                <small class="text-muted d-block mb-3">Silakan mulai upload dokumen untuk melengkapi pendaftaran Anda.</small>
            </div>
        </div>

        
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="bi bi-cloud-upload"></i> Upload Dokumen</h6>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('user.dokumen.store')); ?>" method="POST" enctype="multipart/form-data" novalidate>
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Dokumen <span class="text-danger">*</span></label>
                        <select name="nama_dokumen" class="form-select <?php $__errorArgs = ['nama_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">-- Pilih Dokumen --</option>
                            <?php
                                $dokumenList = [
                                    'Foto 3x4',
                                    'Kartu Keluarga',
                                    'Akte Kelahiran',
                                    'Ijazah / SKL',
                                    'KTP Orang Tua'
                                ];
                            ?>
                            <?php $__currentLoopData = $dokumenList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dok); ?>" <?php echo e(old('nama_dokumen') === $dok ? 'selected' : ''); ?>><?php echo e($dok); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['nama_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih File <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               accept=".pdf,.jpg,.jpeg,.png" required>
                        <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i> Tipe: JPG, JPEG, PNG, PDF — Maksimal: 2MB
                        </small>
                    </div>

                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-cloud-upload"></i> Upload Dokumen
                    </button>

                </form>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/user/documents.blade.php ENDPATH**/ ?>