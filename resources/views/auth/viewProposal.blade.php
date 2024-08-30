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
                    <h2>Proposal Details</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="packages_table table-responsive">
                        <div class="navtab-style1">
                            <nav>
                                <div class="nav nav-tabs mb20" id="nav-tab2" role="tablist">
                                    <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Details</button>
                                    {{-- <button class="nav-link fw500" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Project</button>
                                    <button class="nav-link fw500" id="nav-item3-tab" data-bs-toggle="tab" data-bs-target="#nav-item3" type="button" role="tab" aria-controls="nav-item3" aria-selected="false">Jobs</button> --}}
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                                    <div class="col-md-12">
                                        <div class="bdrb1 pb20">
                                            <div class="mbp_first position-relative d-sm-flex align-items-center justify-content-start mb30-sm mt30">
                                                <img src="{{ asset('profile/'.$proposal->user->image) }}" class="mr-3 proposal_img" alt="comments-2.png">
                                                <div class="ml20 ml0-xs mt20-xs">
                                                    <div class="del-edit"><span class="flaticon-flag"></span></div>
                                                    <h6 class="mt-0 mb-1">{{  $proposal->user->name }}</h6>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <i class="fas fa-clock vam fz10 review-color me-2"></i>
                                                            <span class="fz15 fw500">{{ \Carbon\Carbon::parse($proposal->time)->format('H:i A') }}</span>
                                                            -
                                                            <span class="fz15 fw500">{{ \Carbon\Carbon::parse($proposal->end_time)->format('H:i A') }}</span>
                                                        </div>
                                                        <div class="ms-3"><span class="fz14 text">Published {{ $proposal->created_at->format('d M, Y') }}</span></div>
                                                    </div>
                                                    <div>
                                                        <strong>Days:</strong> 
                                                        @foreach($proposal->day as $day)
                                                            <span class="badge bg-primary">
                                                                {{ $day }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="pt30">{{ $proposal->course->title }}</h3>
                                            <p class="text mt20 mb20">
                                                {{ $proposal->additional_information  }}
                                            </p>
                                            <p class="text mt20  mb20">
                                                
                                            </p>
                                            <a href="{{ route('tutor.request.accept') }}" onclick="event.preventDefault(); document.getElementById('accept-{{ $proposal->id }}').submit();" class="ud-btn bgc-thm4 text-thm">Respond</a>
                                            <a class="ud-btn bgc-thm4 text-thm" href="{{ route('tutor.request.cancel', $proposal->id) }}" onclick="event.preventDefault(); document.getElementById('reject-{{ $proposal->id }}').submit();" type="button">Reject</a>
                                        </div>
                                        <form clas="d-non" action="{{ route('tutor.request.accept', $proposal->id) }}" id="accept-{{ $proposal->id }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $proposal->id }}">
                                            {{-- <input type="text" name="tutor_name" value="{{ $proposals->tutor_id }}"> --}}
                                        </form>
                                        <form action="{{ route('tutor.request.cancel', $proposal->id) }}" id="reject-{{ $proposal->id }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $proposal->id }}">
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
