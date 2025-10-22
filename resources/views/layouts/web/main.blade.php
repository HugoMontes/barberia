<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="manifest" href="site.webmanifest"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/img/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/style.css') }}">
</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('web/assets/img/logo/loder.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!--? Header Start -->
        <div class="header-area header-transparent pt-20">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index.html"><img src="{{ asset('web/assets/img/logo/logo.png') }}"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                @include('layouts.web.menu')
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <!--? Footer Start-->
        @include('layouts.web.footer')
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->

    <script src="{{ asset('web/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('web/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('web/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('web/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/slick.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('web/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- Date Picker -->
    <script src="{{ asset('web/assets/js/gijgo.min.js') }}"></script>
    <!-- Nice-select, sticky -->
    <script src="{{ asset('web/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.sticky.js') }}"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="{{ asset('web/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/hover-direction-snake.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('web/assets/js/contact.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('web/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('web/assets/js/main.js') }}"></script>

</body>

</html>
