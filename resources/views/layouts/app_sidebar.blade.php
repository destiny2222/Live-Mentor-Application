<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="/">
                <img src="/fotor_logo.png" style="width: 100px !important;" class="header-brand-img desktop-logo" alt="logo">
                <img src="/fotor_logo.png" style="width: 100px !important;" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="/logo.png" style="width: 100px !important;" class="header-brand-img light-logo" alt="logo">
                <img src="/logo.png" style="width: 100px !important;" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('dashboard') }}"><i
                            class="side-menu__icon fe fe-home"></i><span
                            class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="sub-category">
                    <h3>Pages</h3>
                </li>
                @if (Auth::user()->role == 'user')
                <li >
                    <a class="side-menu__item has-link" href="{{ route('enroll-course') }}" {{ Request::routeIs('enroll-course') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-book"></i>
                        <span class="side-menu__label">My Course</span>
                    </a>
                </li>
                
                <li >
                    <a href="{{ route('course.class') }}" class="side-menu__item has-link" href="{{ Request::routeIs('course.class') ? 'active' : '' }}">
                        <i class="side-menu__icon fe fe-book-open"></i>
                        <span class="side-menu__label">My Class</span>
                    </a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('show.history') }}" {{ Request::routeIs('show.history') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-sliders"></i>
                        <span>Payment History</span>
                    </a>
                </li>
                @elseif(Auth::user()->role == 'mentor')
                <li>
                    <a class="side-menu__item has-link" href="{{ route('user.mentor.index') }}" {{ Request::routeIs('user.mentor.index') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-book"></i>
                        <span class="side-menu__label">My Session</span>
                    </a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('mentor.session.index') }}" {{ Request::routeIs('mentor.session.index') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-book"></i>
                        <span class="side-menu__label">Book Session</span>
                    </a>
                </li>
                
                <li>
                    <a class="side-menu__item has-link" href="{{ route('mentor.classes') }}" {{ Request::routeIs('mentor.classes') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-book-open"></i>
                        <span class="side-menu__label">My Class</span>
                    </a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('show.history') }}" {{ Request::routeIs('show.history') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-sliders"></i>
                        <span class="side-menu__label">Payment History</span>
                    </a>
                </li>
                @else
                <li>
                    <a class="side-menu__item has-link" href="{{ route('tutor.proposal') }}" {{ Request::routeIs('tutor.proposal') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-bookmark"></i>
                        <span class="side-menu__label">My Proposal</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('syllabus.index') }}" {{ Request::routeIs('syllabus.index') ? 'active' : '' }} class="side-menu__item has-link">
                        <i class="side-menu__icon fe fe-book"></i>
                        <span class="side-menu__label">Syllabus</span>
                    </a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('tutor.class') }}" {{ Request::routeIs('tutor.class') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-book-open"></i>
                        <span class="side-menu__label">My Class</span>
                    </a>
                </li>
                @endif
                @php
                    $user = Auth::user();
                @endphp
               @if ($user->role == 'mentor' || $user->role == 'tutor')
               <li class="sub-category">
                    <h3>Cohort</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-layers"></i><span
                            class="side-menu__label">Cohort</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <ul class="sidemenu-list">
                                <li><a href="{{ route('cohort.index') }}" class="slide-item"> My Cohort</a></li>
                                <li><a href="{{ route('cohort.create') }}" class="slide-item"> Create Cohort</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
               @endif

                <li class="sub-category">
                    <h3>General</h3>
                </li>
                
                <li>
                    <a class="side-menu__item has-link" href="{{ route('profile.index') }}" {{ Request::routeIs('profile.index') ? 'active' : '' }}>
                        <i class="side-menu__icon fe fe-settings "></i>
                        <span class="side-menu__label">My Profile</span>
                    </a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="side-menu__icon text-danger fe fe-log-out"></i>
                        <span class="side-menu__label">Logout</span>
                    </a>
                    <form id="logout-form" clas="d-none" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
</div>