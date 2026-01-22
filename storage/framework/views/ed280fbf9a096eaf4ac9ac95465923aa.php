<!DOCTYPE html>
<html lang="en">
    <!-- [Head] start -->

    <head>

        <title><?php echo $__env->yieldContent('title'); ?></title>

        <!-- [Meta] -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description"
            content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
        <meta name="keywords"
            content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
        <meta name="author" content="CodedThemes">

        <!-- [Favicon] icon -->
        <link rel="icon" href="<?php echo e(asset('assets/images/favicon.svg')); ?>" type="image/x-icon">
        <!-- [Google Font] Family -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
            id="main-font-link">
        <!-- [Tabler Icons] https://tablericons.com -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
        <!-- [Feather Icons] https://feathericons.com -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
        <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
        <!-- [Material Icons] https://fonts.google.com/icons -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
        <!-- [Template CSS Files] -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-preset.css')); ?>">

        <style>
        body, html {
            background-color: #bfdbfe !important;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 0.75rem 1rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        </style>

    </head>
    <!-- [Head] end -->
    <!-- [Body] Start -->

    <body>
        <!-- [ Pre-loader ] disabled for smooth loading -->
        <div class="loader-bg" style="display: none;">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->

        <div class="auth-main" style="min-height:100vh;">
            <div class="auth-wrapper" style="width:100%; margin:auto;">
                <div class="auth-form" style="background: transparent; border: none; box-shadow: none;">
                    <div class="auth-header text-center mb-4" style="padding:0;">
                        <!-- Header removed for cleaner login page -->
                    </div>
                    <?php echo $__env->yieldContent('content'); ?>

                    <div class="auth-footer text-center" style="padding:0;">
                        <!-- Footer removed for cleaner login page -->
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
        <!-- Required Js -->
        <script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/plugins/simplebar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/fonts/custom-font.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/pcoded.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>


        <script>
            layout_change('light');
        </script>

        <script>
            change_box_container('false');
        </script>



        <script>
            layout_rtl_change('false');
        </script>


        <script>
            preset_change("preset-1");
        </script>


        <script>
            font_change("Public-Sans");
        </script>


        <script>
            document.addEventListener("DOMContentLoaded", function() {

                const forms = document.querySelectorAll('form[method="post"]');

                forms.forEach(form => {
                    form.addEventListener("submit", function() {
                        const submitButton = form.querySelector('button[type="submit"]');
                        submitButton.disabled = true;
                        submitButton.innerHTML = "Processing...";
                    });
                });
            });
        </script>

        <?php echo $__env->yieldContent('scripts_content'); ?>

        <!-- reCAPTCHA Script -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </body>
    <!-- [Body] end -->

</html>
<?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/layouts/auth.blade.php ENDPATH**/ ?>