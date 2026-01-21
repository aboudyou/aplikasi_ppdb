<?php $__env->startSection('title', 'Login Page'); ?>

<?php $__env->startSection('content'); ?>
<style>
.card {
    background: rgba(255, 255, 255, 0.22);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 1.8rem;
    border: 1px solid rgba(255, 255, 255, 0.4);
    box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    padding: 40px;
    width: 100%;
    max-width: 400px;
    animation: riseUp 1.1s cubic-bezier(.22,1,.36,1) forwards;
}
</style>
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="<?php echo e(asset('assets/images/my/logo-antartika.png')); ?>" alt="Logo" style="width: 70px; height: 70px;" class="mb-3">
                        <h4 class="text-primary mb-1">PPDB Online</h4>
                        <p class="text-muted small">Masuk ke akun Anda</p>
                    </div>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('login.post')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan email Anda" value="<?php echo e(session('registered_email')); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan password Anda" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">Masuk</button>
                    </form>

                    <div class="text-center mb-3">
                        <a href="<?php echo e(route('forgot_password.email_form')); ?>" class="text-decoration-none">Lupa password?</a>
                    </div>

                    <hr class="my-3">

                    <div class="text-center">
                        <p class="mb-0">Belum punya akun? <a href="/register" class="text-decoration-none text-primary fw-semibold">Daftar sekarang</a></p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <small class="text-muted">&copy; 2026 SMK Antartika 1</small>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/auth/login.blade.php ENDPATH**/ ?>