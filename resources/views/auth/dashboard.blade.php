@extends('layouts.master')
<style>
    /* General button styles */
    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    /* Outline button styles */

    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
    }

    .btn-outline-warning:hover {
        color: #fff;
        background-color: #ffc107;
        border-color: #ffc107;
    }


    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }

    .btn-outline-primary:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger:hover {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-info {
        color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-outline-info:hover {
        color: #fff;
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    /* Small button styles */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    /* Margin end (right) */
    .me-2 {
        margin-right: 0.5rem;
    }

    /* Text primary color */
    .text-primary {
        color: #007bff !important;
    }

</style>
@section('content')

<div class="dashboard__main pl0-md">
    <div class="dashboard__content hover-bgc-color">
        <div class="row pb40">
            <div class="col-lg-12">
                <div class="dashboard_navigationbar d-block d-lg-none">
                    <div class="dropdown">
                        @include('layouts.navbar')
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="dashboard_title_area">
                    <h2>Welcome back, {{ $user->name }}</h2>
                    @if ($user->checkTutorStatus())
                    <h5 class="">Complete your profile <a href="{{ route('tutor.create') }}" class="text-primary">Click Here</a>
                    </h5>
                    @endif

                    @if ($user->checkMentorStatus())
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>Complete your registeration <a href="{{ route('mentor.create') }}" class="btn btn-primary text-white btn-sm" target="_blank">Click Here</a></h5>
                        </div>
                    </div>
                    @endif

                    @if ($user->checkTutorActiveStatus())
                    <p class="badge bg-primary">Your account is not active yet. underdown <br> going verification as a tutor</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            @if ($user->role == 'mentor')
            <div class="col-sm-6 col-xxl-4">
                <div class="d-flex align-items-center justify-content-between statistics_funfact">
                    <div class="details">
                        <div class="fz15">Completed Sessions</div>
                        <div class="title">{{ $countEnroll }}</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-contract"></i></div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4">
                <div class="d-flex align-items-center justify-content-between statistics_funfact">
                    <div class="details">
                        <div class="fz15">Pending Session</div>
                        <div class="title">{{ $SessionPendingCount }}</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-success"></i></div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4">
                <div class="d-flex align-items-center justify-content-between statistics_funfact">
                    <div class="details">
                        <div class="fz15">Total Review</div>
                        <div class="title">{{ $TotalReview }}</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-review-1"></i></div>
                </div>
            </div>
            @elseif ($user->role == 'tutor')
            <div class="col-sm-6 col-xxl-6">
                <div class="d-flex align-items-center justify-content-between statistics_funfact">
                    <div class="details">
                        <div class="fz15">Completed Classes</div>
                        <div class="title">{{ $countEnroll }}</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-contract"></i></div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-6">
                <div class="d-flex align-items-center justify-content-between statistics_funfact">
                    <div class="details">
                        <div class="fz15">Total Review</div>
                        <div class="title">0</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-review-1"></i></div>
                </div>
            </div>
            @else
            <div class="col-12 col-sm-6 col-xxl-6">
                <div class="d-flex align-items-center justify-content-between statistics_funfact">
                    <div class="details">
                        <div class="fz15">Enroll Course</div>
                        <div class="title">{{ $countEnroll }}</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-contract"></i></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xxl-6">
                <div class="d-flex align-items-center justify-content-between statistics_funfact">
                    <div class="details">
                        <div class="fz15">Pending Course</div>
                        <div class="title">{{ $PendingCountEnroll }}</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-success"></i></div>
                </div>
            </div>
            @endif
        </div>
        @if ($user->role == 'user')
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="packages_table table-responsive">
                        <div class="navtab-style1">
                            <nav>
                                <div class="nav nav-tabs mb20" id="nav-tab2" role="tablist">
                                    <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Enroll Course</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                                    @forelse ($enrolledCourses as $enrollment)
                                    @php
                                    $course = $enrollment['course'];
                                    $proposal = $enrollment['proposal'];
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="bdrb1 pb20">
                                            <div class="mbp_first position-relative d-sm-flex align-items-center justify-content-start mb30-sm mt30">
                                                <img width="200"  src="{{ asset('upload/courses/'.$course->image) }}" class="mr-3" alt="comments-2.png">
                                                <div class="ml20 ml0-xs mt20-xs">
                                                    <div class="del-edit"><span class="flaticon-flag"></span></div>
                                                    <h6 class="mt-0 mb-1">{{ $course->title }}</h6>
                                                    <div class="d-flex flex-lg-row flex-column text-sm-left  align-lg-items-center">
                                                        <div><span class="fz15 fw500">{{ $course->category->name }}</span></div>
                                                        <div class="ms-3"><span class="fz14 text">Created on {{ $course->created_at->format('F j, Y') }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text mt20 mb20"> {{ $course->description }}</p>
                                            @if ($proposal->status == '3')
                                            <span class="pending-style style1">In Progress</span>
                                            @elseif($proposal->status == '2')
                                            <span class="pending-style style2">Completed</span>
                                            @elseif($proposal->status == '1')
                                            <span class="pending-style style2">Approved</span>
                                            @else
                                            <span class="pending-style style3">Cancel</span>
                                            @endif
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-sm-12 col-xl-12">
                                        <p>Empty Course</p>
                                        <a href="{{ route('course.index') }}" class="btn btn-primary text-white" target="_blank" rel="noopener noreferrer">Add Course</a>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif (Auth::user()->role == 'mentor')

        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="navtab-style1">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h4 class="title fz17 mb20">Profile Views</h4>
                            <div class="page_control_shorting dark-color pr10 text-center text-md-end">
                                <div class="dropdown bootstrap-select show-tick"><select class="selectpicker show-tick">
                                        <option>This Week</option>
                                        <option>This Month</option>
                                        <option>This Year</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="This Week">
                                        <div class="filter-option">
                                            <div class="filter-option-inner">
                                                <div class="filter-option-inner-inner">This Week</div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu ">
                                        <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
                                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <canvas id="myChartweave" style="height: 282px; display: block; width: 565px;" width="1130" height="564" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12 col-xxl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="d-flex justify-content-between bdrb1 pb15 mb20">
                        <h5 class="title">Proposal</h5>
                        <a class="text-decoration-underline text-thm6" href="{{ route('tutor.proposal') }}">View All</a>
                    </div>
                    <div class="dashboard-img-service">
                        @forelse ($proposal as $proposals)
                        <div class="listing-style1 list-style d-block d-xl-flex align-items-center border-0 mb10">
                            <div class="list-thumb flex-shrink-0 bdrs4">
                                <img class="w-100" src="{{ asset('profile/'.$proposals->user->image) }}" alt="">
                            </div>
                            <div class="list-content flex-grow-1 pt10 pb10 pl15 pl0-lg">
                                <h6 class="list-title mb-2"><a href="{{ route('proposal.details',$proposals->id) }}">{{ $proposals->user->name }}</a></h6>
                                <p>
                                    {{ $proposals->additional_information }}
                                </p>
                                <div class="list-meta d-flex justify-content-between align-items-center">
                                    <div class="review-meta d-flex align-items-center">
                                        <a class="pending-style style2 btn-sm me-2" href="{{ route('proposal.details',$proposals->id) }}" type="button">View Proposal</a>
                                    </div>
                                    <div class="budget">
                                        <p class="mb-0 body-color">Price <span class="fz17 fw500 dark-color ms-1">&#8358;{{ $proposals->price }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="opacity-100 mt-0">
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <footer class="dashboard_footer pt30 pb30">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-md-between">
                <div class="col-auto">
                    <div class="copyright-widget">
                        <p class="mb-md-0">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="/js/chart-custome.js"></script>
@endsection
@push('scripts')
<script>
    // LineChart Style 2
    var ctx = document.getElementById('myChartweave').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line', // also try bar or other graph types

        // The data for our dataset
        data: {
            labels: ["Jan", "Feb", "Marc", "April", "May", "June", "July", "Agust", "Sept", "Oct", "Nov", "Dec"],
            // Information about the dataset
            datasets: [{
                label: "Dataset"
                , backgroundColor: 'rgba(251, 247, 237, 0.9)'
                , borderColor: '#5BBB7B'
                , data: [148, 140, 210, 120, 160, 140, 190, 170, 135, 210, 180, 249]
            , }]
        },

        // Configuration options
        options: {
            layout: {
                padding: 10
            , }
            , legend: {
                position: 'top'
            , }
            , title: {
                display: false
                , text: 'Precipitation in Toronto'
            }
            , scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        // labelString: 'Precipitation in mm'
                    }
                    , ticks: {
                        min: 0
                        , max: 300,
                        // forces step size to be 5 units
                        stepSize: 50
                    }
                }]
                , xAxes: [{
                    scaleLabel: {
                        display: true,
                        // labelString: 'Month of the Year'
                    }
                }]
            }
        }
    });

</script>
@endpush
