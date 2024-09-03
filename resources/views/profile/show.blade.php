@extends('layouts.main')
@section('title',  'Profile')
@section('content')
    <!-- Breadcumb Sections -->
    <section class="breadcumb-section">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-lg-10">
              <div class="breadcumb-style1 mb10-xs">
                <div class="breadcumb-list">
                  <a href="#">Home</a>
                  <a href="#">User</a>
                  <a href="#">Profile</a>
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
        <div
          class="cta-service-v1 freelancer-single-style mx-auto maxw1700 pt120 pt60-sm pb120 pb60-sm bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg px30-lg">
          <img class="left-top-img wow zoomIn" src="images/vector-img/left-top.png" alt="">
          <img class="right-bottom-img wow zoomIn" src="images/vector-img/right-bottom.png" alt="">
          <div class="container">
            <div class="row wow fadeInUp">
              <div class="col-xl-7">
                <div class="position-relative">
                
                    <div class="list-meta d-sm-flex align-items-center mt30">
                        <a class="position-relative freelancer-single-style" href="javascript:void()">
                            <span class="online"></span>
                            <img class="rounded-circle w-100 wa-sm mb15-sm" src="{{ asset('profile/'.$user->image) }}" alt="Freelancer Photo">
                        </a>
                        <div class="ml20 ml0-xs">
                            <h5 class="title mb-1">{{ $user->name }}</h5>
                            @if($user->role == 'tutor')
                             <p class="mb-0">{{ $user->tutor->title }}</p>
                            @elseif($user->role == 'mentor')
                             <p class="mb-0">{{ $user->mentor->title }}</p>
                            @endif
                            <p class="mb-0 dark-color fz15 fw500 list-inline-item mb5-sm"><i class="fas fa-star vam fz10 review-color me-2"></i> {{ number_format($user->averageRating(), 1) }} reviews</p>
                            <p class="mb-0 dark-color fz15 fw500 list-inline-item ml15 mb5-sm ml0-xs"><i class="flaticon-place vam fz20 me-2"></i> {{ $user->conutry }}</p>
                            <p class="mb-0 dark-color fz15 fw500 list-inline-item ml15 mb5-sm ml0-xs"><i class="flaticon-30-days vam fz20 me-2"></i> Member since {{ $user->created_at->format("F j, Y") }}</p>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Service Details -->
      <section class="pt10 pb90 pb30-md">
        <div class="container">
          <div class="row wow fadeInUp">
            <div class="col-lg-8">
              
              <div class="service-about">
                <h4>Description</h4>
                @if($user->role == 'tutor')
                    <p class="text mb30">{{  $user->tutor->description }}</h2>
                @elseif($user->role == 'mentor')
                    <p class="text mb30">{{  $user->mentor->about }}</h2>
                @endif
                <hr class="opacity-100 mb60 mt60">
                    <h4 class="mb30">Education</h4>
                    <div class="educational-quality">
                        @foreach ($user->education as $education) 
                        <div class="m-circle text-thm">M</div>
                            <div class="wrapper mb40">
                                <span class="tag">{{  $education->start_date }} - {{ $education->end_date }}</span>
                                <h5 class="mt15">{{ $education->degree }}</h5>
                                <h6 class="text-thm">{{ $education->school }}</h6>
                                <p>{{ $education->description }}</p>
                            </div>
                        @endforeach
                    </div>
                    <hr class="opacity-100 mb60">
                    <h4 class="mb30">Work & Experience</h4>
                    @foreach($user->experiences as $experience)
                     <div class="educational-quality">
                         <div class="m-circle text-thm">M</div>
                         <div class="wrapper mb40">
                             <span class="tag">{{ $experience->start_date }} - {{ $experience->end_date }}</span>
                             <h5 class="mt15">{{ $experience->company }}</h5>
                             <h6 class="text-thm">{{ $experience->company }}</h6>
                             <p>{{ $experience->description }}</p>
                         </div>
                     </div>
                    @endforeach

                    <hr class="opacity-100 mb60">
                    <h4 class="mb30">Awards and Certificates</h4>
                    @foreach($user->certification as $certification)
                    <div class="educational-quality ps-0">
                        <div class="wrapper mb40">
                            <span class="tag">{{ $certification->date }} - {{ $certification->date_end }}</span>
                            <h5 class="mt15">{{ $certification->title }}</h5>
                            <h6 class="text-thm">{{ $certification->company }}</h6>
                            <p>{{ $certification->description }}</p>
                        </div>
                    </div>
                    @endforeach
              </div>
            </div>
            <div class="col-lg-4">
              <div class="blog-sidebar ms-lg-auto">
                <div class="price-widget pt25 widget-mt-minus bdrs8">
                    <div class="category-list mt20">
                        <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                            <span class="text"><i class="flaticon-place text-thm2 pe-2 vam"></i>Location</span> <span class="">{{ $user->conutry }}</span>
                        </a>
                        <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                            <span class="text"><i class="flaticon-30-days text-thm2 pe-2 vam"></i>Member since</span> <span class="">{{ $user->created_at->format('F j') }}</span>
                        </a>
                        <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                            <span class="text"><i class="flaticon-mars text-thm2 pe-2 vam"></i>Gender</span> <span class="">{{ $user->gender }}</span>
                        </a>
                        <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                            <span class="text"><i class="flaticon-translator text-thm2 pe-2 vam"></i>Languages</span> <span class="">English</span>
                        </a>
                        <a class="d-flex align-items-center justify-content-between mb-3" href="#">
                            <span class="text"><i class="flaticon-sliders text-thm2 pe-2 vam"></i>English Level</span> <span class="">{{ $user->language }}</span>
                        </a>
                    </div>
                </div>
                <div class="sidebar-widget mb30 pb20 bdrs8">
                  <h4 class="widget-title">My Skills</h4>
                  @if($user->role == 'tutor')
                    <div class="tag-list mt30">
                        @foreach ($user->tutor->skill as $skills)
                        <a href="#">{{ $skills }}</a>
                        @endforeach
                    </div>
                  @else
                    <div class="tag-list mt30">
                        @foreach ($user->mentor->Skills as $skill)
                        <a href="#">{{ $skill }}</a>
                        @endforeach
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection