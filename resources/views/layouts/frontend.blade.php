<!DOCTYPE html>
<html lang="en')}}">

<head>
    <title>{{ name() }}</title>
    <meta charset="utf-8')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no')}}">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900"
        rel="stylesheet')}}">

    <link rel="stylesheet" href="{{ asset('front-assets/css/ajax-loader.gif') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('front-assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('front-assets/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('front-assets/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('front-assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('front-assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
</head>

<body>
    @include('layouts.inc.front.navbar')

    @yield('content')

    @include('layouts.inc.front.footer')

    <script src="{{ asset('front-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/aos.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('front-assets/js/google-map.js') }}"></script>
    <script src="{{ asset('front-assets/js/main.js') }}"></script>

</body>

</html>
