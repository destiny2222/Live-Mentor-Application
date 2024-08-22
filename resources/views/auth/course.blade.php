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
      @if ($user->role == 'user')
        <div class="row">
          <div class="col-xl-12">
            <div class="ps-widget bgc-white bdrs4 p30 mb30 position-relative">
              <div class="navtab-style1">
                <nav>
                  <div class="nav nav-tabs mb30" id="nav-tab2" role="tablist">
                    <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Courses</button>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                    <div class="row">
                      @forelse ($enrolledCourses as $course)
                        <div class="col-sm-6 col-xl-4">
                          <div class="listing-style1">
                            <div class="list-thumb">
                              <img class="w-100" src="{{ asset('upload/courses/'.$course->image) }}" alt="">
                              <a href="" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete Item" aria-label="Delete Item">
                                <span class="flaticon-delete"></span>
                              </a>
                            </div>
                            <div class="list-content">
                              <p class="list-text body-color fz14 mb-1">{{ $course->category->name }}</p>
                              <h5 class="list-title">
                                <a href="{{ route('course.details', $course->slug) }}">
                                  {{ $course->title }}
                                </a>
                              </h5>
                              <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat voluptatum deleniti, iste expedita ducimus architecto nobis.
                              </p>
                              <hr class="my-2">
                              <div class="list-meta d-flex justify-content-between align-items-center mt15">
                                @if ($course->status  == '1')
                                  <a class="d-flex " href="{{ route('pay') }}" onclick="event.preventDefault(); document.getElementById('pay-form-{{ $course->id }}').submit();">
                                    <span class="fz14 pending-style style1" style="text-transform: uppercase">make payment</span>
                                  </a>
                                  <form action="{{ route('pay') }}" method="POST" id="pay-form-{{ $course->id }}">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                    <input type="hidden" name="name" value="{{ $user->name }}">
                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="price" value="{{ $course->price }}">
                                  </form>
                                @elseif ($course->status == '2')
                                  <span class="pending-style style3">Reject</span>  
                                @else
                                  <span class="pending-style style2">Pending</span>
                                @endif
                                
                                <div class="budget">
                                  <p class="mb-0 body-color">Price <span class="fz17 fw500 dark-color ms-1">${{ $course->price }}</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @empty
                      <div class="col-sm-12 col-xl-12">
                        <div class="listing-style1">
                          Empty  Course 
                        </div>
                      </div>
                      @endforelse
                    </div>
                  </div>
                </div>
              </div>
              <div class="mbp_pagination text-center">
                {{ $proposals->links() }}
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="col-md-12">
          <div class="alert alert-info">No courses found</div>
        </div>
      @endif
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