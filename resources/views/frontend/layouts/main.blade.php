<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Home" />
    <meta name="description" content="Join us and get the offers " />
    <meta name="author" content="Jiowireless" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="sssV7EtSgQKtFmYFmtOV90hmlmAdE38tnLSfaHdA">
    @yield('tittle')
    <!-- <link rel="icon" href="{{ url('front/img/favicon.png') }}" /> -->

    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/aos.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/mobile.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/owlcarousel.min.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/slick-slider.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/vendor/odometer.css') }}" />
    <link rel="stylesheet" href="{{ url('newfront/assets/css/main.css') }}" />
    <link href="{{ url('front/backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="homepage1-body">
      <!--===== PRELOADER STARTS =======-->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="assets/img/logo/preloader.png" alt="" /></div>
        </div>
    </div>
    <!--===== PRELOADER ENDS =======-->

    <!--===== PAGE PROGRESS START=======-->
    <div class="paginacontainer">
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
                </svg>
        </div>
    </div>
    <!--===== PAGE PROGRESS END=======-->

		@include('frontend.includes.headertwo')
			@yield('content')
		@include('frontend.includes.footertwo')
        <script src="{{ url('newfront/assets/js/vendor/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/fontawesome.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/aos.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/jquery.appear.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/jquery.odometer.min.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/sidebar.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/magnific-popup.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/gsap.min.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/ScrollTrigger.min.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/Splitetext.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/mobilemenu.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/owlcarousel.min.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/nice-select.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/waypoints.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/slick-slider.js') }}"></script>
        <script src="{{ url('newfront/assets/js/vendor/circle-progress.js') }}"></script>
        <script src="{{ url('newfront/assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ url('front/backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $('.gallery-container').each(function() {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
    @yield('script')
</body>
</html>