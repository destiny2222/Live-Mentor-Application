@extends('layouts.main')
@section('title', 'Tutor')
@section('content')
<style>
    .oni{
        right: 36%;
    }

    .online.offline{
        background-color: orange !important;
    }
</style>
<section class="breadcumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-lg-10">
                <div class="breadcumb-style1 mb10-xs">
                    <div class="breadcumb-list">
                        <a href="#">Home</a>
                        <a href="#">Services</a>
                        <a href="#">Tutor</a>
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
                        <h2>Tutor</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Listings All Lists -->
<section class="pt30 pb90" id="tutor">
    <div class="container">
        <div class="row">
            @foreach ($tutors as $tutor)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="freelancer-style1 text-center bdr1 hover-box-shadow">
                    <div class="thumb  mb25 mx-auto position-relative rounded-circle">
                        <img class="rounded-circle mx-auto" width="100" src="{{ asset('profile/'.$tutor->user->image) }}" alt="" />
                        @if ($tutor->user->last_seen >= now()->subMinutes(5))
                          <span class="online position-absolute oni"></span>
                        @else
                          <span class="online offline position-absolute oni"></span>
                        @endif
                       
                    </div>
                    <div class="details">
                        <h5 class="title mb-1">{{ $tutor->user->name }}</h5>
                        <p class="mb-0">{{ $tutor->title }}</p>
                        <div class="review">
                            <p>
                                <span class="dark-color fw500">{{ number_format($tutor->averageRating(), 1) }}</span>
                                ({{ $tutor->reviewCount() }} reviews)
                            </p>
                        </div>
                        <div class="skill-tags d-flex align-items-center justify-content-center mb5">
                            @php $count = 0; @endphp
                            @foreach ($tutor->skill as $skills)
                                @if ($count < 3)
                                    <span class="tag ms-2">{{ $skills }}</span>
                                    @php $count++; @endphp
                                @endif
                            @endforeach
                        </div>
                        <div class="d-grid mt15">
                            <a href="{{ route('tutor.profile', $tutor->user->id)}}" class="ud-btn btn-light-thm">View Profile<i class="fal fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="row">
            <div class="mbp_pagination mt30 text-center">
                
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endsection


