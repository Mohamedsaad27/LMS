<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <!-- User Card Section -->
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <!-- User card content remains the same -->
        </div>

        <!-- Logo Section -->
        <div>
            Logo
        </div>

        <!-- Navigation Menu -->
        <ul class="nav flex-column pt-3 pt-md-0 mt-4">
            <!-- Dashboard Item -->
            <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">{{ __('dashboard.dashboard') }}</span>
                </a>
            </li>

            <!-- Organizations Menu -->
            <li class="nav-item {{ request()->is('admin/organizations*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-organizations">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('dashboard.organizations') }}</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse" role="list" id="submenu-organizations" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ request()->is('admin/organizations/create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('organizations.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_organization') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/organizations') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('organizations.index') }}">
                                <span class="sidebar-text">{{ __('dashboard.organization_list') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Schools Menu -->
            <li class="nav-item {{ request()->is('admin/schools*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-schools">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('dashboard.schools') }}</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse" role="list" id="submenu-schools" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ request()->is('admin/schools/create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('schools.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_school') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/schools') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('schools.index') }}">
                                <span class="sidebar-text">{{ __('dashboard.school_list') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Students Menu -->
            <li class="nav-item {{ request()->is('admin/students*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-students">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('dashboard.students') }}</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse" role="list" id="submenu-students" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ request()->is('admin/students/create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('students.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_student') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/students') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('students.index') }}">
                                <span class="sidebar-text">{{ __('dashboard.student_list') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Grades Menu -->
            <li class="nav-item {{ request()->is('admin/grades*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-grades">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('dashboard.grades') }}</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse" role="list" id="submenu-grades" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ request()->is('admin/grades/create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('grades.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_grade') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/grades') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('grades.index') }}">
                                <span class="sidebar-text">{{ __('dashboard.grade_list') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
