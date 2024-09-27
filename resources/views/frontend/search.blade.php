@extends('layouts.main')
@section('title', 'Course')
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
            <h2 class="text-white">Course</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcumb Sections -->


    <!-- Listings All Lists -->
    <section class="pt30 pb90">
      <div class="container">
        <div class="row">
          @forelse ($courses as $course)
            <div class="col-sm-6 col-xl-3">
              <div class="listing-style1">
                <div class="list-thumb">
                  <img class="w-100" src="{{ asset('upload/courses/'.$course->image) }}" alt="">
                  <a href="{{ route('course.details', $course->slug) }}" class="listing-fav fz12"><span class="far fa-heart"></span></a>
                </div>
                <div class="list-content">
                  <p class="list-text body-color fz14 mb-1">{{ $course->category->name }}</p>
                  <h5 class="list-title"><a href="{{ route('course.details', $course->slug) }}">{{ $course->title }}</a></h5>
                  <p>{{ \Str::limit($course->description, 100 ) }}</p>
                  <hr class="my-2">
                  <div class="list-meta d-flex justify-content-between align-items-center mt15">
                    <a class="d-flex" href="{{ route('course.details', $course->slug) }}">
                      <span class="fz14 text-primary">View</span>
                    </a>
                    <div class="budget">
                      <p class="mb-0 body-color">Price <span class="fz17 fw500 dark-color ms-1">&#x20A6;{{ number_format($course->price, 2) }}</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @empty
              
          @endforelse
        </div>
        <div class="row text-center justify-content-center">
          <div class="mbp_pagination mt30 text-center">
             <div class="text-center">
                 {{ $courses->links() }}
             </div>
          </div>
        </div>
      </div>
    </section>

@endsection