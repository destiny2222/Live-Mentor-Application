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
    <link rel="shortcut icon" type="image/x-icon" href="">

    <!-- TITLE -->
    <title>{{ config('app.name') }}</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="/backend/css/style.css" rel="stylesheet">

	<!-- Plugins CSS -->
    <link href="/backend/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="/backend/css/icons.css" rel="stylesheet">

    <style>
        .wrap-login100{
            width: 30%;
        }

        .form-choose{
            width: 50%;
        }

        @media (max-width: 768px) {
            .wrap-login100{
                width: 100%;
            }

            .form-choose{
                width: 100%;
            }
        }
    </style>
</head>

<body class="app sidebar-mini ltr">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="/backend/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- Theme-Layout -->
                <div class="container-login100">
                    <div class="container">
                       <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="card-title" style="color:#1692C5;">Become an instructor on LiveMentor !</h1>
                                        <div class="page-text">
                                            <h5 class="card-title">Mentor</h5>
                                            <p>
                                                Share your industry expertise and experience with mentees! As a mentor, you'll provide guidance, support, and valuable insights to help them achieve their long-term goals. If you're passionate about helping others grow and develop, and enjoy sharing your knowledge and network, become a mentor!
                                            </p>
                                        </div>
                                        <div class="page-text">
                                            <h5 class="card-title">Tutor</h5>
                                            <p>
                                                Put your teaching skills to use and help students excel in specific subjects! As a tutor, you'll create personalized learning plans, provide targeted instruction, and assess student progress. If you have a strong background in a particular subject and enjoy helping students achieve academic success, become a tutor!
                                            </p>
                                        </div>
                                        <div class="page-text">
                                            <h5 class="card-title">Learners</h5>
                                            <p>
                                                Stan on the shoulders of giants! Learn from subject matter experts who will help you master specific skills or courses and guide you in achieving your long-term goals.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-5">
                                        <div class="m-auto form-choose">
                                            <form class="login100-form validate-form" action="{{ route('auth.role.post') }}" method="POST">
                                                @csrf
                                                <div class="tab-content">
                                                    <label class="form-label">Choose </label>
                                                    <select name="role" id="role" class="form-control form-select select2">
                                                        <option value="" selected>select</option>
                                                        <option value="user">Student</option>
                                                        <option value="tutor">Tutor</option>
                                                        <option value="mentor">Mentor</option>
                                                    </select>
                                                    <div class="container-login100-form-btn ">
                                                        <button type="submit" class="login100-form-btn btn-primary border-0">
                                                            Proceed
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                    {{-- <div class="wrap-login100 p-6">
                        <form class="login100-form validate-form" action="{{ route('auth.role.post') }}" method="POST">
                            @csrf
                            <div class="panel panel-primary">
                                <div class="panel-body tabs-menu-body p-0 pt-5">
                                    <div class="tab-content">
                                        <label class="form-label">Register as</label>
                                        <select name="role" id="role" class="form-control form-select select2">
                                            <option value="" selected>select</option>
                                            <option value="user">Student</option>
                                            <option value="tutor">Tutor</option>
                                            <option value="mentor">Mentor</option>
                                        </select>
                                        <div class="container-login100-form-btn ">
                                            <button type="submit" class="login100-form-btn btn-primary">
                                                Proceed
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="/backend/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="/backend/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/backend/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="../assets/plugins/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2.js"></script>
    

    <!-- Color Theme js -->
    <script src="/backend/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="/backend/js/custom.js"></script>

</body>

</html>