@extends('layouts.main')
@section('title', 'Course Details')
@section('content')


<!-- Breadcumb Sections -->
<section class="breadcumb-section wow fadeInUp mt40">
    <div class="cta-commmon-v1 cta-banner bgc-thm2 mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg">
      <img class="left-top-img wow zoomIn" src="/images/vector-img/left-top.png" alt="">
      <img class="right-bottom-img wow zoomIn" src="/images/vector-img/right-bottom.png" alt="">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="position-relative wow fadeInUp" data-wow-delay="300ms">
              <h2 class="text-white">Courses</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Breadcumb Sections -->



<!-- Service Details -->
<section class="pt10 pb90 pb30-md">
    <div class="container">
        <div class="row wrap">
            <div class="col-lg-8">
                <div class="column">
                    <div class="service-single-sldier vam_nav_style slider-1-grid owl-carousel owl- mb60">
                      <div class="item">
                        <div class="thumb p50 p30-sm"><img src="{{ $course->image }}" alt="" class="w-100"></div>
                      </div>
                      <div class="item">
                        <div class="thumb p50 p30-sm"><img src="{{ $course->image  }}" alt="" class="w-100"></div>
                      </div>
                      <div class="item">
                        <div class="thumb p50 p30-sm"><img src="{{ $course->image  }}" alt="" class="w-100"></div>
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
                                
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-item2p" role="tabpanel" aria-labelledby="nav-item2p-tab">
                                        <div class="price-content">
                                            <div class="h5 mb-2">{{ $course->title }}</div>
                                            <p class="text fz14">
                                                {{ $course->description }}
                                            </p>
                                            <ul class="p-0 mb15 d-sm-flex align-items-center">
                                                <li class="fz14 fw500 dark-color"><i class="flaticon-sandclock fz20 text-thm2 me-2 vam"></i>
                                                    {{ $course->duration }} Weeks
                                                </li>
                                                <li class="fz14 fw500 dark-color"><i class="flaticon-people fz20 text-thm2 me-2 vam"></i>
                                                    
                                                </li>
                                            </ul>
                                            <hr class="opacity-100 mb20">
                                            <div class="d-grid">
                                                <h3>Prefer</h3>
                                                <form action="{{ route('proposal.store') }}" method="post" class="session-list">
                                                    @csrf
                                                    <div class="choose__prefer ">
                                                        <div class="py-2">
                                                            <label class="session-label">
                                                                <input type="radio" name="session" value="Human Tutor">
                                                                <div class="session-info session-item">
                                                                    <h4>Human Tutor</h4>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="py-2">
                                                            <label class="session-label ">
                                                                <input type="radio" name="session" value="AI Tutor" onclick="AI()">
                                                                <div class="session-info session-item">
                                                                    <h4>AI Tutor</h4>
                                                                </div>
                                                            </label>                                                        
                                                        </div>
                                                    </div>
                                                    <hr class="opacity-100 mt20 mb15">
                                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                                    <button type="submit" class="ud-btn btn-thm w-100">Enroll Now<i class="fal fa-arrow-right-long"></i></button>
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
                        <img class="w-100" src="{{  $course->image }}" alt="">
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
<script>
    function AI(){
        alert("UNAVAILABLE! Please choose another prefer?");
        return false;
    }
</script>