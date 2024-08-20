<!doctype html>
<html lang="en">
<head>

        <meta charset="utf-8" />
        <title>Email Verification </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <!-- preloader css -->
        <link rel="stylesheet" href="/assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-12 col-lg-12 col-md-12">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class=" auth-content m-auto">
                                        <div class="card p-5 d-inline-block text-center">
                                            <div class="avatar-lg mx-auto">
                                                <div class="avatar-title rounded-circle bg-light">
                                                    <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="p-2 mt-4">
                                                <h4>Verify your email</h4>
                                                @if (session('status') == 'verification-link-sent')
                                                    <div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                                        <i class="mdi mdi-alert-outline label-icon"></i><strong>A new email verification link has been emailed to you!</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <p >{{ __('We have sent you verification email, Please check it inbox or spam.') }}</p>
                                                <p >{{ __('If you did not receive the email') }}</p>
                                                <form class="login100-form " action="{{  route('verification.send') }}" method="POST">
                                                    @csrf
                                                    <div class="mt-4">
                                                        <button type="submit" class="btn btn-primary w-10">Resend</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->
        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>
        <script src="/assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="/assets/libs/pace-js/pace.min.js"></script>

    </body>
</html>