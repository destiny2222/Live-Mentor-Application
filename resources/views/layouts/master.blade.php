<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="" content="">
<!-- css file -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/ace-responsive-menu.css">
<link rel="stylesheet" href="/css/menu.css">
<link rel="stylesheet" href="/css/fontawesome.css">
<link rel="stylesheet" href="/css/flaticon.css">
<link rel="stylesheet" href="/css/bootstrap-select.min.css">
<link rel="stylesheet" href="/css/animate.css">
<link rel="stylesheet" href="/css/slider.css">
<link rel="stylesheet" href="/css/jquery-ui.min.css">
<link rel="stylesheet" href="/css/magnific-popup.css">
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/ud-custom-spacing.css">
<link rel="stylesheet" href="/css/dashbord_navitaion.css">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="/css/responsive.css">
<!-- Title -->
<title>{{ config('app.name', 'Laravel')}}</title>
<!-- Favicon -->
{{-- <link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" /> --}}
<!-- Apple Touch Icon -->
{{-- <link href="images/apple-touch-icon-60x60.png" sizes="60x60" rel="apple-touch-icon">
<link href="images/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon">
<link href="images/apple-touch-icon-114x114.png" sizes="114x114" rel="apple-touch-icon">
<link href="images/apple-touch-icon-180x180.png" sizes="180x180" rel="apple-touch-icon"> --}}

@livewireStyles
</head>
<body>
<div class="wrapper">
  <div class="preloader"></div>
  
  <!-- Main Header Nav -->
  <header class="header-nav nav-innerpage-style menu-home4 dashboard_header main-menu">
    <!-- Ace Responsive Menu -->
    <nav class="posr"> 
      <div class="container-fluid pr30 pr15-xs pl30 posr menu_bdrt1">
        <div class="row align-items-center justify-content-between">
          <div class="col-6 col-lg-auto">
            <div class="text-center text-lg-start d-flex align-items-center">
              <div class="dashboard_header_logo position-relative me-2 me-xl-5">
                <a href="/" class="logo"><img width="100" src="/logo.png" alt=""></a>
              </div>
              <div class="fz20 ml90">
                <a href="#" class="dashboard_sidebar_toggle_icon vam"><img src="images/dashboard-navicon.svg" alt=""></a>
              </div>
              <a class="login-info d-block d-xl-none ml40 vam" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><span class="flaticon-loupe"></span></a>
              <div class="ml40 d-none d-xl-block">
                <div class="search_area dashboard-style">
                  <input type="text" class="form-control border-0" placeholder="What service are you looking for today?">
                  <label><span class="flaticon-loupe"></span></label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-auto">
            <div class="text-center text-lg-end header_right_widgets">
              <ul class="dashboard_dd_menu_list d-flex align-items-center justify-content-center justify-content-sm-end mb-0 p-0">
                {{-- <li class="d-none d-sm-block">
                  <a class="text-center mr5 text-thm2 dropdown-toggle fz20" type="button" data-bs-toggle="dropdown" href="#"><span class="flaticon-notification"></span></a>
                  <div class="dropdown-menu">
                    <div class="dboard_notific_dd px30 pt10 pb15">
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="images/resource/notif-1.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your resume</p>
                          <p class="text mb-0">updated!</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="images/resource/notif-2.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">You changed</p>
                          <p class="text mb-0">password</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="images/resource/notif-3.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your account has been</p>
                          <p class="text mb-0">created successfully</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="images/resource/notif-4.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">You applied for a job </p>
                          <p class="text mb-0">Front-end Developer</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center">
                        <img src="images/resource/notif-5.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your course uploaded</p>
                          <p class="text mb-0">successfully</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="d-none d-sm-block">
                  <a class="text-center mr5 text-thm2 dropdown-toggle fz20" type="button" data-bs-toggle="dropdown" href="#"><span class="flaticon-mail"></span></a>
                  <div class="dropdown-menu">
                    <div class="dboard_notific_dd px30 pt20 pb15">
                      <div class="notif_list d-flex align-items-start bdrb1 pb25 mb10">
                        <img class="img-2" src="images/testimonials/testi-1.png" alt="">
                        <div class="details ml15">
                          <p class="dark-color fw500 mb-2">Ali Tufan</p>
                          <p class="text mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                          <p class="mb-0 text-thm">4 hours ago</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-start mb25">
                        <img class="img-2" src="images/testimonials/testi-2.png" alt="">
                        <div class="details ml15">
                          <p class="dark-color fw500 mb-2">Ali Tufan</p>
                          <p class="text mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                          <p class="mb-0 text-thm">4 hours ago</p>
                        </div>
                      </div>
                      <div class="d-grid">
                        <a href="page-dashboard-message.html" class="ud-btn btn-thm w-100">View All Messages<i class="fal fa-arrow-right-long"></i></a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="d-none d-sm-block">
                  <a class="text-center mr5 text-thm2 dropdown-toggle fz20" type="button" data-bs-toggle="dropdown" href="#"><span class="flaticon-like"></span></a>
                  <div class="dropdown-menu">
                    <div class="dboard_notific_dd px30 pt10 pb15">
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="images/resource/notif-1.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your resume</p>
                          <p class="text mb-0">updated!</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="images/resource/notif-2.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">You changed</p>
                          <p class="text mb-0">password</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="images/resource/notif-3.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your account has been</p>
                          <p class="text mb-0">created successfully</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="images/resource/notif-4.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">You applied for a job </p>
                          <p class="text mb-0">Front-end Developer</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center">
                        <img src="images/resource/notif-5.png" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your course uploaded</p>
                          <p class="text mb-0">successfully</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li> --}}
                <li class="user_setting">
                  <div class="dropdown">
                    <a class="btn" href="#" data-bs-toggle="dropdown">
                      <img width="50px" height="50px" style="border-radius:50%"   src="{{ asset('profile/'.Auth::user()->image) }}" alt="user.png"> 
                    </a>
                  </div>
                </li>
              </ul>
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
            <div class="popup-search-field search_area">
              <input type="text" class="form-control border-0" placeholder="What service are you looking for today?">
              <label><span class="far fa-magnifying-glass"></span></label>
              <button class="ud-btn btn-thm" type="submit">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Nav  -->
  <div id="page" class="mobilie_header_nav stylehome1">
    <div class="mobile-menu">
      <div class="header bdrb1">
        <div class="menu_and_widgets">
          <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
            <a class="mobile_logo" href="#">MENTOR</a>
            <div class="right-side text-end">
              {{-- <a class="" href="/login">Join</a> --}}
              {{-- <a class="menubar ml30" href="#menu"><img src="images/mobile-dark-nav-icon.svg" alt=""></a> --}}
            </div>
          </div>
        </div>
        <div class="posr"><div class="mobile_menu_close_btn"><span class="far fa-times"></span></div></div>
      </div>
    </div>
  </div>

  <div class="dashboard_content_wrapper">
    <div class="dashboard dashboard_wrapper pr30 pr0-xl">
        @include('layouts.sidebar')
        @yield('content')
    </div>
  </div>
  <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
</div>
<!-- Wrapper End -->
@livewireScripts
<script src="/js/jquery-3.6.4.min.js"></script> 
<script src="/js/jquery-migrate-3.0.0.min.js"></script> 
<script src="/js/popper.min.js"></script> 
<script src="/js/bootstrap.min.js"></script> 
<script src="/js/bootstrap-select.min.js"></script> 
<script src="/js/jquery.mmenu.all.js"></script> 
<script src="/js/ace-responsive-menu.js"></script> 
<script src="/js/chart.min.js"></script>
<script src="/js/chart-custome.js"></script>
<script src="/js/jquery-scrolltofixed-min.js"></script>
<script src="/js/dashboard-script.js"></script>
<!-- Custom script for all pages --> 
<script src="/js/script.js"></script>

@include('partials.message')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor.create( document.querySelector( '#content' ) )
      .catch( error => {
          console.error( error );
      } );
</script>
</body>
</html>