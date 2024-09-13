@extends('layouts.main')
@section('title', 'Mentor')
<style>

    .top-30{
        top:25% !important;
        left: 40% !important;
        display: table !important;
    }

</style>
@section('content')

<!-- Breadcumb Sections -->
<section class="breadcumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcumb-style1">
                    <div class="breadcumb-list">
                        <a href="/">Home</a>
                        <a href="#">Mentor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcumb Sections -->
<section class="breadcumb-section pt-0">
    <div class="cta-service-v1 cta-banner mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg px30-lg px10-xs">
        {{-- <img class="left-top-img wow zoomIn" src="/images/vector-img/left-top.png" alt="">
        <img class="right-bottom-img wow zoomIn" src="/images/vector-img/right-bottom.png" alt="">
        <img class="service-v1-vector bounce-y d-none d-lg-block" src="/images/vector-img/vector-service-v1.png" alt=""> --}}
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-7 mb-lg-0 mb-4">
                    <div class="position-relative">
                        <h2>Mentor List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Listings All Lists -->
<section class="pt30 pb90">
    <div class="container">
        <div class="row">
            @foreach($users as $user)
            <div class="col-md-6 col-lg-4 col-xl-3 mb-lg-0 mb-4">
                <div class="freelancer-style1 bdrs12 bdr1 hover-box-shadow">
                    <div class="d-flex align-items-center">
                        <div class="thumb w90 position-relative rounded-circle">
                            <img class="rounded-circle mx-auto" width="100" src="{{ asset('profile/'.$user->image) }}" alt="profile image">
                            
                        </div>
                        <div class="ml20">
                            <h5 class="title mb-1">{{ $user->name ?? 'N/A' }}</h5>
                            @if ($user->last_seen >= now()->subMinutes(5))
                                <div class="available-asap position-absolute top-0">
                                    <i class="fa fa-bolt"></i>
                                    <span class="ml-1 font-weight-600">Available ASAP</span>
                                </div>
                            @else
                            
                            @endif
                        </div>
                    </div>
                    <div class="details">
                        <div class="review mt20 mb5">
                            {{-- <p class="list-inline-item"><i class="fas fa-star fz10 review-color pr10"></i><span class="dark-color fw500">4.9</span></p> --}}
                            <p class="list-inline-item"><i class="flaticon-place fz16 dark-color pr10"></i><span class="dark-color fw500">{{ $user->country }}</span></p>
                            <p class="list-inline-item"><i class="fa fa-award pr10"></i><span class="dark-color fw500">{{ $user->menotr->experience ?? 0 }} Years Experience </span></p>
                        </div>
                        <p class="text">{{ \Str::limit($user->mentor->about ?? 'N/A', 100) }}</p>
                        
                        <div class="d-grid">
                            <a href="{{ route('mentor.show',$user->id) }}" class="ud-btn btn-thm-border bdrs12 hover-default-box-shadow1">View Profile<i class="fal fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="mbp_pagination mt30 text-center">
                <ul class="page_navigation">
                    
                </ul>
            </div>
        </div>
    </div>
</section>


@endsection
