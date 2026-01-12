<!DOCTYPE html>
<html lang="en">
    <!-- [Head] start -->

    <head>

        <title>@yield('title')</title>

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
        <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
        <!-- [Google Font] Family -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
            id="main-font-link">
        <!-- [Tabler Icons] https://tablericons.com -->
        <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
        <!-- [Feather Icons] https://feathericons.com -->
        <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
        <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
        <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
        <!-- [Material Icons] https://fonts.google.com/icons -->
        <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
        <!-- [Template CSS Files] -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
        <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">

    </head>
    <!-- [Head] end -->
    <!-- [Body] Start -->

    <body>
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->

        <div class="auth-main" style="min-height:100vh; background: linear-gradient(135deg, #3b82f6 0%, #f59e0b 100%); display:flex; align-items:center; justify-content:center;">
            <div class="auth-wrapper v3" style="width:92%; max-width:680px; margin:auto;">
                <div class="auth-form animate__animated animate__fadeInDown" style="background: rgba(255,255,255,0.95); border-radius: 24px; box-shadow: 0 10px 36px rgba(59,130,246,0.12), 0 4px 12px rgba(245,158,11,0.10); padding:3rem 2.5rem;">
                    <div class="auth-header text-center mb-4">
                        <a class="navbar-brand" href="/">
                            <img width="80" src="{{ asset('assets/images/my/logo-antartika.png') }}" alt="logo" style="border-radius:16px; box-shadow:0 2px 8px rgba(59,130,246,0.12);">
                        </a>
                        <div style="font-size:2rem; font-weight:700; margin-top:1rem; background: linear-gradient(90deg, #3b82f6 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">PPDB Online</div>
                    </div>
                    @yield('content')

                    <div class="auth-footer row">
                        <!-- <div class=""> -->
                        <div class="col my-1">
                            <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
                        </div>
                        <div class="col-auto my-1">
                            <ul class="list-inline footer-link mb-0">
                                <li class="list-inline-item"><a href="#">Home</a></li>
                                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
        <!-- Required Js -->
        <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
        <script src="{{ asset('assets/js/pcoded.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>


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

        @yield('scripts_content')

    </body>
    <!-- [Body] end -->

</html>
