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
<section class="breadcumb-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcumb-style1">
            <div class="breadcumb-list">
              <a href="/app">Home</a>
              <a href="#">Mentors</a>
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
                      @if ($user->mentor->is_approved == 1)
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
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-1.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">Start an online business and work
                            from home</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-2.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">Front becomes an official Instagram
                            Marketing Partner</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-3.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">Engendering a culture of professional
                            development</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-4.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">Increasing engagement with
                            Instagram</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-5.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">11 Tips to Help You Get New Clients
                            Through Cold Calling</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-6.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">How to “Woo” a Recruiter and Land
                            Your Dream Job</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-7.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">Hey Job Seeker, It’s Time To Get Up
                            And Get Hired</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-8.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1 line-clamp2"><a href="page-blog-single.html">4 Learning Management
                            System Design Tips For Better eLearning</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-9.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">A Better Alternative To Grading
                            Student Writing</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-10.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">Exactly How Technology Can Make
                            Reading Better</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-11.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1 line-clamp2"><a href="page-blog-single.html">Why Public Schools Should
                            Continue To Use Remote Learning</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                    <div class="blog-style1">
                      <div class="blog-img"><img class="w-100" src="images/blog/blog-12.jpg" alt=""></div>
                      <div class="blog-content">
                        <a class="date" href="#">December 2, 2022</a>
                        <h4 class="title mt-1"><a href="page-blog-single.html">The Benefits Of Using Technology In
                            Learning</a></h4>
                        <p class="text mb-0">A complete guide to starting a small business online</p>
                      </div>
                    </div>
                  </div>
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
