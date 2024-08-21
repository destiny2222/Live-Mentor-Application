@extends('layouts.master')
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
              <h5 class="">Complete your profile <a href="{{ route('tutor.create') }}" class="text-primary">Click Here</a></h5>   
            @endif

            @if ($user->checkTutorActiveStatus())
                <p class="badge bg-primary">Your account is not active yet. underdown going verification as a tutor</p>
            @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-xxl-4">
          <div class="d-flex align-items-center justify-content-between statistics_funfact">
            <div class="details">
              <div class="fz15">Enroll Course</div>
              <div class="title">25</div>
              <div class="text fz14"><span class="text-thm">10</span> New Offered</div>
            </div>
            <div class="icon text-center"><i class="flaticon-contract"></i></div>
          </div>
        </div>
        <div class="col-sm-6 col-xxl-4">
          <div class="d-flex align-items-center justify-content-between statistics_funfact">
            <div class="details">
              <div class="fz15">Completed Courses</div>
              <div class="title">1292</div>
              <div class="text fz14"><span class="text-thm">80+</span> New Completed</div>
            </div>
            <div class="icon text-center"><i class="flaticon-success"></i></div>
          </div>
        </div>
        <div class="col-sm-6 col-xxl-4">
          <div class="d-flex align-items-center justify-content-between statistics_funfact">
            <div class="details">
              <div class="fz15">Total Review</div>
              <div class="title">22,786</div>
              <div class="text fz14"><span class="text-thm">290+</span> New Review</div>
            </div>
            <div class="icon text-center"><i class="flaticon-review-1"></i></div>
          </div>
        </div>
      </div>
      @if ($user->role == 'user')
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
                      @forelse ($enrolledCourses as $course)
                        <div class="col-sm-6 col-xl-4">
                          <div class="listing-style1">
                            <div class="list-thumb">
                              <img class="w-100" src="{{ asset('upload/courses/'.$course->image) }}" alt="">
                              <a href="{{ route('course.details', $course->slug) }}" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete Item" aria-label="Delete Item">
                                <span class="flaticon-delete"></span>
                              </a>
                            </div>
                            <div class="list-content">
                              <p class="list-text body-color fz14 mb-1">{{ $course->category->name }}</p>
                              <h5 class="list-title">
                                <a href="{{ route('course.details', $course->slug) }}">
                                  {{ $course->title }}
                                </a>
                              </h5>
                              <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat voluptatum deleniti, iste expedita ducimus architecto nobis.
                              </p>
                              <hr class="my-2">
                              <div class="list-meta d-flex justify-content-between align-items-center mt15">
                                <a class="d-flex" href="{{ route('course.details', $course->slug) }}">
                                  <span class="fz14" style="text-transform: uppercase">make payment</span>
                                </a>
                                <div class="budget">
                                  <p class="mb-0 body-color">Price <span class="fz17 fw500 dark-color ms-1">${{ $course->price }}</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @empty
                      <div class="col-sm-12 col-xl-12">
                        <p> Empty  Course <a href="{{ route('course.index') }}" class="btn btn-primary text-white" target="_blank" rel="noopener noreferrer">Add Course</a></p>
                      </div>
                      @endforelse
                    </div>
                  </div>
                </div>
              </div>
              <div class="mbp_pagination text-center">
                {{ $enrolledCourses->links() }}
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="row">
          <div class="col-md-12 col-xxl-12">
            <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
              <div class="d-flex justify-content-between bdrb1 pb15 mb20">
                <h5 class="title">Most Viewed Services</h5>
                <a class="text-decoration-underline text-thm6" href="#">View All</a>
              </div>
              <div class="dashboard-img-service">
                <div class="listing-style1 list-style d-block d-xl-flex align-items-center border-0 mb10">
                  <div class="list-thumb flex-shrink-0 bdrs4">
                    <img class="w-100" src="images/listings/g-1.jpg" alt="">
                  </div>
                  <div class="list-content flex-grow-1 pt10 pb10 pl15 pl0-lg">
                    <h6 class="list-title mb-2"><a href="page-services-single.html">I will design modern websites in figma or adobe xd</a></h6>
                    <div class="list-meta d-flex justify-content-between align-items-center">
                      <div class="review-meta d-flex align-items-center">
                        <i class="fas fa-star fz10 review-color me-2"></i>
                        <p class="mb-0 body-color fz14"><span class="dark-color me-2">4.82</span></p>
                      </div>
                      <div class="budget">
                        <p class="mb-0 body-color">Starting at<span class="fz17 fw500 dark-color ms-1">$983</span></p>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="opacity-100 mt-0">
                <div class="listing-style1 list-style d-block d-xl-flex align-items-center border-0 mb10">
                  <div class="list-thumb flex-shrink-0 bdrs4">
                    <img class="w-100" src="images/listings/g-2.jpg" alt="">
                  </div>
                  <div class="list-content flex-grow-1 pt0 pb10 pl15 pl0-lg">
                    <h6 class="list-title mb-2"><a href="page-services-single.html">I will create modern flat design illustration</a></h6>
                    <div class="list-meta d-flex justify-content-between align-items-center">
                      <div class="review-meta d-flex align-items-center">
                        <i class="fas fa-star fz10 review-color me-2"></i>
                        <p class="mb-0 body-color fz14"><span class="dark-color me-2">4.82</span></p>
                      </div>
                      <div class="budget">
                        <p class="mb-0 body-color">Starting at<span class="fz17 fw500 dark-color ms-1">$983</span></p>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="opacity-100 mt-0">
                <div class="listing-style1 list-style d-block d-xl-flex align-items-center border-0 mb-0">
                  <div class="list-thumb flex-shrink-0 bdrs4">
                    <img class="w-100" src="images/listings/g-6.jpg" alt="">
                  </div>
                  <div class="list-content flex-grow-1 pt0 pb-0 pl15 pl0-lg pe-0">
                    <h6 class="list-title mb-2"><a href="page-services-single.html">I will build a fully responsive design in HTML,CSS, bootstrap, and javascript</a></h6>
                    <div class="list-meta d-flex justify-content-between align-items-center">
                      <div class="review-meta d-flex align-items-center">
                        <i class="fas fa-star fz10 review-color me-2"></i>
                        <p class="mb-0 body-color fz14"><span class="dark-color me-2">4.82</span></p>
                      </div>
                      <div class="budget">
                        <p class="mb-0 body-color">Starting at<span class="fz17 fw500 dark-color ms-1">$983</span></p>
                      </div>
                    </div>
                  </div>
                </div>
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
@endsection