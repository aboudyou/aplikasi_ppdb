<!DOCTYPE html>
<html lang="en">

<head>

    <title><?php echo $__env->yieldContent('title'); ?> - Aplikasi PPDB SMK</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.svg')); ?>" type="image/x-icon">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-preset.css')); ?>">

    <!-- Landing Page CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/landing.css')); ?>">

    <style>
        .navbar {
            transition: background .2s ease-in-out;
        }
    </style>
</head>

<body class="landing-page">

    <!-- Loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-dark top-nav-collapse default py-0">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img width="70" src="<?php echo e(asset('assets/images/my/logo-antartika.png')); ?>" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item pe-1">
                        <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="/">Home</a>
                    </li>

                    <!-- Dashboard aman tanpa error -->
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item pe-1">
                            <a class="nav-link"
                                href="/<?php echo e(auth()->user()->role == 'admin' ? 'admin' : 'user'); ?>/dashboard">
                                Dashboard
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item pe-1">
                            <a class="nav-link" href="/login">Dashboard</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item pe-1">
                        <a class="nav-link <?php echo e(request()->is('contact-us') ? 'active' : ''); ?>"
                            href="/contact-us">Contact Us</a>
                    </li>

                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="/myprofile"><?php echo e(auth()->user()->name); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="/login">Login</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->

    <?php echo $__env->yieldContent('content'); ?>

    <!-- FOOTER -->
    <footer class="footer bg-dark text-white py-4">
        <div class="top-footer">
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        <img src="<?php echo e(asset('assets/images/my/logo-antartika.png')); ?>" class="img-fluid mb-3"
                            style="max-width: 200px;">
                        <p class="opacity-75">
                            Sekolah SMK Antartika 1 Sidoarjo berkomitmen untuk mencetak generasi penerus yang cerdas,
                            kreatif, dan berakhlak mulia melalui pendidikan berkualitas.
                        </p>
                    </div>

                    <div class="col-md-8">
                        <div class="row">

                            <div class="col-sm-4">
                                <h5 class="text-white mb-4">Navigasi</h5>
                                <ul class="list-unstyled footer-link">
                                    <li><a href="/">Beranda</a></li>
                                    <li><a href="/#alur">Alur Pendaftaran</a></li>
                                    <li><a href="#">Pengumuman</a></li>
                                    <li><a href="/contact">Kontak</a></li>
                                </ul>
                            </div>

                            <div class="col-sm-4">
                                <h5 class="text-white mb-4">Hubungi Kami</h5>
                                <ul class="list-unstyled footer-link">
                                    <li class="d-flex"><i class="ti ti-map-pin me-2 mt-1"></i>
                                        <span>Jl. Siwalan Panji, Sidoarjo</span></li>
                                    <li class="d-flex"><i class="ti ti-mail me-2 mt-1"></i>
                                        <span>info@smkantartika1.sch.id</span></li>
                                    <li class="d-flex"><i class="ti ti-phone me-2 mt-1"></i>
                                        <span>(021) 123-4567</span></li>
                                </ul>
                            </div>

                            <div class="col-sm-4">
                                <h5 class="text-white mb-4">Tautan Lainnya</h5>
                                <ul class="list-unstyled footer-link">
                                    <li><a href="#">Kebijakan Privasi</a></li>
                                    <li><a href="#">Syarat & Ketentuan</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="bottom-footer">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col my-1">
                        <p class="text-white mb-0">
                            © <?php echo e(date('Y')); ?> Sekolah SMK Antartika 1. Hak Cipta Dilindungi.
                        </p>
                    </div>

                    <div class="col-auto my-1">
                        <ul class="list-inline footer-sos-link mb-0">
                            <li class="list-inline-item"><a href="#"><i class="ph-duotone ph-facebook-logo f-20"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ph-duotone ph-instagram-logo f-20"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ph-duotone ph-youtube-logo f-20"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </footer>
    <!-- END FOOTER -->

    <!-- JS -->
    <script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/simplebar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/fonts/custom-font.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pcoded.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>

    <!-- Page Specific -->
    <script src="<?php echo e(asset('assets/js/plugins/wow.min.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>

</body>

</html>
<?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/layouts/landing.blade.php ENDPATH**/ ?>