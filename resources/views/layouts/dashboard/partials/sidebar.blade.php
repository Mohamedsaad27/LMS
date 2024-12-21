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
                        <i class="ki-duotone ki-element-11 fs-5 me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-organizations" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/organizations/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('organizations.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_organization') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/organizations') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('organizations.index') }}">
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-schools" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/schools/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('schools.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_school') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/schools') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('schools.index') }}">
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-students" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/students/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('students.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_student') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/students') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('students.index') }}">
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-grades" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/grades/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('grades.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_grade') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/grades') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('grades.index') }}">
                                <span class="sidebar-text">{{ __('dashboard.grade_list') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Users Menu -->
            <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-users">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('dashboard.users') }}</span>
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-users" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/users/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('users.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.users') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/users') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('roles.index') }}"
                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                data-bs-placement="right"
                                data-bs-original-title="Check out over 200 in-house components">
                                <span class="sidebar-text">{{ __('dashboard.roles_permissions') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Teachers Menu -->
            <li class="nav-item {{ request()->is('admin/teachers*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-teachers">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('dashboard.teachers') }}</span>
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-teachers" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/teachers/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('teachers.create') }}">
                                <span class="sidebar-text">{{ __('dashboard.add_teacher') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/teachers') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('teachers.index') }}">
                                <span class="sidebar-text">{{ __('dashboard.teacher_list') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--  Subject Menu -->
            <li class="nav-item {{ request()->is('admin/subjects*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-subjects">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('messages.subjects') }}</span>
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-subjects" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/subjects/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('subjects.create') }}">
                                <span class="sidebar-text">{{ __('messages.add_subject') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/subjects') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('subjects.index') }}">
                                <span class="sidebar-text">{{ __('messages.view_subject') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        <!--  Unit Menu -->
        <li class="nav-item {{ request()->is('admin/units*') ? 'active' : '' }}">
            <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse" data-bs-target="#submenu-units">
                <span>
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">{{ __('messages.units') }}</span>
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
            <div class="multi-level collapse mt-2" role="list" id="submenu-units" aria-expanded="false">
                <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                    <li class="nav-item {{ request()->is('admin/units/create') ? 'active' : '' }}">
                        <a class="nav-link fs-7 py-1-px" href="{{ route('units.create') }}">
                            <span class="sidebar-text">{{ __('messages.add_unit') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/units') ? 'active' : '' }}">
                        <a class="nav-link fs-7 py-1-px" href="{{ route('units.index') }}">
                            <span class="sidebar-text">{{ __('messages.view_unit') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ request()->is('admin/lessons*') ? 'active' : '' }}">
            <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse" data-bs-target="#submenu-lessons">
                <span>
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">{{ __('messages.lessons') }}</span>
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
            <div class="multi-level collapse mt-2" role="list" id="submenu-lessons" aria-expanded="false">
                <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                    <li class="nav-item {{ request()->is('admin/lessons/create') ? 'active' : '' }}">
                        <a class="nav-link fs-7 py-1-px" href="{{ route('lessons.create') }}">
                            <span class="sidebar-text">{{ __('messages.add_lesson') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/lessons') ? 'active' : '' }}">
                        <a class="nav-link fs-7 py-1-px" href="{{ route('lessons.index') }}">
                            <span class="sidebar-text">{{ __('messages.view_lesson') }}</span>
                        </a>
                    </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ request()->is('admin/books*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-books">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('messages.books') }}</span>
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-books" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/books/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('books.create') }}">
                                <span class="sidebar-text">{{ __('messages.add_book') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/books') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('books.index') }}">
                                <span class="sidebar-text">{{ __('messages.view_book') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- ClassRoom Menu  -->
            <li class="nav-item {{ request()->is('admin/classrooms*') ? 'active' : '' }}">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-classrooms">
                    <span>
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('messages.classrooms') }}</span>
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
                <div class="multi-level collapse mt-2" role="list" id="submenu-classrooms" aria-expanded="false">
                    <ul class="flex-column nav ms-4_5 border-s-3 ps-2">
                        <li class="nav-item {{ request()->is('admin/classrooms/create') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('classrooms.create') }}">
                                <span class="sidebar-text">{{ __('messages.add_classroom') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('admin/classrooms') ? 'active' : '' }}">
                            <a class="nav-link fs-7 py-1-px" href="{{ route('classrooms.index') }}">
                                <span class="sidebar-text">{{ __('messages.view_classroom') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
      
    </div>
    
</nav>
