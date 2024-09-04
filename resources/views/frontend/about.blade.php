@extends('layouts.main')
@section('title', 'About Us')
@section('content')

    <section class="breadcumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-lg-10">
                    <div class="breadcumb-style1 mb10-xs">
                        <div class="breadcumb-list">
                            <a href="/">Home</a>
                            <a href="#">About us</a>
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
                            <h2>About us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section Area -->
    <section class="our-about pb0 pt60-lg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-xl-6">
                    <div class="about-img mb30-sm wow fadeInRight" data-wow-delay="300ms">
                        <img class="w100" src="images/about/about-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-xl-5 offset-xl-1">
                    <div class="position-relative wow fadeInLeft" data-wow-delay="300ms">
                        <h2 class="mb25">About </h2>
                        <p class="text mb25">
                          Welcome to MENTOR, an initiative of GritinAI to connect you with the best mentors and tutors in your field of interest. Whether you're a student looking for guidance or a professional seeking to enhance your skills, our platform is designed to help you find the perfect mentor or tutor who meets your unique needs.
                        </p>
                        <p class="text mb25">
                          We know that education and personal growth are not one-size-fits-all. That's why we've created a safe space where learners can explore a diverse range of mentors and tutors, each with their own specialties and teaching styles. 
                        </p>

                        <div class="list-style2">
                            <ul class="mb20">
                                <li><i class="far fa-check"></i> Find qualified mentor/tutor in your career path </li>
                                <li><i class="far fa-check"></i>Experience seamless live sessions with mentor/tutor</li>
                                <li><i class="far fa-check"></i>Wide selection of courses, mentoring programs, and one-on-one sessions</li>
                            </ul>
                        </div>
                        <a href="/login" class="ud-btn btn-thm-border">Get Started 
                          <i class="fal fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="p-0">
        <div class="cta-banner mx-auto maxw1600 pt120 pt60-lg pb90 pb60-lg position-relative overflow-hidden mx20-lg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-xl-5 pl30-md pl15-xs wow fadeInRight" data-wow-delay="500ms">
                        <div class="mb30">
                            <div class="main-title">
                                <h2 class="title">Making learning as easy as <br class="d-none d-md-block" /> it should be </h2>
                            </div>
                        </div>
                        <div class="why-chose-list">
                            <div class="list-one d-flex align-items-start mb30">
                                <span class="list-icon flex-shrink-0 flaticon-badge"></span>
                                <div class="list-content flex-grow-1 ml20">
                                    <h4 class="mb-1">Proof of quality</h4>
                                    <p class="text mb-0 fz15">Check the qualifications, reviews and identity of tutors</p>
                                </div>
                            </div>
                            <div class="list-one d-flex align-items-start mb30">
                                <span class="list-icon flex-shrink-0 flaticon-money"></span>
                                <div class="list-content flex-grow-1 ml20">
                                    <h4 class="mb-1">Easy access</h4>
                                    <p class="text mb-0 fz15">
                                      Our platform is user-friendly, allowing you to easily browse, connect, and engage with mentors and tutors from various disciplines.
                                    </p>
                                </div>
                            </div>
                            <div class="list-one d-flex align-items-start mb30">
                                <span class="list-icon flex-shrink-0 flaticon-security"></span>
                                <div class="list-content flex-grow-1 ml20">
                                    <h4 class="mb-1">Safe and secure</h4>
                                    <p class="text mb-0 fz15">
                                      Every interaction is protected-----ensuring you a secured learning space.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 offset-xl-1 wow fadeInLeft" data-wow-delay="500ms">
                        <div class="about-img"><img class="w100" src="images/about/about-5.jpg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Funfact -->
    <section class="bgc-light-yellow pb90 pb30-md overflow-hidden maxw1700 mx-auto bdrs4">
        <img class="left-top-img wow zoomIn d-none d-lg-block" src="images/vector-img/left-top.png" alt="">
        <img class="right-bottom-img wow zoomIn d-none d-lg-block" src="images/vector-img/right-bottom.png" alt="">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-xl-4 offset-xl-1 wow fadeInRight" data-wow-delay="100ms">
                    <div class="cta-style6 mb30-sm">
                        <h2 class="cta-title mb25">Start your journey</h2>
                        <p class="text-thm2 fz15 mb25">
                          Start your journey towards knowledge, growth, and success. Whether you're preparing for exams, advancing your career, or simply expanding your horizons, we're here to help you every step of the way.
                        </p>
                        <a href="/login" class="ud-btn btn-thm">Get Started <i class="fal fa-arrow-right-long"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6 offset-xl-1 wow fadeInLeft" data-wow-delay="300ms">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="funfact-style1 bdrs16 text-center ms-md-auto">
                                <ul class="ps-0 mb-0 d-flex justify-content-center">
                                    <li>
                                        <div class="timer title mb15">{{ $countCourse }}</div>
                                    </li>
                                </ul>
                                <p class="fz15 dark-color">Total number of Courses</p>
                            </div>
                            <div class="funfact-style1 bdrs16 text-center ms-md-auto">
                                <ul class="ps-0 mb-0 d-flex justify-content-center">
                                    <li>
                                        <div class="timer title mb15">{{ $countUser }}</div>
                                    </li>
                                </ul>
                                <p class="fz15 dark-color">Total number of usesrs</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="funfact-style1 bdrs16 text-center">
                                <ul class="ps-0 mb-0 d-flex justify-content-center">
                                    <li>
                                        <div class="title mb15">{{ $countReview }}</div>
                                    </li>
                                </ul>
                                <p class="fz15 dark-color">Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
