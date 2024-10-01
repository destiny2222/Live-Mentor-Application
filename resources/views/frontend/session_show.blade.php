@extends('layouts.main')
@section('title', 'Session')
@section('content')
@php
  $userInvite = $groupSession->invite->where('user_id', Auth::id())->first();
  $attendent = $groupSession->invite->where('is_invited', 1)->count();

  $eventStart = new DateTime($groupSession->start_time);
  $eventEnd = new DateTime($groupSession->end_time);
  $eventTitle = urlencode($groupSession->title);
  $eventDescription = urlencode($groupSession->description);
  $eventLocation = urlencode($groupSession->zoom_meeting_link);

  // Google Calendar link
  $googleLink = "https://www.google.com/calendar/render?action=TEMPLATE&text={$eventTitle}&dates={$eventStart->format('Ymd\THis')}/{$eventEnd->format('Ymd\THis')}&details={$eventDescription}&location={$eventLocation}";

  // iCal data for iCloud and Outlook
  $icsData = "BEGIN:VCALENDAR
  VERSION:2.0
  BEGIN:VEVENT
  DTSTART:{$eventStart->format('Ymd\THis')}
  DTEND:{$eventEnd->format('Ymd\THis')}
  SUMMARY:{$groupSession->title}
  DESCRIPTION:{$groupSession->description}
  LOCATION:{$groupSession->zoom_meeting_link}
  END:VEVENT
  END:VCALENDAR";
  $icsData = urlencode($icsData);
@endphp


<!-- Breadcumb Sections -->

<section class="breadcumb-section wow fadeInUp mt40">
    <div class="cta-commmon-v1 cta-banner bgc-thm2 mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg">
        <img class="left-top-img wow zoomIn" src="/images/vector-img/left-top.png" alt="">
        <img class="right-bottom-img wow zoomIn" src="/images/vector-img/right-bottom.png" alt="">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="position-relative wow fadeInUp" data-wow-delay="300ms">
                        <h2 class="text-white">Session</h2>
                        <p style="color: white">{{ $groupSession->title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcumb Sections -->
<div class="modal__content__info_wrapper" id="modal__content__info_wrapper">
   <img src="{{ asset('giphy.gif') }}" class="">
</div>

<!-- Service Details -->
<section class="pt10">
    <div class="container">
        <div class="row wrap">
            <div class="col-lg-8">
                <div class="column">
                    <img src="{{ $groupSession->image }}" alt="" srcset="{{ $groupSession->image }}" class="img-fluid">
                    <div class="service-about mt20">
                        <h4>Description</h4>
                        <p class="text mb30">
                            {!! $groupSession->description !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="column">
                    <div class="blog-sidebar ms-lg-auto">
                        <div class="">
                            @if ($userInvite && $userInvite->is_invited === 1)
                                <div class="d-grid">
                                    <a href="{{ $userInvite->invitation_code }}" class="ud-btn btn-thm mb-3" style="background: #051D41 !important; border-color:#051D41 !important;">You're in - Join session</a>
                                </div>
                                <span style="font-size:13px;">Can't make it anymore? <a href="{{ route('cohort.leave', $userInvite->id) }}" onclick="event.preventDefault(); document.getElementById('leave-form-{{ $userInvite->id }}').submit();">Cancel my RSVP</a></span>
                                <form action="{{ route('cohort.leave', $userInvite->id) }}" method="post" class="d-none" id="leave-form-{{ $userInvite->id  }}">
                                @csrf
                                @method('DELETE')
                                </form>
                                <div class="btn-group mb-3" role="group" aria-label="Add to Calendar">
                                    <a href="{{ $googleLink }}" target="_blank" class="btn btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48">
                                            <rect width="22" height="22" x="13" y="13" fill="#fff"></rect><polygon fill="#1e88e5" points="25.68,20.92 26.688,22.36 28.272,21.208 28.272,29.56 30,29.56 30,18.616 28.56,18.616"></polygon><path fill="#1e88e5" d="M22.943,23.745c0.625-0.574,1.013-1.37,1.013-2.249c0-1.747-1.533-3.168-3.417-3.168 c-1.602,0-2.972,1.009-3.33,2.453l1.657,0.421c0.165-0.664,0.868-1.146,1.673-1.146c0.942,0,1.709,0.646,1.709,1.44 c0,0.794-0.767,1.44-1.709,1.44h-0.997v1.728h0.997c1.081,0,1.993,0.751,1.993,1.64c0,0.904-0.866,1.64-1.931,1.64 c-0.962,0-1.784-0.61-1.914-1.418L17,26.802c0.262,1.636,1.81,2.87,3.6,2.87c2.007,0,3.64-1.511,3.64-3.368 C24.24,25.281,23.736,24.363,22.943,23.745z"></path><polygon fill="#fbc02d" points="34,42 14,42 13,38 14,34 34,34 35,38"></polygon><polygon fill="#4caf50" points="38,35 42,34 42,14 38,13 34,14 34,34"></polygon><path fill="#1e88e5" d="M34,14l1-4l-1-4H9C7.343,6,6,7.343,6,9v25l4,1l4-1V14H34z"></path><polygon fill="#e53935" points="34,34 34,42 42,34"></polygon><path fill="#1565c0" d="M39,6h-5v8h8V9C42,7.343,40.657,6,39,6z"></path><path fill="#1565c0" d="M9,42h5v-8H6v5C6,40.657,7.343,42,9,42z"></path>
                                        </svg> Google Calendar
                                    </a>
                                </div>
                            @else
                                @if ($groupSession->is_paid)
                                    @if (optional(Auth::user())->hasPaidFor($groupSession->id))
                                    {{-- @if (Auth::user()->hasPaidFor($groupSession->id)) --}}
                                        <form action="{{ route('cohort.invite.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ Auth::user()->email ?? '' }}">
                                            <input type="hidden" name="group_session_id" value="{{ $groupSession->id }}">
                                            <input type="hidden" name="zoom_meeting_link" value="{{ $groupSession->zoom_meeting_link }}">
                                            <input type="hidden" name="invitation_count" value="{{ $groupSession->invitation_token }}">
                                            <div class="d-grid">
                                                <button id="submit" type="submit" class="ud-btn btn-thm">RSVP for this session</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{ route('payment.initiate') }}" method="post">
                                            @csrf
                                            
                                            <input type="hidden" name="group_session_id" value="{{ $groupSession->id }}">
                                            <input type="hidden" name="email" value="{{ Auth::user()->email ?? '' }}">
                                            <input type="hidden" name="zoom_meeting_link" value="{{ $groupSession->zoom_meeting_link }}">
                                            <input type="hidden" name="invitation_count" value="{{ $groupSession->invitation_token }}">
                                            <div class="d-grid">
                                                <button id="submit" type="submit" class="ud-btn btn-thm">Pay &#8358;{{ $groupSession->price }} to join</button>
                                            </div>
                                        </form>
                                    @endif
                                @else
                                    <form action="{{ route('cohort.invite.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ Auth::user()->email ?? '' }}">
                                        <input type="hidden" name="group_session_id" value="{{ $groupSession->id }}">
                                        <input type="hidden" name="zoom_meeting_link" value="{{ $groupSession->zoom_meeting_link }}">
                                        <input type="hidden" name="invitation_count" value="{{ $groupSession->invitation_token }}">
                                        <div class="d-grid">
                                            <button id="submit" type="submit" class="ud-btn btn-thm">RSVP for this session</button>
                                        </div>
                                    </form>
                                @endif
                            @endif
                        </div>
                        <div class="session__share  pt25 bdrs8">
                            <p class="sc-jXbUNg kFsvSZ font-weight-500 grey-2-text my-3">Spread the word</p>
                            <div class="share__url">
                                <span><a href="{{ route('group.session', $groupSession->invitation_token ) }}" id="groupSessionLink" class="text-truncate">{{ route('group.session', \Str::limit($groupSession->invitation_token, 10) ) }}</a></span>
                                <svg id="copyIcon" data-slot="icon" fill="none" width="24" height="24" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"></path>
                                </svg>
                            </div>
                            <span id="copyMessage" style="display: none; color: green; margin-left: 10px;">Link copied!</span>
                            <div class="d-flex align-items-center py-4 mx-3">
                                <div class="Styles__Avatars-sc-xomwjn-10 kgZRJd">
                                    @foreach ($groupSession->invite as $usersImage)
                                    <img alt="Avatar of participants" class="avatar cursor-pointer" src="{{ asset('profile/'.$usersImage->user->image) }}">
                                    @endforeach
                                </div>

                                <p class="sc-kAyceB cCBfKf grey-2-text my-12 ml-3"> {{ $attendent }} attending</p>
                            </div>
                        </div>
                        <div class="freelancer-style service-single mb-0 ">
                            <h4>Hosted by:</h4>
                            <div class="wrapper d-flex align-items-center mt20">
                                <div class="thumb position-relative mb25">
                                    <img class="rounded-circle mx-auto" width="60" height="60" src="{{ asset('profile/'.$groupSession->user->image) }}" alt="">
                                </div>
                                <div class="ml20">
                                    <h5 class="title mb-1">{{ $groupSession->user->name }}</h5>
                                    @if ($groupSession->user->role == 'tutor')
                                    <p class="mb-0">{{ $groupSession->user->tutor->title ?? '' }}</p>
                                    @elseif($groupSession->user->role == 'mentor')
                                    <p class="mb-0">{{ $groupSession->user->mentor->title ?? '' }}</p>
                                    @endif
                                </div>
                            </div>
                            <hr class="opacity-100">
                            <div class="details">
                                <h6 class="mt20 mb20">Topic of expertise</h6>
                                <div class="fl-meta d-flex align-items-center justify-content-between flex-wrap">
                                    <span class="meta badge bg-primary fw500 text-start" style="background: #1692C5 !important;">{{ $groupSession->topic_expertise ?? '' }}</span>
                                </div>
                                <h6 class="mt20">Interest areas</h6>
                                <div class="fl-meta d-flex align-items-center justifyinterest-content-between">
                                    @foreach ($groupSession->interest_areas as $interest)
                                    <span class="meta fw500 badge bg-primary text-start" style="background: #1692C5 !important;">{{ $groupSession->interest ?? '' }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@push('scripts')
<script>
    document.getElementById('copyIcon').addEventListener('click', function() {
        const link = document.getElementById('groupSessionLink').href;
        // Create a temporary textarea element to copy the link
        const tempInput = document.createElement('textarea');
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        // Display the "Link copied!" message
        const copyMessage = document.getElementById('copyMessage');
        copyMessage.style.display = 'inline';

        // Hide the message after 3 seconds
        setTimeout(function() {
            copyMessage.style.display = 'none';
        }, 3000);
    });

</script>
<script>
    document.getElementById('rsvpForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Simulate form submission (replace this with actual AJAX call)
        setTimeout(() => {
            document.getElementById('rsvpForm').style.display = 'none';
            document.getElementById('calendarOptions').style.display = 'block';

            // Update calendar links
            var eventStart = new Date('{{ $groupSession->start_time }}').toISOString().replace(/-|:|\.\d\d\d/g, "");
            var eventEnd = new Date('{{ $groupSession->end_time }}').toISOString().replace(/-|:|\.\d\d\d/g, "");
            var eventTitle = encodeURIComponent('{{ $groupSession->title }}');
            var eventDescription = encodeURIComponent('{{ $groupSession->description }}');
            var eventLocation = encodeURIComponent('{{ $groupSession->zoom_meeting_link }}');

            var googleLink = `https://www.google.com/calendar/render?action=TEMPLATE&text=${eventTitle}&dates=${eventStart}/${eventEnd}&details=${eventDescription}&location=${eventLocation}`;
            document.getElementById('googleCalendar').href = googleLink;

            var icsData = `BEGIN:VCALENDAR
          VERSION:2.0
          BEGIN:VEVENT
          DTSTART:${eventStart}
          DTEND:${eventEnd}
          SUMMARY:${eventTitle}
          DESCRIPTION:${eventDescription}
          LOCATION:${eventLocation}
          END:VEVENT
          END:VCALENDAR`;
            document.getElementById('icsCalendar').href = 'data:text/calendar;charset=utf8,' + encodeURIComponent(icsData);
        }, 1000); // Simulating a delay for the AJAX call
    });

</script>
<script>
$(document).ready(function() {
  $('#modal__content__info_wrapper').hide(); // Hide the container initially

  $('#submit').click(function(event) {
  
    // Submit form using AJAX
    $.ajax({
      url: "{{ route('cohort.invite.store') }}", // Replace with your form submission route
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        // If form submission is successful, show the GIF
        // add interval time to show the gif for 5 seconds
        setTimeout(function() {
          $('#modal__content__info_wrapper').show(); // Show the container after 5 seconds
        }, 5000); // 5000 milliseconds = 5 seconds
      },
      error: function(error) {
        // Handle form submission errors here
        console.error(error);
      }
    });
  });
});
</script>

@endpush
