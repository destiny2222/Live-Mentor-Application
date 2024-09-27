@extends('layouts.main')
@section('title', 'Mentor')
<style>

    .top-30{
        top: 120px !important;
        left: 5% !important;
        display: table !important;
    }

</style>
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
            <h2 class="text-white">Mentors</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcumb Sections -->


 <!-- Blog Section Area -->
 <section class="our-blog pt-0">
    <div class="container">
      <div class="row wow fadeInUp" data-wow-delay="300ms">
        <div class="col-xl-12">
          <div class="navtab-style1 blog-page-style">
            <nav>
                
              <div class="nav nav-tabs mb30" id="nav-tab2" role="tablist">
                <button class="nav-link active fw600" id="nav-item1-tab" data-bs-toggle="tab"
                  data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1"
                  aria-selected="true">Mentors</button>
                <button class="nav-link fw600" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2"
                  type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Group Sessions</button>
              </div>
            </nav>
          </div>
          <div class="navtab-style1">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active fz15 text" id="nav-item1" role="tabpanel"
                aria-labelledby="nav-item1-tab">
                <div class="row">
                    @foreach($users as $user)
                    @if ($user->mentor && $user->mentor->is_approved == 1)
                        <div class="col-sm-6 col-xl-3">
                          <div class="blog-style1">
                            <div class="blog-img">
                                  <a class="position-relative" href="{{ route('mentor.show',$user->id) }}">
                                      <img class="w-100" src="{{ asset('profile/'.$user->image) }}" alt="">
                                      @if ($user->last_seen >= now()->subMinutes(5))
                                        <div class="available-asap position-absolute top-30">
                                            <i class="fa fa-bolt"></i>
                                            <span class="ml-1 font-weight-600">Available ASAP</span>
                                        </div>
                                      @else

                                      @endif
                                  </a>
                              </div>
                              <div class="blog-content">
                                  <h4 class="title mt-1"><a href="{{ route('mentor.show',$user->id) }}">{{ $user->name ?? 'N/A' }}</a></h4>
                                  <a href="{{ route('mentor.show',$user->id) }}"><p class="list-inline-item"><i class="flaticon-place fz16 dark-color pr10"></i><span class="dark-color fw500">{{ $user->country }}</span></p></a>
                                  <a href="{{ route('mentor.show',$user->id) }}"><p class="text mb-0">{{ \Str::limit($user->mentor->about ?? 'N/A', 100) }}</p></a>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <a  href="{{ route('mentor.show',$user->id) }}">
                                      <h6 style="padding-top:20px; font-weight:700"> Experience </h6>
                                      <p class="list-inline-item">
                                          <span class="dark-color fw500">{{ $user->menotr->experience ?? 0 }} Years  </span>
                                      </p>
                                    </a>
                                    <p class="mb-0 body-color"><span class="fz17 fw500 dark-color ms-1">({{ $user->reviewCount() }} reviews)</span></p>
                                  </div>
                              </div>
                          </div>
                        </div>
                      @endif  
                    @endforeach
                </div>
              </div>
              <div class="tab-pane fade fz15 text" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">
                <div class="row">
                  @foreach($groupSessions as $groupSession)
                    @if ($groupSession->is_approved == 1)
                    <div class="col-sm-6 col-xl-3">
                      <div class="blog-style1">
                        <div class="blog-img"><img class="w-100" src="{{ $groupSession->image }}" alt=""></div>
                        <div class="blog-content">
                          <a class="date" href="{{ route('group.session', $groupSession->invitation_token ) }}">
                            {{ \Carbon\Carbon::parse($groupSession->start_time)->format('d M, Y') }}
                          </a>                        
                          <h4 class="title mt-1"><a href="{{ route('group.session', $groupSession->invitation_token ) }}">{{ $groupSession->title }}</a></h4>
                          <p class="text mb-0">{!! \Str::limit($groupSession->description , 100) !!}</p>
                        </div>
                      </div>
                    </div>
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        
      </div>
    </div>
  </section>



@endsection
