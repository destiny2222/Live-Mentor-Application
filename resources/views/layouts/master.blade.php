



<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Smart Mentor, mentor,tutor,learning , training,teaching,online coach,Coaching Course Online,online course">
    <meta name="description" content="Get a personalized live mentor on our Smart Mentor system that offers a rich feature set, including the ability to set goals and milestones against which progress can be measured.">
    <link rel="shortcut icon" href="/logo.png">
    <meta name="og:image" content="https://livementor.gritinai.com/logo.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- TITLE -->
    <title> {{ config('app.name', 'Laravel') }} </title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="/backend/css/style.css" rel="stylesheet">

	<!-- Plugins CSS -->
    <link href="/backend/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="/backend/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="/backend/switcher/demo.css" rel="stylesheet">

</head>


<body class="app sidebar-mini ltr light-mode">


    <!-- GLOBAL-LOADER -->
    {{-- <div id="global-loader">
        <img src="/backend/images/loader.svg" class="loader-img" alt="Loader">
    </div> --}}
    <!-- /GLOBAL-LOADER -->


<!-- PAGE -->
<div class="page">
    <div class="page-main">

        <!-- app-Header -->
        @include('layouts.app-header')
        <!-- /app-Header -->

        <!--APP-SIDEBAR-->
        @include('layouts.app_sidebar')
        <!--/APP-SIDEBAR-->

        <!--app-content open-->
        <div class="main-content app-content mt-0">
            <div class="side-app">

                <!-- CONTAINER -->
                <div class="main-container container-fluid">

                    <!-- PAGE-HEADER -->
                     @yield('page-header')
                    <!-- PAGE-HEADER END -->

                    @yield('content')
                </div>
                <!-- CONTAINER END -->
            </div>
        </div>
        <!--app-content close-->

    </div>

    <!-- Sidebar-right -->
    @include('layouts.sidebar_right')
    <!--/Sidebar-right-->
    

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 text-center">
                    Copyright © <span id="year"></span> {{ config('app.name') }}. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->




    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="/backend/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="/backend/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/backend/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SPARKLINE JS-->
    <script src="/backend/js/jquery.sparkline.min.js"></script>

    <!-- Sticky js -->
    <script src="/backend/js/sticky.js"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="/backend/js/circle-progress.min.js"></script>

    <!-- PIETY CHART JS-->
    <script src="/backend/plugins/peitychart/jquery.peity.min.js"></script>
    <script src="/backend/plugins/peitychart/peitychart.init.js"></script>

    <!-- SIDEBAR JS -->
    <script src="/backend/plugins/sidebar/sidebar.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="/backend/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="/backend/plugins/p-scroll/pscroll.js"></script>
    <script src="/backend/plugins/p-scroll/pscroll-1.js"></script>

    <!-- INTERNAL CHARTJS CHART JS-->
    {{-- <script src="/backend/plugins/chart/Chart.bundle.js"></script> --}}
    {{-- <script src="/backend/plugins/chart/utils.js"></script> --}}

    <!-- DATA TABLE JS-->
    <script src="/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/backend/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="/backend/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="/backend/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="/backend/plugins/datatable/js/jszip.min.js"></script>
    <script src="/backend/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="/backend/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="/backend/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="/backend/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="/backend/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="/backend/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="/backend/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="/backend/js/table-data.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="/backend/plugins/select2/select2.full.min.js"></script>

    <!-- INTERNAL Data tables js-->
    <script src="/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/backend/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="/backend/plugins/datatable/dataTables.responsive.min.js"></script>

    <!-- INTERNAL APEXCHART JS -->
    {{-- <script src="/backend/js/apexcharts.js"></script> --}}
    {{-- <script src="/backend/plugins/apexchart/irregular-data-series.js"></script> --}}

    <!-- INTERNAL Flot JS -->
    {{-- <script src="/backend/plugins/flot/jquery.flot.js"></script> --}}
    {{-- <script src="/backend/plugins/flot/jquery.flot.fillbetween.js"></script> --}}
    {{-- <script src="/backend/plugins/flot/chart.flot.sampledata.js"></script> --}}
    {{-- <script src="/backend/plugins/flot/dashboard.sampledata.js"></script> --}}

    <!-- INTERNAL Vector js -->
    <script src="/backend/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- SIDE-MENU JS-->
    <script src="/backend/plugins/sidemenu/sidemenu.js"></script>

    <!-- SELECT2 JS -->
    <script src="/backend/plugins/select2/select2.full.min.js"></script>
    <script src="/backend/js/select2.js"></script>

	<!-- TypeHead js -->
	<script src="/backend/plugins/bootstrap5-typehead/autocomplete.js"></script>
    <script src="/backend/js/typehead.js"></script>

    <!-- INTERNAL INDEX JS -->
    <script src="/backend/js/index1.js"></script>

    <!-- Color Theme js -->
    <script src="/backend/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="/backend/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="/backend/js/custom-swicher.js"></script>

        <!-- FILE UPLOADES JS -->
        <script src="/backend/plugins/fileuploads/js/fileupload.js"></script>
        <script src="/backend/plugins/fileuploads/js/file-upload.js"></script>
    

    @include('partials.message')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <script>
    ClassicEditor.create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
    <script>
    ClassicEditor.create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
    <script>
        let SumbitButton = document.querySelector('#searchButton');
        let Form = document.querySelector('#Searchform');
        Form.addEventListener('submit', function(e){
            e.preventDefault();
            this.submit();
        });
    </script>
    @stack('scripts')
    @include('partials.notify')
</body>

</html>