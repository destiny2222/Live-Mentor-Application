<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="bidding, fiverr, freelance marketplace, freelancers, freelancing, gigs, hiring, job board, job portal, job posting, jobs marketplace, peopleperhour, proposals, sell services, upwork">
<meta name="description" content="Freeio - Freelance Marketplace HTML Template">
<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/ace-responsive-menu.css">
<link rel="stylesheet" href="/css/menu.css">
<link rel="stylesheet" href="/css/fontawesome.css">
<link rel="stylesheet" href="/css/flaticon.css">
<link rel="stylesheet" href="/css/bootstrap-select.min.css">
<link rel="stylesheet" href="/css/ud-custom-spacing.css">
<link rel="stylesheet" href="/css/animate.css">
<link rel="stylesheet" href="/css/jquery-ui.min.css">
<link rel="stylesheet" href="/css/style.css">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="/css/responsive.css">
<!-- Title -->
<title>Freeio - Freelance Marketplace HTML Template</title>
<!-- Favicon -->
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" />
<!-- Apple Touch Icon -->
<link href="images/apple-touch-icon-60x60.png" sizes="60x60" rel="apple-touch-icon">
<link href="images/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon">
<link href="images/apple-touch-icon-114x114.png" sizes="114x114" rel="apple-touch-icon">
<link href="images/apple-touch-icon-180x180.png" sizes="180x180" rel="apple-touch-icon">


</head>
<body class="bgc-thm4">
<div class="wrapper ovh">
  <div class="preloader"></div>

  <div class="body_content">
    <!-- Our SignUp Area -->
    <section class="our-register">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
            <div class="main-title text-center">
              <h2 class="title">Register</h2>
            </div>
          </div>
        </div>
        <div class="row wow fadeInRight" data-wow-delay="300ms">
          <div class="col-xl-6 mx-auto">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="log-reg-form search-modal form-style1 bgc-white p50 p30-sm default-box-shadow1 bdrs12">
                    <div class="mb30">
                      <h4>Let's create your account!</h4>
                      <p class="text mt20">Already have an account? <a href="/login" class="text-thm">Log In!</a></p>
                    </div>
                    <div class="mb25">
                      <label class="form-label fw500 dark-color">Name</label>
                      <input type="text" class="form-control" name="name" placeholder="ali">
                    </div>
                    <div class="mb25">
                      <label class="form-label fw500 dark-color">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="alitfn58@gmail.com">
                    </div>
                    <div class="mb25">
                      <label class="form-label fw500 dark-color">Account Type</label>
                      <select name="role" id="" class="form-control">
                          <option value="" selected>select</option>
                          <option value="user">Student</option>
                          <option value="tutor">Mentor</option>
                      </select>
                    </div>
                    <div class="mb15">
                      <label class="form-label fw500 dark-color">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="*******">
                    </div>
                    <div class="mb15">
                      <label for="" class="form-label fw500 dark-color">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="*******">
                    </div>
                    <div class="d-grid mb20">
                      <button class="ud-btn btn-thm default-box-shadow2" type="submit">Creat Account <i class="fal fa-arrow-right-long"></i></button>
                    </div>
                    
                  </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
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
<!-- Custom script for all pages -->
<script src="/js/script.js"></script>
@include('partials.message')
</body>
</html>