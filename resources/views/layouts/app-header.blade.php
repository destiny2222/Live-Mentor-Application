<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="/">
                <img src="/fotor_logo.png" class="header-brand-img desktop-logo" style="width: 100px !important;" alt="logo">
                <img src="/logo.png" class="header-brand-img light-logo1"  style="width: 100px !important;" alt="logo">
            </a>
            <!-- LOGO -->
            <div class="main-header-center ms-3 d-none d-lg-block">
                <form action="{{ route('search') }}" method="get">
                    <input type="search" class="form-control" name="search"  id="typehead" placeholder="Search for results...">
                    <button type="submit" class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-lg-none d-flex">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <form action="{{ route('search') }}" method="get">
                                        @csrf
                                        <div class="input-group w-100 p-2">
                                            <input type="text" name="search" class="form-control" placeholder="Search....">
                                            <div class="input-group-text btn btn-primary">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>
                            <!-- Theme-Layout -->
                            
                            {{-- <div class="dropdown  d-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown"><i
                                        class="fe fe-bell"></i><span class=" pulse"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="notifications-menu">
                                        <a class="dropdown-item d-flex" href="notify-list.html">
                                            <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                <i class="fe fe-mail"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">New Application received
                                                </h5>
                                                <span class="notification-subtext">3 days ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="notify-list.html">
                                            <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                                                <i class="fe fe-check-circle"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Project has been
                                                    approved</h5>
                                                <span class="notification-subtext">2 hours ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="notify-list.html">
                                            <div class="me-3 notifyimg  bg-success brround box-shadow-success">
                                                <i class="fe fe-shopping-cart"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Your Product Delivered
                                                </h5>
                                                <span class="notification-subtext">30 min ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="notify-list.html">
                                            <div class="me-3 notifyimg bg-pink brround box-shadow-pink">
                                                <i class="fe fe-user-plus"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Friend Requests</h5>
                                                <span class="notification-subtext">1 day ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="notify-list.html"
                                        class="dropdown-item text-center p-3 text-muted">View all
                                        Notification</a>
                                </div>
                            </div> --}}
                            <!-- SIDE-MENU -->
                            <div class="dropdown d-flex profile-1">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    <img src="{{ asset('profile/'.Auth::user()->image) }}" alt="profile-user"
                                        class="avatar  profile-user brround cover-image">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ Auth::user()->name }}</h5>
                                            @if (Auth::user()->role == 'tutor')
                                             <small class="text-muted">{{ Auth::user()->tutor->title ?? '' }}</small>
                                            @elseif (Auth::user()->role == 'mentor')
                                              <small class="text-muted">{{ Auth::user()->mentor->title ?? '' }}</small>
                                            @else
                                                
                                            @endif
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{  route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                    </a>
                                    <form id="logout-form" clas="d-none"  action="{{ route('logout') }}" method="post">
                                        @csrf
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