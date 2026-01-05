<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title')</title>

    <!-- Add this to avoid blank WhatsApp previews -->
    <meta property="og:image:alt" content="Faysal Hossain - Full Stack Developer Portfolio">
    <!-- Standard Meta Tags -->
    <meta name="keywords"
        content="Full Stack Developer, Laravel Developer, PHP Developer, Web Developer, JavaScript, Bootstrap 5, HTML5, CSS3, Freelancer, Portfolio">
    <meta name="author" content="MD. Faysal Hossain Tibro">
    <meta name="robots" content="index, follow">
    <!-- Open Graph (Facebook/WhatsApp) -->
    <meta property="og:title" content="MD. Faysal Hossain Tibro | Full Stack Web Developer">
    <meta property="og:description"
        content="Professional Full Stack Developer | Laravel, PHP, JavaScript | Freelance Portfolio">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://devtibro.com/"> <!-- ✅ Good! -->
    <meta property="og:image" content="https://devtibro.com/uploads/avatar.png"> <!-- CRITICAL FIX -->
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Faysal's Portfolio">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card (Recommended) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MD. Faysal Hossain Tibro | Full Stack Web Developer">
    <meta name="twitter:description" content="Laravel, PHP, JavaScript Developer | Freelance Portfolio">
    <meta name="twitter:image" content="https://devtibro.com/uploads/avatar.png"> <!-- 1200x675px -->

    <!-- Favicons -->
    <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="icon" />
    <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet" />
    {{-- toastr.min.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css-link')
</head>

<body class="index-page">
    {{-- Header Start --}}
    @include('frontend.layouts.menu')
    {{-- Header End --}}

    <main class="main">
        @yield('content')
    </main>

    {{-- Footer Start --}}
    @include('frontend.layouts.footer')
    {{-- Footer End --}}

    <!-- Scroll Top -->
    <a href="javascript:;" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/typed.js/typed.umd.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- toastr.min.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('js-link')
</body>

</html>
