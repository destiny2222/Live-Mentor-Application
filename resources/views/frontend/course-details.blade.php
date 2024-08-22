@extends('layouts.main')
@section('title', 'Course Details')
@section('content')

<section class="breadcumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-lg-10">
                <div class="breadcumb-style1 mb10-xs">
                    <div class="breadcumb-list">
                        <a href="#">Home</a>
                        <a href="#">Services</a>
                        <a href="#">Courses</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-2">
                <div class="d-flex align-items-center justify-content-sm-end">
                    <div class="share-save-widget d-flex align-items-center">
                        <span class="icon flaticon-share dark-color fz12 mr10"></span>
                        <div class="h6 mb-0">Share</div>
                    </div>
                    <div class="share-save-widget d-flex align-items-center ml15">
                        <span class="icon flaticon-like dark-color fz12 mr10"></span>
                        <div class="h6 mb-0">Save</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcumb Sections -->
<section class="breadcumb-section pt-0">
    <div class="cta-service-single cta-banner mx-auto maxw1700 pt120 pt60-sm pb120 pb60-sm bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg px30-lg">
        <img class="left-top-img wow zoomIn" src="/images/vector-img/left-top.png" alt="">
        <img class="right-bottom-img wow zoomIn" src="/images/vector-img/right-bottom.png" alt="">
        <img class="service-v1-vector bounce-y d-none d-xl-block" src="/images/vector-img/vector-service-v1.png" alt="">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-7">
                    <div class="position-relative">
                        <h2>{{ $course->title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Details -->
<section class="pt10 pb90 pb30-md">
    <div class="container">
        <div class="row wrap">
            <div class="col-lg-8">
                <div class="column">
                    <div class="service-single-sldier vam_nav_style slider-1-grid owl-carousel owl- mb60">
                      <div class="item">
                        <div class="thumb p50 p30-sm"><img src="{{ asset('upload/courses/'.$course->image) }}" alt="" class="w-100"></div>
                      </div>
                      <div class="item">
                        <div class="thumb p50 p30-sm"><img src="{{ asset('upload/courses/'.$course->image) }}" alt="" class="w-100"></div>
                      </div>
                      <div class="item">
                        <div class="thumb p50 p30-sm"><img src="{{ asset('upload/courses/'.$course->image) }}" alt="" class="w-100"></div>
                      </div>
                    </div>
                    <div class="service-about">
                        <h4>About</h4>
                        <p class="text mb30">
                          {{ $course->description }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="column">
                    <div class="blog-sidebar ms-lg-auto">
                        <div class="price-widget">
                            <div class="navtab-style1">
                                <nav>
                                    <div class="nav nav-tabs mb20" id="nav-tab2p" role="tablist">
                                      <button class="nav-link active fw500" id="nav-item2p-tab" data-bs-toggle="tab" data-bs-target="#nav-item2p" type="button" role="tab" aria-controls="nav-item2p" aria-selected="false">Standart</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-item2p" role="tabpanel" aria-labelledby="nav-item2p-tab">
                                        <div class="price-content">
                                            <div class="price">&#x20A6;{{ number_format($course->price, 2) }}</div>
                                            <div class="h5 mb-2">High-converting Landing Pages</div>
                                            <p class="text fz14">I will redesign your current landing page or create one for you (upto 4
                                                sections)</p>
                                            <hr class="opacity-100 mb20">
                                            <ul class="p-0 mb15 d-sm-flex align-items-center">
                                                <li class="fz14 fw500 dark-color"><i class="flaticon-sandclock fz20 text-thm2 me-2 vam"></i>3
                                                    Days Delivery</li>
                                                <li class="fz14 fw500 dark-color ml20 ml0-xs"><i class="flaticon-recycle fz20 text-thm2 me-2 vam"></i>2 Revisions</li>
                                            </ul>
                                            <div class="list-style1">
                                                <ul class="">
                                                    <li class="mb15"><i class="far fa-check text-thm3 bgc-thm3-light"></i>2 Page / Screen</li>
                                                    <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Source file</li>
                                                </ul>
                                            </div>
                                            <div class="d-grid">
                                                <a href="{{ route('proposal.store') }}" onclick="event.preventDefault(); document.getElementById('proposal-btn{{ $course->id }}').submit();" class="ud-btn btn-thm">Enroll Now<i class="fal fa-arrow-right-long"></i></a>
                                                <form action="{{ route('proposal.store') }}" id="proposal-btn{{ $course->id }}" style="display: none" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Course Details End -->

<!-- Listings -->
<section class="pt30 pb90 pb30-md">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-lg-12">
                <div class="main-title mb35">
                    <h2>Recent Course</h2>
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp">
            @foreach ($recentCourse as $recent)
            <div class="col-sm-6 col-lg-3">
                <div class="listing-style1">
                    <div class="list-thumb">
                        <img class="w-100" src="{{ asset('upload/courses/'.$recent->image) }}" alt="">
                        <!-- <a href="#" class="listing-fav fz12"><span class="far fa-heart"></span></a> -->
                    </div>
                    <div class="list-content">
                        <p class="list-text body-color fz14 mb-1">{{ \Str::limit($recent->title, 30) }}</p>
                        <h5 class="list-title"><a href="{{ route('course.details',$recent->slug )}}">{{ \Str::limit($recent->description, 100) }}</a></h5>
                        <hr class="my-2">
                        <div class="list-meta d-flex justify-content-between align-items-center mt15">
                            <a href="{{ route('course.details',$recent->slug )}}">
                                <span class="fz14">View course</span>
                            </a>
                            <div class="budget">
                                <p class="mb-0 body-color"><span class="fz17 fw500 dark-color ms-1">&#x20A6;{{ number_format($recent->price, 2) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
