<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ title() }}</title>

    <!-- Favicons -->
    <link type="image/x-icon" href="{{ asset('uploads/setting/' . icon()) }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front-assets/assets/css/bootstrap.min.css') }}">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset('front-assetsassets/plugins/fancybox/jquery.fancybox.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('front-assets/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('front-assets/assets/css/bootstrap-datetimepicker.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('front-assets/assets/plugins/select2/css/select2.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('front-assets/assets/css/style.css') }}">

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <header class="header">
            @include('layouts.inc.front.navbar')
        </header>
        <!-- /Header -->

        @yield('section')

        <!-- Footer -->
        @include('layouts.inc.front.footer')
        <!-- /Footer -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('front-assets/assets/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('front-assets/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('front-assets/assets/js/bootstrap.min.js') }}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{ asset('front-assets/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
    <script src="{{ asset('front-assets/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('front-assets/assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{ asset('front-assets/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('front-assets/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- Slick JS -->
    <script src="{{ asset('front-assets/assets/js/slick.js') }}"></script>
    <!-- Fancybox JS -->
    <script src="{{ asset('front-assets/assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('front-assets/assets/js/script.js') }}"></script>
    <script src="{{ asset('front-assets/admin/assets/js/user.js') }}"></script>
    @yield('scripts')

</body>

</html>
