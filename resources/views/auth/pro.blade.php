@extends('layouts.master')
@section('content')
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
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 position-relative">
                    <div class="navtab-style1">
                        <nav>
                            <div class="nav nav-tabs mb30" id="nav-tab2" role="tablist">
                                <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Courses</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                                <div class="row">
                                    <div class="col-md-12 col-xxl-12">
                                      <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                                        <div class="d-flex justify-content-between bdrb1 pb15 mb20">
                                          <h5 class="title">Most Viewed Services</h5>
                                          <a class="text-decoration-underline text-thm6" href="#">View All</a>
                                        </div>
                                        <div class="dashboard-img-service">
                                            @foreach ($proposal as $proposals)
                                                <div class="listing-style1 list-style d-block d-xl-flex align-items-center border-0 mb10">
                                                <div class="list-thumb flex-shrink-0 bdrs4">
                                                    <img class="w-100" src="{{ asset('profile/'.$proposals->user->image) }}" alt="">
                                                </div>
                                                <div class="list-content flex-grow-1 pt10 pb10 pl15 pl0-lg">
                                                    <h6 class="list-title mb-2"><a href="#">{{ $proposals->user->name }}</a></h6>
                                                    <div class="list-meta d-flex justify-content-between align-items-center">
                                                    <div class="review-meta d-flex align-items-center">
                                                        <button class="btn btn-outline-primary btn-sm me-2" type="button">Accept</button>
                                                        <button class="btn btn-outline-danger btn-sm me-2" type="button">Reject</button>
                                                        <button class="btn btn-outline-warning btn-sm me-2" type="button">View Proposal</button>
                                                    </div>
                                                    <div class="budget">
                                                        <p class="mb-0 body-color">Starting at<span class="fz17 fw500 dark-color ms-1">$983</span></p>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <hr class="opacity-100 mt-0">
                                            @endforeach
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="mbp_pagination text-center">
                        
                    </div>
                </div>
            </div>
        </div>
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
@endsection
