<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="" content="">
    <meta name="og:image" content="https://livementor.gritinai.com/logo.png">
    <!-- css file -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/ace-responsive-menu.css">
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/fontawesome.css">
    <link rel="stylesheet" href="/css/flaticon.css">
    <link rel="stylesheet" href="/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">
    <link rel="stylesheet" href="/css/slider.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/ud-custom-spacing.css">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- Title -->
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    {{-- <link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
    <link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" /> --}}
    <!-- Apple Touch Icon -->
    {{-- <link href="images/apple-touch-icon-60x60.png" sizes="60x60" rel="apple-touch-icon">
    <link href="images/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon">
    <link href="images/apple-touch-icon-114x114.png" sizes="114x114" rel="apple-touch-icon">
    <link href="images/apple-touch-icon-180x180.png" sizes="180x180" rel="apple-touch-icon"> --}}
    
</head>
<body>
    <div class="wrapper ovh">
        <div class="preloader"></div>
        <!-- Main Header Nav -->
        <header class="header-nav nav-innerpage-style default-box-shadow1 main-menu">
            <!-- Ace Responsive Menu -->
            <nav class="posr">
                <div class="container posr">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto px-0 px-xl-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="logos">
                                    <a class="header-logo logo1" href="/">
                                        <img src="/logo.png" width="100" alt="Header Logo">
                                    </a>
                                </div>
                                <!-- Responsive Menu Structure-->
                                <ul id="respMenu" class="ace-responsive-menu m-auto" data-menu-style="horizontal">
                                    <li class="visible_list"> <a class="list-item" href="/"><span class="title">Home</span></a></li>
                                    <li class="visible_list"> <a class="list-item" href="/about"><span class="title">About Us</span></a></li>
                                    <li class="visible_list"> <a class="list-item" href="/course"><span class="title">Course</span></a></li>
                                    <li> <a class="list-item pe-0" href="/contact">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto pe-0 pe-xl-3">
                            <div class="d-flex align-items-center">
                                {{-- <a class="login-info pr30" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><span class="flaticon-loupe"></span></a> --}}
                                @auth
                                <a class="login-info mr15-xl mr10 ud-btn btn-dark add-joining bdrs12 dark-color bg-transparent" href="{{ route('dashboard') }}">Dashboard</a>
                                <a class="ud-btn btn-dark add-joining bdrs12 text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit();">Logout</a>
                                <form action="{{ route('logout') }}" id="logout" method="post" class="d-none">
                                    @csrf
                                </form>
                                @else
                                <a class="login-info mx15-xl mx30" href="{{ route('become.mentor') }}"><span class="d-none d-xl-inline-block">Become a</span> Mentor</a>
                                <a class="login-info mr15-xl mr10 ud-btn btn-dark add-joining bdrs12 dark-color bg-transparent" href="/login">Sign in</a>
                                <a class="ud-btn btn-dark add-joining bdrs12 text-white" href="/register">Join Now</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Search Modal -->
        <div class="search-modal">
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-xmark"></i></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('search') }}" method="GET">
                                <div class="popup-search-field search_area">
                                    <input type="text" name="search" class="form-control border-0" placeholder="What service are you looking for today?">
                                    <label><span class="far fa-magnifying-glass"></span></label>
                                    <button class="ud-btn btn-thm" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hiddenbar-body-ovelay"></div>

        <!-- Mobile Nav  -->
        <div id="page" class="mobilie_header_nav stylehome1">
            <div class="mobile-menu">
                <div class="header bdrb1">
                    <div class="menu_and_widgets">
                        <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
                            <a class="mobile_logo" href="/"><img src="/logo.png" width="100" alt=""></a>
                            <div class="right-side text-end">
                                @auth
                                    <a class="#" href="{{ route('dashboard') }}">Dashboard</a>
                                    @else
                                    <a class="#" href="/register">Join Now</a>
                                @endauth
                                <a class="menubar ml30" href="#menu"><img src="/images/mobile-dark-nav-icon.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="posr">
                        <div class="mobile_menu_close_btn"><span class="far fa-times"></span></div>
                    </div>
                </div>
            </div>
            <!-- /.mobile-menu -->
            <nav id="menu" class="">
                <ul>
                    <li> <a href="/"><span>Home</span></a></li>
                    <li> <a href="/about"><span>About Us</span></a></li>
                    <li> <a href="/course"><span>Course</span></a></li>
                    <li> <a href="/contact">Contact</a></li>
                    <!-- Only for Mobile View -->
                </ul>
            </nav>
        </div>

        <div class="body_content ">
            @yield('content')
            <!-- Our Footer -->
            <section class="footer-style1  pt50 pb-0">
                <div class="container ">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-5 mb-lg-0 mb-5">
                            <div class="link-style1 mb-4 mb-sm-5">
                                <img src="/fotor_logo.png" width="150" class="img-fluid" alt="">
                                <p class="text " style="color: #fff">
                                    Get a personalized live mentor on our Smart Mentor system that offers a rich feature set, including the ability to set goals and milestones against which progress can be measured.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-5">
                            <h5 class="text-white mb15">Support</h5>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="link-style1 mb-4 mb-sm-5">
                                        <div class="link-list">
                                            <ul class="ps-0"> 
                                                <li><a class="text-white" href="/">Home</a></li>
                                                <li><a class="text-white" href="/about">About us</a></li>
                                                <li><a class="text-white" href="/course">Course</a></li>
                                            </ul>
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="link-style1 mb-4 mb-sm-5">
                                        <ul class="ps-0">
                                            <li><a class="text-white" href="#">Help & Support</a></li>
                                            <li><a class="text-white" href="/contact">Contact Us</a></li>
                                            <li><a class="text-white" href="#">Terms of Service</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3 mb-lg-0 mb-5">
                            <div class="footer-widget">
                                <div class="footer-widget mb-4 mb-sm-5">
                                    <div class="mailchimp-widget">
                                        <h5 class="title text-white mb20">Subscribe</h5>
                                        <div class="mailchimp-style1">
                                            <input type="email" class="form-control bdrs4" placeholder="Your email address">
                                            <button type="submit">Send</button>
                                        </div>
                                        <p class="text-white mt20">Get the latest news and updates!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container white-bdrt1 py-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="text-center text-lg-start">
                                <p class="copyright-text mb-2 mb-md-0 text-white-light ff-heading">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <a class="scrollToHome at-home2" href="#"><i class="fas fa-angle-up"></i></a>
        </div>


    </div>
    <!-- Wrapper End -->
    <script src="/js/jquery-3.6.4.min.js"></script>
    <script src="/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-select.min.js"></script>
    <script src="/js/jquery.mmenu.all.js"></script>
    <script src="/js/ace-responsive-menu.js"></script>
    <script src="/js/jquery-scrolltofixed-min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script src="/js/owl.js"></script>
    <script src="/js/jquery.counterup.js"></script>
    <script src="/js/isotop.js"></script>
    <script src="/js/pricing-slider.js"></script>
    <!-- Custom script for all pages -->
    <script src="/js/script.js"></script>
    @include('partials.message')
    @stack('scripts')
</body>
</html>
