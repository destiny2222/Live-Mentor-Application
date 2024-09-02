<button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i> Dashboard Navigation</button>
<ul id="myDropdown" class="dropdown-content">
    <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="flaticon-home mr10"></i>Dashboard</a></li>
    @if (Auth::user()->role == 'user')
    <li><a href="{{ route('enroll-course') }}" {{ Request::routeIs('enroll-course') ? 'active' : '' }}><i class="flaticon-chat mr10"></i>My Course</a></li>
    <li><a href="{{ route('course.class') }}" {{ Request::routeIs('course.class') ? 'active' : '' }}><i class="flaticon-review-1 mr10"></i>Classes</a></li>
    <li><a href="{{ route('show.history') }}" {{ Request::routeIs('show.history') ? 'active' : '' }}><i class="flaticon-receipt mr10"></i>Payment History</a></li>
    @elseif(Auth::user()->role == 'mentor')
    <li><a href="{{ route('user.mentor.index') }}" {{ Request::routeIs('user.mentor.index') ? 'active' : '' }}><i class="flaticon-chat mr10"></i>My Session</a></li>
    <li><a href="{{ route('mentor.classes') }}" {{ Request::routeIs('mentor.classes') ? 'active' : '' }}><i class="flaticon-review-1 mr10"></i>Classes</a></li>
    <li><a href="{{ route('show.history') }}" {{ Request::routeIs('show.history') ? 'active' : '' }}><i class="flaticon-receipt mr10"></i>Payment History</a></li>
    @else
    <li class="{{ Request::routeIs('tutor.proposal') ? 'active' : '' }}"><a href="{{ route('tutor.proposal') }}"><i class="flaticon-document mr10"></i>My Proposals</a></li>
    <li><a href="page-dashboard-save.html"><i class="flaticon-like mr10"></i>Classes</a></li>
    @endif
    <li class="{{ Request::routeIs('profile.index') ? 'active' : '' }}"><a href="{{ route('profile.index') }}"><i class="flaticon-photo mr10"></i>My Profile</a></li>
    <li><a href="{{  route('logout') }}" id="form-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="flaticon-logout mr10"></i>Logout</a></li>
    <form id="logout-form" clas="d-none" action="{{ route('logout') }}" method="post">
        @csrf
    </form>
</ul>
