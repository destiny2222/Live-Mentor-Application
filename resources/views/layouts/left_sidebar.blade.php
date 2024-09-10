<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" data-key="t-menu">Menu</li>

        <li>
            <a href="index.html">
                <i data-feather="home"></i>
                <span data-key="t-dashboard">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i data-feather="grid"></i>
                <span data-key="t-apps">User</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.course.index')   }}">
                        <span data-key="t-calendar">General user</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.course.create') }}">
                        <span data-key="t-chat">Tutor user</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.course.create') }}">
                        <span data-key="t-chat">Mentor user</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i data-feather="grid"></i>
                <span data-key="t-apps">Category</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.category.index')   }}">
                        <span data-key="t-calendar">Category</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.category.create') }}">
                        <span data-key="t-chat">Create category</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i data-feather="grid"></i>
                <span data-key="t-apps">Course</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.course.index')   }}">
                        <span data-key="t-calendar">Courses</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.course.create') }}">
                        <span data-key="t-chat">Create Course</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>