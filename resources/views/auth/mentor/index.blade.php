@extends('layouts.master')
@section('content')
<div class="dashboard__main pl0-md">
    <div class="dashboard__content hover-bgc-color">
      <div class="row pb40">
        <div class="col-lg-9">
          <div class="dashboard_title_area">
            <h2>Sessions</h2>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="text-lg-end">
            <a href="{{ route('mentor.session') }}" class="ud-btn btn-dark">Add Session<i class="fal fa-arrow-right-long"></i></a>
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
                        <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Book Session</button>
                      </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                        @foreach($bookings as $booking)
                          <div class="col-md-12">
                            <div class="bdrb1 pb20">
                              <div class="mbp_first position-relative d-sm-flex align-items-center justify-content-start mb30-sm mt30">
                                <img src="{{ asset('profile/'.$booking->user->image) }}" width="100" class="mr-3" alt="comments-2.png">
                                <div class="ml20 ml0-xs mt20-xs">
                                  <div class="del-edit"><span class="flaticon-flag"></span></div>
                                  <h6 class="mt-0 mb-1">{{ $booking->user->name }}</h6>
                                  <div class="d-flex align-items-center">
                                    <div><i class="fas fa-clock vam fz10 review-color me-2"></i><span class="fz15 fw500">{{ \Carbon\Carbon::parse($booking->book_session_time)->format('H:i A') }}</span></div>
                                    <div class="ms-3"><span class="fz14 text"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($booking->book_session_date)->format('d M, Y') }}</span></div>
                                  </div>
                                </div>
                              </div>
                              <p class="text">{{  $booking->book_session }}</p>
                              <table class="booking-table mb10">
                                  <tr>
                                    <th>Minutes</th>
                                    <th>Time/Zone</th>
                                    <th>Price</th>
                                  </tr>
                                  <tr>
                                    <td>{{  $booking->minutes }}</td>
                                    <td>{{  $booking->book_session_time_zone }}</td>
                                    <td>{{ $booking->book_session_price }}</td>
                                  </tr>
                              </table>
                              @if($booking->book_session_payment_status == 0)
                                <a href="{{ route('accept.booking') }}" onclick="event.preventDefault(); document.getElementById('accept-{{ $booking->id }}').submit();" class="ud-btn bgc-thm4 text-thm">Accept</a>
                                <a href="#" class="ud-btn bgc-thm4 text-thm">Reject</a>
                                @endif  
                                <form clas="d-none" action="{{ route('accept.booking', $booking->id) }}" id="accept-{{ $booking->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $booking->id }}">
                                    {{-- <input type="text" name="tutor_name" value="{{ $proposals->tutor_id }}"> --}}
                                </form>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush