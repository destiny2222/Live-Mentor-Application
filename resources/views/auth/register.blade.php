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
    <link rel="stylesheet" href="/css/ud-custom-spacing.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- Title -->
    <title></title>
    <!-- Favicon -->
    {{--
  <link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
  <link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" />
  <!-- Apple Touch Icon -->
  <link href="images/apple-touch-icon-60x60.png" sizes="60x60" rel="apple-touch-icon">
  <link href="images/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon">
  <link href="images/apple-touch-icon-114x114.png" sizes="114x114" rel="apple-touch-icon">
  <link href="images/apple-touch-icon-180x180.png" sizes="180x180" rel="apple-touch-icon"> --}}


</head>

<body class="bgc-thm4">
    <div class="wrapper ovh">
        <div class="preloader"></div>

        <div class="body_content">
            <!-- Our SignUp Area -->
            <section class="our-register">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 m-auto wow fadeInUp" data-wow-delay="300ms">
                            <div class="main-title text-center">
                                <h2 class="title">Register</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row wow fadeInRight" data-wow-delay="300ms">
                        
                        <div class="col-xl-6 mx-auto">
                          @if ($errors->any())
                          @foreach ($errors->all() as $error)
                              <div style="color: red;">{{$error}}</div>
                          @endforeach
                        @endif
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="log-reg-form search-modal form-style1 bgc-white p50 p30-sm default-box-shadow1 bdrs12">
                                    <div class="mb30">
                                        <h4>Let's create your account!</h4>
                                        <p class="text mt20">Already have an account? <a href="/login" class="text-thm">Log In!</a></p>
                                    </div>
                                    <div class="mb25">
                                        <label class="form-label fw500 dark-color">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="ali">
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="mb25">
                                        <label class="form-label fw500 dark-color">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="alitfn58@gmail.com">
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="mb25">
                                        <label class="form-label fw500 dark-color">Account Type</label>
                                        <select name="role" id="" class="form-control @error('role') is-invalid @enderror">
                                            <option value="" selected>select</option>
                                            <option value="user">Student</option>
                                            <option value="tutor">Tutor</option>
                                            <option value="mentor">Mentor</option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb15">
                                        <label class="form-label fw500 dark-color">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="*******"
                                               pattern="(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}" 
                                               title="Password must be at least 8 characters long, contain an uppercase letter, and a symbol.">
                                               <span style="color: red;font-size:13px;">Password must be at least 8 characters long, contain an uppercase letter,number and a symbol.</span>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    
                                    <div class="mb15">
                                        <label for="" class="form-label fw500 dark-color">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="*******">
                                    </div>
                                    
                                    <div class="d-grid mb20">
                                        <button class="ud-btn btn-thm default-box-shadow2" type="submit">Creat Account <i class="fal fa-arrow-right-long"></i></button>
                                    </div>
                                    <div class="hr_content mb20"><hr><span class="hr_top_text">OR</span></div>
                                    <div class="d-md-flex justify-content-center text-center">
                                        <a href="{{route('auth.socialite.redirect')}}" class="ud-btn btn-google fz14 fw400 mb-2 mb-md-0" type="button"><i class="fab fa-google"></i> Continue Google</a>
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
