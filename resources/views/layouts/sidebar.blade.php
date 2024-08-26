<div class="dashboard__sidebar d-none d-lg-block">
    <div class="dashboard_sidebar_list">
        <div class="sidebar_list_item">
         <a href="{{ route('dashboard') }}" class="items-center {{ Request::routeIs('dashboard') ? '-is-active' : '' }} "><i class="flaticon-home mr15"></i>Dashboard</a>
        </div>
        @if (Auth::user()->role == 'user')
            <div class="sidebar_list_item">
             <a href="{{ route('enroll-course') }}" class="items-center {{ Request::routeIs('enroll-course') ? '-is-active' : '' }}"><i class="flaticon-document mr15"></i>
                My Course
              </a>
            </div>
            <div class="sidebar_list_item">
             <a href="{{ route('course.class') }}" class="items-center {{ Request::routeIs('course.class') ? '-is-active' : '' }}"><i class="flaticon-document mr15"></i>
                My Classes
              </a>
            </div>
            <div class="sidebar_list_item">
             <a href="{{ route('show.history') }}" class="items-center {{ Request::routeIs('show.history') ? '-is-active' : '' }}"><i class="flaticon-file mr15"></i>Payment History</a>
            </div>
        @else
            <div class="sidebar_list_item">
             <a href="{{ route('tutor.proposal') }}" class="items-center {{ Request::routeIs('tutor.proposal') ? '-is-active' : '' }}"><i class="flaticon-document mr15"></i>My Proposals</a>
            </div>
            <div class="sidebar_list_item">
             <a href="" class="items-center  {{ Request::routeIs('dashboard') ? '-is-active' : '' }}"><i class="flaticon-document mr15"></i>Classes</a>
            </div>
        @endif
        <p class="fz15 fw400 ff-heading pl30 mt30">Account</p>
        <div class="sidebar_list_item ">
        <a href="{{ route('profile.index') }}" class="items-center {{ Request::routeIs('profile.index') ? '-is-active' : '' }}"><i class="flaticon-photo mr15"></i>My Profile</a>
        </div>
        <div class="sidebar_list_item ">
        <a href="{{  route('logout') }}" id="form-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="items-center"><i class="flaticon-logout mr15"></i>Logout</a>
        <form id="logout-form" clas="d-none"  action="{{ route('logout') }}" method="post">
            @csrf
        </form>
        </div>
    </div>
</div>