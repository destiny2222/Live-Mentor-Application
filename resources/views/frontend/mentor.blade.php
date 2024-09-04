@extends('layouts.main')
@section('title', 'Mentor')
<style>
    .oni{
        right: 0%;
        top:20%;
    }

    .online.offline{
        background-color: orange !important;
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
        <img class="left-top-img wow zoomIn" src="/images/vector-img/left-top.png" alt="">
        <img class="right-bottom-img wow zoomIn" src="/images/vector-img/right-bottom.png" alt="">
        <img class="service-v1-vector bounce-y d-none d-lg-block" src="/images/vector-img/vector-service-v1.png" alt="">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-7">
                    <div class="position-relative">
                        <h2>Mentor List</h2>
                        <div class="advance-search-tab at-home6 bgc-white bdrs12 p10 position-relative border-0">
                            <div class="row">
                                <div class="col-md-9 col-lg-8 col-xl-9">
                                    <div class="advance-search-field mb10-sm">
                                        <form class="form-search position-relative">
                                            <div class="box-search">
                                                <span class="icon far fa-magnifying-glass"></span>
                                                <input class="form-control" type="text" name="search" placeholder="Keyword or freelancer name">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-4 col-xl-3">
                                    <div class="text-center">
                                        <button class="ud-btn btn-thm4 bdrs12 w-100 border-0" type="button">Search</button>
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

<!-- Listings All Lists -->
<section class="pt30 pb90">
    <div class="container">
        <div class="row">
            @foreach($users as $user)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="freelancer-style1 bdrs12 bdr1 hover-box-shadow">
                    <div class="d-flex align-items-center">
                        <div class="thumb w90 position-relative rounded-circle">
                            <img class="rounded-circle mx-auto" width="100" src="{{ asset('profile/'.$user->image) }}" alt="profile image">
                            @if ($user->last_seen >= now()->subMinutes(5))
                                <span class="online position-absolute oni"></span>
                            @else
                                <span class="online offline position-absolute oni"></span>
                            @endif
                        </div>
                        <div class="ml20">
                            <h5 class="title mb-1">{{ $user->name }}</h5>
                            <p class="mb-0" style="font-size: 13px">{{ $user->mentor->title }}</p>
                        </div>
                    </div>
                    <div class="details">
                        <div class="review mt20 mb5">
                            {{-- <p class="list-inline-item"><i class="fas fa-star fz10 review-color pr10"></i><span class="dark-color fw500">4.9</span></p> --}}
                            <p class="list-inline-item"><i class="flaticon-place fz16 dark-color pr10"></i><span class="dark-color fw500">{{ $user->country }}</span></p>
                            <p class="list-inline-item"><i class="fa fa-award pr10"></i><span class="dark-color fw500">{{ $user->getExperiencesCountAttribute() }} Years Experience </span></p>
                        </div>
                        <p class="text">{{ \Str::limit($user->mentor->about, 100) }}</p>
                        <div class="skill-tags d-flex align-items-center justify-content-start mb30 mt20">
                            @php $count = 0; @endphp
                            @foreach( $user->mentor->Skills as $skill)
                                @if ($count < 3)
                                    <span class="tag bgc-thm3 mx10">{{ $skill }}</span>
                                    @php $count++; @endphp
                                @endif
                            @endforeach
                        </div>
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
