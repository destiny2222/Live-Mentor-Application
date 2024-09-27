<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="/backend/images/brand/favicon.ico">

    <!-- TITLE -->
    <title></title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="/backend/css/style.css" rel="stylesheet">

	<!-- Plugins CSS -->
    <link href="/backend/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="/backend/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="/backend/switcher/css/switcher.css" rel="stylesheet">
    <link href="/backend/switcher/demo.css" rel="stylesheet">

    <style>
         .logo-login{
            width: 100%;
         }
        @media (max-width: 768px){
            .logo-login{
                width: 30%;
            }
        }
    </style>
</head>

<body class="app sidebar-mini ltr ">


    <div class="page">
        <div class="">
            <!-- Theme-Layout -->

            <!-- CONTAINER OPEN -->


            <!-- CONTAINER OPEN -->
            <div class="container-login100">
                <div class="wrap-login100 p-6">
                        <div class="mb-4 alert alert-success text-sm text-success" role="alert">
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <span class="text-danger font-weight-bloder ">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                    <span class="login100-form-title pb-5">
                        {{ __('Reset Password')  }}
                     </span>
                    <form class="login100-form" action="{{ url('user/confirm-password') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->token }}">
                        <div class="wrap-input100 validate-input input-group">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-email" aria-hidden="true"></i>
                            </a>
                            <input type="email" name="email" id="email" value="{{ $request->email }}" placeholder="Your email address" class="form-control @error('email')  is-valid  @enderror">
                        </div>
                        @error('email')
                            <span class="invalid-" style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input type="password" name="password" id="password" placeholder="Your new password" class="form-control @error('password') is-valid  @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>    
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                            </a>
                            <input class="input100 border-start-0 ms-0 form-control @error('password_confirmation') is-valid @enderror" name="password_confirmation" required type="password" placeholder="Password">
                        </div>
                        <div class="submit text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END PAGE -->


       <!-- JQUERY JS -->
    <script src="/backend/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="/backend/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/backend/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="/backend/js/show-password.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="/backend/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="/backend/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="/backend/js/custom.js"></script>

    {{-- @include('partials.message') --}}
</body>

</html>