@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <!-- Home Banner Style V1 -->
    <section class="hero-home16">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-xl-7">
            <div class="home14-hero-content wow fadeInRight">
              <h1 class="title animate-up-1 mb25">Find a mentor to suit  <br class="d-none d-xl-block">your needs</h1>
              <p class="text animate-up-2">work with us to get a mentor for your personalize area of<br class="d-none d-lg-block"> interest to become a pro</p>
              <div class="d-sm-flex align-items-center mt30 animate-up-3">
                <a href="#" class="ud-btn btn-thm4 me-3 bdrs120 btn-1">Get Started</a>
                <a href="#" class="ud-btn btn-white bdr1 bdrs120 btn-2">Find Mentor</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <img class="home16-hero-fltimg d-none d-xl-block wow fadeInLeft" src="images/about/home16-hero-img-1.png" alt="">
    </section>


    <!-- Need something --> 
    <section class="our-features  pt-80">
      <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-lg-12">
            <div class="main-title">
              <h2>Need something done?</h2>
              <p class="text">Most viewed and all-time top-selling services</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="iconbox-style1 border-less p-0">
              <div class="icon before-none"><span class="flaticon-cv"></span></div>
              <div class="details">
                <h4 class="title mt10 mb-3">Post a job</h4>
                <p class="text">It’s free and easy to post a job. Simply fill <br class="d-none d-xxl-block"> in a title, description.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="iconbox-style1 border-less p-0">
              <div class="icon before-none"><span class="flaticon-web-design"></span></div>
              <div class="details">
                <h4 class="title mt10 mb-3">Choose freelancers</h4>
                <p class="text">It’s free and easy to post a job. Simply fill <br class="d-none d-xxl-block"> in a title, description.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="iconbox-style1 border-less p-0">
              <div class="icon before-none"><span class="flaticon-secure"></span></div>
              <div class="details">
                <h4 class="title mt10 mb-3">Pay safely</h4>
                <p class="text">It’s free and easy to post a job. Simply fill <br class="d-none d-xxl-block"> in a title, description.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="iconbox-style1 border-less p-0">
              <div class="icon before-none"><span class="flaticon-customer-service"></span></div>
              <div class="details">
                <h4 class="title mt10 mb-3">We’re here to help</h4>
                <p class="text">It’s free and easy to post a job. Simply fill <br class="d-none d-xxl-block"> in a title, description.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Popular Services -->
    <section class="pb pt-0">
      <div class="container">
        <div class="row align-items-center wow fadeInUp">
          <div class="col-xl-12">
            <div class="main-title mb30-lg">
              <h2 class="title">Explore Courses</h2>
              <!-- <p class="paragraph">Most viewed and all-time top-selling services</p> -->
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($course as $courses)
            <div class="col-12 col-sm-4 col-xl-4">
              <div class="listing-style1 bdrs16">
                <div class="list-thumb">
                  <img class="w-100" src="{{ asset('upload/courses/'.$courses->image) }}" alt="">
                  <a href="#" class="listing-fav fz12"><span class="far fa-heart"></span></a>
                </div>
                <div class="list-content">
                  <p class="list-text body-color fz14 mb-1">{{  $courses->category->name  }}</p>
                  <h5 class="list-title"><a href="{{ route('course.details', $courses->slug) }}">{{ $courses->title }}</a></h5>
                  <hr class="my-2">
                  <div class="list-meta d-flex justify-content-between align-items-center mt15">
                    <a class="d-flex" href="{{ route('course.details', $courses->slug) }}">
                      <span class="fz14 text-primary">View</span>
                    </a>
                    <div class="budget">
                      <p class="mb-0 body-color">Price <span class="fz17 fw500 dark-color ms-1">&#x20A6;{{ number_format($courses->price, 2) }}</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          <div class="col-lg-12">
            <div class="text-center mt30">
              <a class="ud-btn btn-light-thm bdrs12" href="page-service-v1.html">All Services<i class="fal fa-arrow-right-long"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Browse talent by category -->
    <section class="">
      <div class="container">
        <div class="row align-items-center wow fadeInUp">
          <div class="col-lg-9">
            <div class="main-title">
              <h2 class="title">Browse Top Mentor</h2>
              <!-- <p class="paragraph">Most viewed and all-time top-selling services</p> -->
            </div>
          </div>
          <div class="col-lg-3">
            <div class="text-start text-lg-end mb-4 mb-lg-2">
              <a class="ud-btn btn-light-thm bdrs12" href="employee.html">All Category<i class="fal fa-arrow-right-long"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="slider-outer-dib vam_nav_style dots_none slider-5-grid owl-carousel owl-theme wow fadeInUp" data-wow-delay="300ms">
              <div class="item">
                <div class="feature-style1 mb30 bdrs16">
                  <div class="feature-img bdrs16 overflow-hidden"><img class="w-100" src="images/listings/category-1.jpg" alt=""></div>
                  <div class="feature-content">
                    <div class="top-area">
                      <h6 class="title mb-1">1.853 skills</h6>
                      <h5 class="text">Development & <br class="d-none d-lg-block">IT</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="feature-style1 mb30 bdrs16">
                  <div class="feature-img bdrs16 overflow-hidden"><img class="w-100" src="images/listings/category-2.jpg" alt=""></div>
                  <div class="feature-content">
                    <div class="top-area">
                      <h6 class="title mb-1">1.853 skills</h6>
                      <h5 class="text">Design & <br class="d-none d-lg-block">Creative</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="feature-style1 mb30 bdrs16">
                  <div class="feature-img bdrs16 overflow-hidden"><img class="w-100" src="images/listings/category-3.jpg" alt=""></div>
                  <div class="feature-content">
                    <div class="top-area">
                      <h6 class="title mb-1">1.853 skills</h6>
                      <h5 class="text">Digital <br class="d-none d-lg-block">Marketing</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="feature-style1 mb30 bdrs16">
                  <div class="feature-img bdrs16 overflow-hidden"><img class="w-100" src="images/listings/category-4.jpg" alt=""></div>
                  <div class="feature-content">
                    <div class="top-area">
                      <h6 class="title mb-1">1.853 skills</h6>
                      <h5 class="text">Writing & <br class="d-none d-lg-block">Translation</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="feature-style1 mb30 bdrs16">
                  <div class="feature-img bdrs16 overflow-hidden"><img class="w-100" src="images/listings/category-5.jpg" alt=""></div>
                  <div class="feature-content">
                    <div class="top-area">
                      <h6 class="title mb-1">1.853 skills</h6>
                      <h5 class="text">Music & <br class="d-none d-lg-block">Audio</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="feature-style1 mb30 bdrs16">
                  <div class="feature-img bdrs16 overflow-hidden"><img class="w-100" src="images/listings/category-3.jpg" alt=""></div>
                  <div class="feature-content">
                    <div class="top-area">
                      <h6 class="title mb-1">1.853 skills</h6>
                      <h5 class="text">Music & <br class="d-none d-lg-block">Audio</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="feature-style1 mb30 bdrs16">
                  <div class="feature-img bdrs16 overflow-hidden"><img class="w-100" src="images/listings/category-1.jpg" alt=""></div>
                  <div class="feature-content">
                    <div class="top-area">
                      <h6 class="title mb-1">1.853 skills</h6>
                      <h5 class="text">Development & <br class="d-none d-lg-block">IT</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- Our Funfact -->
    <section class="our-cta bgc-thm4 pt90 pb90 pt60-md pb60-md mt100 mt0-lg">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-md-6 col-lg-7 col-xl-5 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
            <div class="cta-style3">
              <h2 class="cta-title">Become a mentor and enjoy life.</h2>
              <p class="cta-text">encapsulates the idea that mentoring others can be a highly rewarding experience.</p>
              <a href="#" class="ud-btn btn-thm2">Get Started <i class="fal fa-arrow-right-long"></i></a>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 col-xl-5 position-relative wow zoomIn" style="visibility: visible; animation-name: zoomIn;">
            <div class="cta-img">
              <img class="w-100" src="images/about/about-3.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our CTA --> 
    <section class="our-cta position-relative">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 col-xl-5">
            <img class="home16-ctaimg-v1 w-100 d-none d-md-block wow fadeInRight" src="images/about/about-17.png" alt="">
          </div>
          <div class="col-md-6 col-xl-4 offset-xl-2">
            <div class="cta-style3 wow fadeInLeft">
              <h2 class="cta-title">Find a Stable Mentor</h2>
              <p class="cta-text">emphasizes the importance of seeking a mentor <br class="d-none d-lg-block">who is reliable and consistent. </p>
              <a href="page-project-v1.html" class="ud-btn btn-thm bdrs12 mr20">View Project <i class="fal fa-arrow-right-long"></i></a>
              <a href="page-dashboard-add-service.html" class="ud-btn btn-thm-border bdrs12">Post a Service <i class="fal fa-arrow-right-long"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- Our CTA --> 
    <section class="cta-home4 bgc-light-yellow pt90 pt60-md pb90 pb60-md">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-7 col-xl-4">
            <div class="cta-style5 wow fadeInUp">
              <span class="app-tag mb25 bg-white">Start today</span>
              <h2 class="cta-title mb15">Download the App</h2>
              <p class="cta-text mb60">Take classes on the go with the realton app. Stream or download to watch on the plane, the subway, or wherever you learn best.</p>
              <div class="app-widget at-home16">
                <div class="row d-flex align-items-center">
                  <div class="col-auto">
                    <a href="#">
                      <div class="app-info bdrs12 mb-1 light-style d-flex align-items-center">
                        <div class="flex-shrink-0">
                          <i class="fab fa-apple fz30 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                          <p class="app-text fz12 mb0">Download on the</p>
                          <h6 class="app-title mb-0 text-white fz15">Apple Store</h6>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="col-auto">
                    <a href="#">
                      <div class="app-info bdrs12 mb-1 light-style d-flex align-items-center">
                        <div class="flex-shrink-0">
                          <i class="fab fa-google-play fz24 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                          <p class="app-text fz12 mb0">Get in on</p>
                          <h6 class="app-title mb-0 text-white fz15">Google Play</h6>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-xl-4 position-relative wow zoomIn d-none d-lg-block">
            <div class="cta-img-home8">
              <img class="w-100" src="images/about/mobile-app-2.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>

    

@endsection