@extends('layouts.main')
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
                  <h2 class="text-white">Session</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Breadcumb Sections -->


<!-- Service Details -->
<section class="pt10">
    <div class="container">
      <div class="row wrap">
        <div class="col-lg-8">
          <div class="column">
            <img src="{{ $groupSession->image }}" alt="" srcset="{{ $groupSession->image }}" class="img-fluid">
            <div class="service-about mt20">
              <h4>Description</h4>
              <p class="text mb30">
                  {!! $groupSession->description !!}
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="column">
            <div class="blog-sidebar ms-lg-auto">
              <div class="price-widget pt25 bdrs8">
                
                <div class="d-grid">
                  <button type="submit" class="ud-btn btn-thm">RSVP for this session</button>
                </div>
              </div>
              <div class="freelancer-style1 service-single mb-0 bdrs8">
                <h4>Hosted by:</h4>
                <div class="wrapper d-flex align-items-center mt20">
                  <div class="thumb position-relative mb25">
                    <img class="rounded-circle mx-auto" width="60" height="60" src="{{ asset('profile/'.$groupSession->user->image) }}" alt="">
                  </div>
                  <div class="ml20">
                      <h5 class="title mb-1">{{ $groupSession->user->name }}</h5>
                      @if ($groupSession->user->role == 'tutor') 
                      <p class="mb-0">{{ $groupSession->user->tutor->title ?? '' }}</p>
                      @elseif($groupSession->user->role == 'mentor') 
                      <p class="mb-0">{{ $groupSession->user->mentor->title ?? '' }}</p>
                      @endif
                  </div>
                </div>
                <hr class="opacity-100">
                <div class="details">
                  <h6 class="mt20 mb20">Topic of expertise</h6>
                  <div class="fl-meta d-flex align-items-center justify-content-between">
                    <a class="meta fw500 text-start">{{ $groupSession->topic_expertise ?? '' }}</a>
                  </div>
                  <h6 class="mt20">Interest areas</h6>
                  <div class="fl-meta d-flex align-items-center justifyinterest-content-between">
                      @foreach ($groupSession->interest_areas as $interest)
                      <a class="meta fw500 text-start">{{ $groupSession->interest ?? '' }}</span></a>
                      @endforeach
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection