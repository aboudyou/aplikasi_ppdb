

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Data Sudah Tersimpan -->
    <div class="card mt-2 p-4 border-success bg-light">
        <div class="mb-3">
            <h5 class="mb-3"><i class="bi bi-check-circle text-success"></i> Biodata Sudah Tersimpan</h5>
            <p class="text-muted mb-0"><small>Terakhir diperbarui: <?php echo e($data->updated_at ? $data->updated_at->format('d M Y H:i') : '-'); ?></small></p>
        </div>

        
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab1-btn" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">
                    <i class="bi bi-person"></i> Data Diri
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2-btn" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">
                    <i class="bi bi-geo-alt"></i> Alamat & Jurusan
                </button>
            </li>
        </ul>

        
        <div class="tab-content">
            
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                <div class="p-3 border-top">
                    <h6 class="mb-3"><strong>Data Diri Pribadi</strong></h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Nama Lengkap:</strong></p>
                            <p class="text-muted"><?php echo e($data->nama_lengkap ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Jenis Kelamin:</strong></p>
                            <p class="text-muted"><?php echo e($data->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>NISN:</strong></p>
                            <p class="text-muted"><?php echo e($data->nisn ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>NIK:</strong></p>
                            <p class="text-muted"><?php echo e($data->nik ?? '-'); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Tempat Lahir:</strong></p>
                            <p class="text-muted"><?php echo e($data->tempat_lahir ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Tanggal Lahir:</strong></p>
                            <p class="text-muted"><?php echo e($data->tanggal_lahir ? \Carbon\Carbon::parse($data->tanggal_lahir)->format('d M Y') : '-'); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Agama:</strong></p>
                            <p class="text-muted"><?php echo e($data->agama ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Anak ke-:</strong></p>
                            <p class="text-muted"><?php echo e($data->anak_ke ?? '-'); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Tinggi Badan:</strong></p>
                            <p class="text-muted"><?php echo e($data->tinggi_badan ? $data->tinggi_badan . ' cm' : '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Berat Badan:</strong></p>
                            <p class="text-muted"><?php echo e($data->berat_badan ? $data->berat_badan . ' kg' : '-'); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <p><strong>Asal Sekolah:</strong></p>
                            <p class="text-muted"><?php echo e($data->asal_sekolah ?? '-'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane fade" id="tab2" role="tabpanel">
                <div class="p-3 border-top">
                    <h6 class="mb-3"><strong>Alamat Lengkap</strong></h6>
                    <p class="text-muted mb-3"><?php echo e($data->alamat ?? '-'); ?></p>

                    <div class="row mb-4">
                        <div class="col-md-3 mb-2">
                            <p><strong>Desa:</strong> <span class="text-muted"><?php echo e($data->desa ?? '-'); ?></span></p>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p><strong>Kelurahan:</strong> <span class="text-muted"><?php echo e($data->kelurahan ?? '-'); ?></span></p>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p><strong>Kecamatan:</strong> <span class="text-muted"><?php echo e($data->kecamatan ?? '-'); ?></span></p>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p><strong>Kota:</strong> <span class="text-muted"><?php echo e($data->kota ?? '-'); ?></span></p>
                        </div>
                    </div>

                    <p class="mb-3"><strong>No. HP:</strong> <span class="text-muted"><?php echo e($data->no_hp ?? '-'); ?></span></p>

                    <div class="row mt-4 pt-3 border-top">
                        <div class="col-md-6 mb-3">
                            <p><strong>Jurusan:</strong></p>
                            <p class="text-muted"><?php echo e(optional($data->jurusan)->nama_jurusan ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Gelombang Pendaftaran:</strong></p>
                            <p class="text-muted"><?php echo e(optional($data->gelombang)->nama_gelombang ?? '-'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-4 pt-3 border-top">
            <div class="d-flex gap-2 flex-wrap">
                <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-success">
                    <i class="bi bi-check"></i> Lanjut ke Step Berikutnya
                </a>
                <a href="<?php echo e(route('user.biodata.step1')); ?>" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Data
                </a>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/user/biodata/summary.blade.php ENDPATH**/ ?>