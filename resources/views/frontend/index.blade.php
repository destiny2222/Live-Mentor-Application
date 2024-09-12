@extends('layouts.main')
@section('title', 'Home')
<style>

    /* Large devices (desktops,  less than 1200px) */
    @media (max-width:1399.98px) { 
        .animate-up-1{
            inline-size:500px;
        }
        .home16-hero-fltimg {
         max-width:670px !important;
        }
    }

    

    /* X-Small devices (portrait phones, less than 576px) */
    @media (min-width:576px) { 
        .animate-up-1{
            inline-size: 750px;
         }
       
    }
    

</style>
@section('content')
<!-- Home Banner Style V1 -->
<section class="hero-home16">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-7">
                <div class="home14-hero-content wow fadeInRight">
                    <h1 class="title animate-up-1 mb25">A unified front For <br class="d-none d-xl-block"> mentors and scholars</h1>
                    <p class="text animate-up-2">Join the mentor community: learn, lead and thrive<br class="d-none d-lg-block"> 
                        in your career path</p>
                    <div class="d-sm-flex align-items-center mt30 animate-up-3">
                        <a href="{{ route('register') }}" class="ud-btn btn-thm4 me-3 bdrs120 btn-1">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img class="home16-hero-fltimg  d-none d-xl-block wow fadeInLeft" src="images/about/home16-hero-img-1.jpg" alt="">
</section>

<section class="pb40-md pb90 pt-80">
    <div class="container">
        <div class="row align-items-center wow fadeInUp" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
            <div class="col-lg-9">
                <div class="main-title2">
                    <h2 class="title">Explore our extensive range Of courses</h2>
                    <p class="paragraph">JOIN TO CHANGE YOUR LIFE</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="text-start text-lg-end mb-4 mb-lg-2">
                    <a class="ud-btn2" href="{{ route('course.index') }}">All Courses<i class="fal fa-arrow-right-long"></i></a>
                </div>
            </div>
        </div>
        <div class="row  d-lg-flex wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            @foreach ($categories as $category)
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <a href="{{ route('category.courses', $category->slug) }}">
                    <div class="iconbox-style1 bdr1" style="background:{{ $category->color }};">
                        <div class="icon"><span class="{{ $category->image }}"></span></div>
                        <div class="details mt20">
                            <p class="mb-0 text-white">{{ $category->name }}</p>
                            <p class="text mb5 text-white">{{ isset($counts[$category->id]) ? $counts[$category->id] : 0 }} Courses</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>


<section class="p-0">
    <div class="cta-banner3 mx-auto maxw1600 pt120 pt60-lg pb90 pb60-lg position-relative overflow-hidden">
      <div class="container">
        <div class="row">
          <div class="col-xl-5 mb-lg-0 mb-4 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
            <div class="mb30">
              <div class="main-title">
                <h2 class="title d-xl-block">A whole world of  <br class="d-none "> talent at your fingertips</h2>
              </div>
            </div>
            <div class="why-chose-list">
              <div class="list-one d-flex align-items-start mb30">
                <span class="list-icon flex-shrink-0 flaticon-badge"></span>
                <div class="list-content flex-grow-1 ml20">
                  <h4 class="mb-1">Proof of quality</h4>
                  <p class="text mb-0 fz15">Check any pro’s work samples, client reviews, and identity <br class="d-none d-lg-block"> verification.</p>
                </div>
              </div>
              <div class="list-one d-flex align-items-start mb30">
                <span class="list-icon flex-shrink-0 flaticon-money"></span>
                <div class="list-content flex-grow-1 ml20">
                  <h4 class="mb-1">Choose a mentor</h4>
                  <p class="text mb-0 fz15">Send proposals to mentors in few steps.</p>
                </div>
              </div>
              <div class="list-one d-flex align-items-start mb30">
                <span class="list-icon flex-shrink-0 flaticon-security"></span>
                <div class="list-content flex-grow-1 ml20">
                  <h4 class="mb-1">Learn Online</h4>
                  <p class="text mb-0 fz15">Access personalised Courses.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <img class="cta-banner3-img wow fadeInLeft" src="images/about/about-5.jpg" alt="" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInLeft;">
    </div>
  </section>



<!-- Our CTA -->
<section class="our-cta position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-xl-5 mb-lg-0 mb-4 order-lg-1 order-2">
                <img class="home16-ctaimg-v1 w-100 wow fadeInRight" src="images/about/about-17.jpeg" alt="">
            </div>
            <div class="col-md-6 col-xl-4 mb-lg-0 mb-4 order-lg-2 order-1 offset-xl-2">
                <div class="cta-style3 wow fadeInLeft">
                    <h2 class="cta-title">Empower the next generation on Mentor</h2>
                    <p class="cta-text">Focus on guiding and inspiring young minds through mentorship.</p>
                    
                    <a href="{{ route('register') }}" class="ud-btn btn-thm-border bdrs12">Get Started <i class="fal fa-arrow-right-long"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>


 <!-- Popular Services -->
 <section class="pb100 pt-0" style="">
    <div class="container">
      <div class="row align-items-center wow fadeInUp">
        <div class="col-xl-3">
          <div class="main-title mb30-lg">
            <h2 class="title">Find the right Mentor</h2>
            <p class="paragraph">Engage with reliable and consistent mentor.</p>
          </div>
        </div>
        <div class="col-xl-9">
            <div class="text-start text-lg-end">
                <a class="ud-btn btn-light-thm " href="{{ route('mentor.index') }}">Explore all<i class="fal fa-arrow-right-long"></i></a>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-12">
            <div class="slider-outer-dib vam_nav_style dots_none slider-5-grid owl-carousel owl-theme wow fadeInUp" data-wow-delay="300ms">
                @foreach ($mentors as $mentor)
                <div class="item">
                    <div class="listing-style1 bdrs16">
                        <div class="list-thumb">
                          <a href="{{ route('mentor.show',$mentor->id) }}"> <img class="w-100" src="{{ asset('profile/'.$mentor->image) }}" alt=""> </a>
                          {{-- <a href="" class="listing-fav fz12"><span class="far fa-heart"></span></a> --}}
                          <p class="image-dimmer"> <i class="fa fa"></i>  </p>
                            @if ($mentor->last_seen >= now()->subMinutes(5))
                                <div class="available-asap position-absolute">
                                    <i class="fa fa-bolt"></i>
                                    <span class="ml-1 font-weight-600">Available ASAP</span>
                                </div>
                            @else
                            
                            @endif
                        </div>
                        <div class="list-content">
                            <a href="{{ route('mentor.show',$mentor->id) }}">
                                <p class="list-text body-color fz14 mb-1">{{ $mentor->name }}</p>
                                <h5 class="list-title"><a href="{{ route('mentor.show',$mentor->id) }}">{{ \Str::limit($mentor->mentor->about ?? '', 50, '...') }}</a></h5>
                                <div class="review-meta d-flex align-items-center">
                                    <span><i class="fa fa-bells"></i> {{ $mentor->countMentorSession() ?? '0' }} sessions </span></p>
                                </div>
                            </a>    
                          <hr class="my-2">
                          <div class="list-meta d-flex justify-content-between align-items-center mt15">
                            <a class="" href="{{ route('mentor.show',$mentor->id) }}">
                                <div>Experience</div>
                              <span class="fz14 " style="font-weight: 700; color: #000;">{{ $mentor->experience }} years </span>
                            </a>
                            <div class="budget">
                                <p class="mb-0 body-color"><span class="fz17 fw500 dark-color ms-1">({{ $mentor->reviewCount() }} reviews)</span></p>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
      </div>
    </div>
  </section>





@endsection
