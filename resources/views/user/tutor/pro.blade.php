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
            
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 position-relative">
                    <div class="navtab-style1">
                        <nav>
                            <div class="nav nav-tabs mb30" id="nav-tab2" role="tablist">
                                <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Proposals</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                                <div class="row">
                                    <div class="col-md-12 col-xxl-12">
                                        <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                                            <div class="dashboard-img-service">
                                                @foreach ($proposal as $proposals)
                                                <div class="listing-style1 list-style d-block d-xl-flex align-items-center border-0 mb10">
                                                    <div class="list-thumb flex-shrink-0 bdrs4">
                                                        <img class="w-100" src="{{ asset('profile/'.$proposals->user->image) }}" alt="">
                                                    </div>
                                                    <div class="list-content flex-grow-1 pt10 pb10 pl15 pl0-lg">
                                                        <h6 class="list-title mb-2"><a href="{{ route('proposal.details',$proposals->id) }}">{{ $proposals->user->name }}</a></h6>
                                                        <p>
                                                            {{ $proposals->additional_information }}
                                                        </p>
                                                        <div class="list-meta d-flex justify-content-between align-items-center">
                                                            <div class="review-meta d-flex align-items-center">
                                                                <a class="btn btn-outline-warning btn-sm me-2" href="{{ route('proposal.details',$proposals->id) }}" type="button">View Proposal</a>
                                                            </div>
                                                            <div class="budget">
                                                                <p class="mb-0 body-color">Price <span class="fz17 fw500 dark-color ms-1">&#8358;{{ $proposals->price }}</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="opacity-100 mt-0">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mbp_pagination text-center">

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
