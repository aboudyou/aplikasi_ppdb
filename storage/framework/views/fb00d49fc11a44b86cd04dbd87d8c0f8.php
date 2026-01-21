

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        
        
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-primary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">1</div>
                    <p class="mt-2 mb-0 fw-semibold text-primary">Data Diri</p>
                    <small class="text-muted">Saat Ini</small>
                </div>
                
                <div style="flex: 1; height: 2px; background-color: #ddd; margin: 0 10px; margin-top: 20px;"></div>
                
                <div class="text-center" style="flex: 1;">
                    <div class="badge bg-secondary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">2</div>
                    <p class="mt-2 mb-0">Alamat & Jurusan</p>
                    <small class="text-muted">Selanjutnya</small>
                </div>
            </div>
        </div>

        <h4 class="mb-4">
            <i class="bi bi-file-earmark-text"></i> Biodata Siswa - Data Diri
        </h4>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 5px solid #dc3545;">
                <div style="font-weight: bold; margin-bottom: 10px;">
                    <i class="bi bi-exclamation-triangle-fill"></i> Data Anda Ada Kesalahan!
                </div>
                <p style="margin-bottom: 10px; font-size: 14px;">Mohon perbaiki error berikut sebelum lanjut:</p>
                <ul class="mb-0" style="margin-left: 15px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="margin-bottom: 5px;"><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="alert alert-info mb-4" role="alert">
            <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Isi semua field yang bertanda <span class="text-danger">*</span> dengan data yang benar.
        </div>

        <form action="<?php echo e(route('user.biodata.store.step1')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <!-- Nama Lengkap -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_lengkap" class="form-control <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       pattern="[a-zA-Z\s]+" placeholder="Contoh: Muhammad Reza Hidayat" required
                       value="<?php echo e(old('nama_lengkap')); ?>">
                <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="text-muted">Hanya huruf dan spasi, tanpa angka atau simbol</small>
            </div>

            <!-- NISN & NIK -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NISN (10 Angka) <span class="text-danger">*</span></label>
                    <input type="number" name="nisn" class="form-control <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           inputmode="numeric" placeholder="Contoh: 1234567890" required
                           value="<?php echo e(old('nisn')); ?>">
                    <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Hanya boleh angka, 10 digit</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NIK (16 Angka) <span class="text-danger">*</span></label>
                    <input type="number" name="nik" class="form-control <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           inputmode="numeric" placeholder="Contoh: 1234567890123456" required
                           value="<?php echo e(old('nik')); ?>">
                    <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Hanya boleh angka, 16 digit</small>
                </div>
            </div>

            <!-- Tempat Lahir, Tanggal Lahir -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           pattern="[a-zA-Z\s]+" placeholder="Contoh: Jakarta" required
                           value="<?php echo e(old('tempat_lahir')); ?>">
                    <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Hanya huruf dan spasi</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           max="<?php echo e(now()->subYears(12)->format('Y-m-d')); ?>" required
                           value="<?php echo e(old('tanggal_lahir')); ?>">
                    <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Minimal 12 tahun, tidak boleh di masa depan</small>
                </div>
            </div>

            <!-- Jenis Kelamin, Agama -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> class="border border-danger rounded p-2" <?php else: ?> class="border border-light rounded p-2" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                        <div class="form-check">
                            <input type="radio" name="jenis_kelamin" value="L" class="form-check-input" required 
                                   <?php echo e(old('jenis_kelamin') === 'L' ? 'checked' : ''); ?>>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="jenis_kelamin" value="P" class="form-check-input"
                                   <?php echo e(old('jenis_kelamin') === 'P' ? 'checked' : ''); ?>>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                    <select name="agama" class="form-select <?php $__errorArgs = ['agama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">-- Pilih Agama --</option>
                        <?php $__currentLoopData = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($ag); ?>" <?php echo e(old('agama') === $ag ? 'selected' : ''); ?>><?php echo e($ag); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['agama'];
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
            </div>

            <!-- Tinggi Badan & Berat Badan -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="tinggi_badan" class="form-control <?php $__errorArgs = ['tinggi_badan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           min="50" max="250" placeholder="Contoh: 170" required
                           value="<?php echo e(old('tinggi_badan')); ?>">
                    <?php $__errorArgs = ['tinggi_badan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">50-250 cm</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Berat Badan (kg) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="berat_badan" class="form-control <?php $__errorArgs = ['berat_badan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           min="20" max="200" placeholder="Contoh: 65" required
                           value="<?php echo e(old('berat_badan')); ?>">
                    <?php $__errorArgs = ['berat_badan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">20-200 kg</small>
                </div>
            </div>

            <!-- Asal Sekolah & Anak Ke -->
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Asal Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="asal_sekolah" class="form-control <?php $__errorArgs = ['asal_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Contoh: SMP Negeri 1 Sidoarjo" required
                           value="<?php echo e(old('asal_sekolah')); ?>">
                    <?php $__errorArgs = ['asal_sekolah'];
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

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Anak ke- <span class="text-danger">*</span></label>
                    <input type="number" name="anak_ke" class="form-control <?php $__errorArgs = ['anak_ke'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           min="1" max="20" placeholder="Contoh: 1" required
                           value="<?php echo e(old('anak_ke')); ?>">
                    <?php $__errorArgs = ['anak_ke'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">1-20</small>
                </div>
            </div>

            <!-- Tombol -->
            <div class="mt-4 d-flex gap-2">
                <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-arrow-right"></i> Lanjut ke Step 2
                </button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/user/biodata/step1.blade.php ENDPATH**/ ?>