@extends('layouts.dashboard.layout')
@section('title', 'Roles')

@push('alerts')
    @if (Session::has('success'))
        <script>
            iziToast.success({
                title: 'OK',
                message: '{{ session('success') }}',
            });
        </script>
    @endif

@endpush

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => __('dashboard.roles_permissions')])

    <div class="content-wrapper px-4">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="mb-1">{{ __('dashboard.roles_list') }}</h4>
            <p class="mb-4 fs-7">{{ __('dashboard.description_roles_list') }}</p>
            <!-- Role cards -->
            <div class="row g-2">
                @foreach ($roles as $role)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h6 class="fw-normal mb-0 text-body">
                                        {{ trans_choice('dashboard.total_num_user', $role->users()->count(), ['count' => $role->users()->count()]) }}
                                    </h6>
                                    @forelse ($role->users as $user)
                                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                class="avatar pull-up cursor-pointer d-flex align-items-center justify-content-center bg-gray-200 rounded-circle"
                                                aria-label="{{ $user->name }}"
                                                data-bs-original-title="{{ $user->name }}">
                                                @if ($user->image)
                                                    <img class="rounded-circle object-fit-contain" src="{{ $user->image }}"
                                                        alt="Avatar">
                                                @else
                                                    <span class="avatar-initial rounded-circle fs-8">
                                                        {{ implode(' ',array_map(function ($word) {return mb_substr($word, 0, 1);}, explode(' ', $user->name))) }}
                                                    </span>
                                                @endif
                                            </li>
                                        </ul>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="d-flex justify-content-between align-items-end">
                                    <div class="role-heading">
                                        <h5 class="mb-1" id="role-{{ $role->id }}">{{ $role->name }}</h5>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $role->id }}"
                                            class="role-edit-modal"><span>{{ __('dashboard.edit_role') }}</span></a>

                                        {{-- Edit Modal --}}
                                        <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">
                                                            {{ trans('dashboard.title_edit', ['name' => $role->name]) }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('roles.update', $role->id) }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="roleName"
                                                                    class="form-label">{{ __('dashboard.role_name') }}</label>
                                                                <input type="text" class="form-control" id="roleName"
                                                                    name="name" value="{{ $role->name }}" required>
                                                            </div>
                                                            <p class="fs-5 fw-bold form-label mb-2 ">
                                                                {{ __('dashboard.permissions_for') . $role->name }}</p>

                                                            <div class="d-flex flex-wrap">
                                                                @forelse ($role->permissions as $permission)
                                                                    <div
                                                                        class="d-flex align-items-center form-check form-check-sm form-check-custom form-check-solid me-3 my-2 mb-0 px-4 py-2 w-fit h-fit rounded bg-gray-100 hover-bg-gray-200 transition">
                                                                        <span class="form-check-label fs-7">
                                                                            {{ $permission->name }}
                                                                        </span>
                                                                        <form class="w-fit" action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="button" class="border-0 bg-transparent" data-bs-toggle="modal"
                                                                                data-bs-target="#deleteModal{{ $role->id }}">
                                                                                <i
                                                                                    class="ki-duotone ki-trash fs-5 text-red-500 transition hover-text-red-600">
                                                                                    <span class="path1"></span>
                                                                                    <span class="path2"></span>
                                                                                    <span class="path3"></span>
                                                                                    <span class="path4"></span>
                                                                                    <span class="path5"></span>
                                                                                </i>
                                                                            </button>
                                
                                                                            <!-- Delete Modal -->
                                                                            <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
                                                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="deleteModalLabel">
                                                                                                {{ trans('dashboard.title_delete', ['name' => 'Role']) }}
                                                                                            </h5>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            {{ trans('dashboard.message_delete', ['name' => 'Role']) }}
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">{{ __('dashboard.cancel') }}</button>
                                                                                            <button type="submit"
                                                                                                class="btn btn-danger">{{ __('dashboard.yes_delete') }}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                            <div class="modal-footer px-0 pb-0">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">{{ __('dashboard.cancel') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">{{ __('dashboard.save_changes') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="#" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" aria-label="{{ $role->name }}"
                                            data-bs-original-title="{{ __('dashboard.copy_role') . $role->name }}"
                                            onclick="copyToClipboard('role-{{ $role->id }}' , 'Role name copied to clipboard')"><i
                                                class="ki-duotone ki-copy fs-5"></i></a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="border-0 bg-transparent" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $role->id }}">
                                                <i
                                                    class="ki-duotone ki-trash fs-5 text-red-500 transition hover-text-red-600">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </button>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">
                                                                {{ trans('dashboard.title_delete', ['name' => 'Role']) }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ trans('dashboard.message_delete', ['name' => 'Role']) }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">{{ __('dashboard.cancel') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('dashboard.yes_delete') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card h-100">
                        <div class="row h-100">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4 ps-3">
                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/lady-with-laptop-light.png"
                                        class="img-fluid" alt="Image" width="120"
                                        data-app-light-img="illustrations/lady-with-laptop-light.png"
                                        data-app-dark-img="illustrations/lady-with-laptop-dark.png">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body text-sm-end text-center ps-sm-0 pe-3 pt-4">
                                    <a href="{{ route('roles.create') }}" class="btn btn-primary fs-8 py-2">
                                        <i class="fas fa-plus me-2 fs-9"></i>{{ __('dashboard.add_new_role') }}
                                    </a>
                                    <p class="mb-0 fs-7 text-center text-gray-500 mt-2">
                                        {{ __('dashboard.add_new_role') }}, <br> {{ __('dashboard.if_dont') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <h4 class="mt-6 mb-1">Total users with their roles</h4>
                    <p class="mb-0">Find all of your company’s administrator accounts and their associate roles.</p>
                </div>
                <div class="col-12">
                    <!-- Role Table -->
                    <div class="card">
                        <div class="card-datatable table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-6">
                                        <div class="dataTables_length mb-0 mb-md-6" id="DataTables_Table_0_length">
                                            <label><select name="DataTables_Table_0_length"
                                                    aria-controls="DataTables_Table_0" class="form-select mx-0">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-6">
                                        <div
                                            class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap flex-sm-row flex-column">
                                            <div class="me-4">
                                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                    <label><input type="search" class="form-control"
                                                            placeholder="Search User"
                                                            aria-controls="DataTables_Table_0"></label>
                                                </div>
                                            </div>
                                            <div class="user_role w-px-200 me-sm-4 mb-6 mb-sm-0"><select id="UserRole"
                                                    class="form-select text-capitalize">
                                                    <option value=""> Select Role </option>
                                                    <option value="Admin" class="text-capitalize">Admin</option>
                                                    <option value="Author" class="text-capitalize">Author</option>
                                                    <option value="Editor" class="text-capitalize">Editor</option>
                                                    <option value="Maintainer" class="text-capitalize">Maintainer</option>
                                                    <option value="Subscriber" class="text-capitalize">Subscriber</option>
                                                </select></div>
                                            <div class="user_plan w-px-200 mb-6 mb-sm-0"><select id="Userplan"
                                                    class="form-select text-capitalize">
                                                    <option value=""> Select Plan </option>
                                                    <option value="Basic" class="text-capitalize">Basic</option>
                                                    <option value="Company" class="text-capitalize">Company</option>
                                                    <option value="Enterprise" class="text-capitalize">Enterprise</option>
                                                    <option value="Team" class="text-capitalize">Team</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>
                                <table class="datatables-users table border-top dataTable no-footer dtr-column"
                                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"
                                    style="width: 1210px;">
                                    <thead>
                                        <tr>
                                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                                style="width: 0px; display: none;" aria-label=""></th>
                                            <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all"
                                                rowspan="1" colspan="1" style="width: 18px;" data-col="1"
                                                aria-label=""><input type="checkbox" class="form-check-input"></th>
                                            <th class="sorting sorting_desc" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 291px;" aria-label="User: activate to sort column ascending"
                                                aria-sort="descending">User</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 121px;"
                                                aria-label="Role: activate to sort column ascending">Role</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 85px;"
                                                aria-label="Plan: activate to sort column ascending">Plan</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 165px;"
                                                aria-label="Billing: activate to sort column ascending">Billing</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 80px;"
                                                aria-label="Status: activate to sort column ascending">Status</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 144px;" aria-label="Actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><img
                                                                src="../../assets/img/avatars/2.png" alt="Avatar"
                                                                class="rounded-circle"></div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Zsazsa
                                                                McCleverty</span></a><small>@zmcclevertye@soundcloud.com</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-user text-success me-2"></i>Maintainer</span></td>
                                            <td><span class="text-heading">Enterprise</span></td>
                                            <td>Auto Debit</td>
                                            <td><span class="badge bg-label-success" text-capitalized="">Active</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><img
                                                                src="../../assets/img/avatars/7.png" alt="Avatar"
                                                                class="rounded-circle"></div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Yoko
                                                                Pottie</span></a><small>@ypottiec@privacy.gov.au</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-crown text-primary me-2"></i>Subscriber</span></td>
                                            <td><span class="text-heading">Basic</span></td>
                                            <td>Auto Debit</td>
                                            <td><span class="badge bg-label-secondary" text-capitalized="">Inactive</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><img
                                                                src="../../assets/img/avatars/6.png" alt="Avatar"
                                                                class="rounded-circle"></div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Wesley
                                                                Burland</span></a><small>@wburlandj@uiuc.edu</small></div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-pie-chart-alt text-info me-2"></i>Editor</span></td>
                                            <td><span class="text-heading">Team</span></td>
                                            <td>Auto Debit</td>
                                            <td><span class="badge bg-label-secondary" text-capitalized="">Inactive</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><span
                                                                class="avatar-initial rounded-circle bg-label-secondary">VK</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Vladamir
                                                                Koschek</span></a><small>@vkoschek17@abc.net.au</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-edit text-warning me-2"></i>Author</span></td>
                                            <td><span class="text-heading">Team</span></td>
                                            <td>Manual - Paypal</td>
                                            <td><span class="badge bg-label-success" text-capitalized="">Active</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><span
                                                                class="avatar-initial rounded-circle bg-label-danger">TW</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Tyne
                                                                Widmore</span></a><small>@twidmore12@bravesites.com</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-crown text-primary me-2"></i>Subscriber</span></td>
                                            <td><span class="text-heading">Team</span></td>
                                            <td>Manual - Cash</td>
                                            <td><span class="badge bg-label-warning" text-capitalized="">Pending</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><span
                                                                class="avatar-initial rounded-circle bg-label-dark">TB</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Travus
                                                                Bruntjen</span></a><small>@tbruntjeni@sitemeter.com</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-desktop text-danger me-2"></i>Admin</span></td>
                                            <td><span class="text-heading">Enterprise</span></td>
                                            <td>Manual - Cash</td>
                                            <td><span class="badge bg-label-success" text-capitalized="">Active</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><img
                                                                src="../../assets/img/avatars/1.png" alt="Avatar"
                                                                class="rounded-circle"></div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span class="fw-medium">Stu
                                                                Delamaine</span></a><small>@sdelamainek@who.int</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-edit text-warning me-2"></i>Author</span></td>
                                            <td><span class="text-heading">Basic</span></td>
                                            <td>Auto Debit</td>
                                            <td><span class="badge bg-label-warning" text-capitalized="">Pending</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><span
                                                                class="avatar-initial rounded-circle bg-label-primary">SO</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Saunder
                                                                Offner</span></a><small>@soffner19@mac.com</small></div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-user text-success me-2"></i>Maintainer</span></td>
                                            <td><span class="text-heading">Enterprise</span></td>
                                            <td>Auto Debit</td>
                                            <td><span class="badge bg-label-warning" text-capitalized="">Pending</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><span
                                                                class="avatar-initial rounded-circle bg-label-danger">SM</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Stephen
                                                                MacGilfoyle</span></a><small>@smacgilfoyley@bigcartel.com</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-user text-success me-2"></i>Maintainer</span></td>
                                            <td><span class="text-heading">Company</span></td>
                                            <td>Manual - Paypal</td>
                                            <td><span class="badge bg-label-warning" text-capitalized="">Pending</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="  control" tabindex="0" style="display: none;"></td>
                                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                    class="dt-checkboxes form-check-input"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-4"><img
                                                                src="../../assets/img/avatars/9.png" alt="Avatar"
                                                                class="rounded-circle"></div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                            class="text-heading text-truncate"><span
                                                                class="fw-medium">Skip
                                                                Hebblethwaite</span></a><small>@shebblethwaite10@arizona.edu</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-desktop text-danger me-2"></i>Admin</span></td>
                                            <td><span class="text-heading">Company</span></td>
                                            <td>Manual - Cash</td>
                                            <td><span class="badge bg-label-secondary" text-capitalized="">Inactive</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center"><a href="javascript:;"
                                                        class="btn btn-icon delete-record"><i
                                                            class="bx bx-trash bx-md"></i></a><a
                                                        href="app-user-view-account.html" class="btn btn-icon"><i
                                                            class="bx bx-show bx-md"></i></a><a href="javascript:;"
                                                        class="btn btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                            href="javascript:;" class="dropdown-item">Edit</a><a
                                                            href="javascript:;" class="dropdown-item">Suspend</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                            aria-live="polite">Showing 1 to 10 of 50 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="DataTables_Table_0_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0"
                                                        aria-disabled="true" role="link" data-dt-idx="previous"
                                                        tabindex="-1" class="page-link"><i
                                                            class="bx bx-chevron-left bx-18px"></i></a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                        aria-controls="DataTables_Table_0" role="link"
                                                        aria-current="page" data-dt-idx="0" tabindex="0"
                                                        class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="1"
                                                        tabindex="0" class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="2"
                                                        tabindex="0" class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="3"
                                                        tabindex="0" class="page-link">4</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="4"
                                                        tabindex="0" class="page-link">5</a></li>
                                                <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a
                                                        href="#" aria-controls="DataTables_Table_0" role="link"
                                                        data-dt-idx="next" tabindex="0" class="page-link"><i
                                                            class="bx bx-chevron-right bx-18px"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div style="width: 1%;"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Role Table -->
                </div>
            </div>
        </div>
        <!-- / Content -->




        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
                <div
                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                    <div class="text-body">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2024, made with ❤️ by <a href="https://themeselection.com" target="_blank"
                            class="footer-link">ThemeSelection</a>
                    </div>
                    <div class="d-none d-lg-inline-block">

                        <a href="https://themeselection.com/license/" class="footer-link me-4"
                            target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                        <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                            target="_blank" class="footer-link me-4">Documentation</a>


                        <a href="https://themeselection.com/support/" target="_blank"
                            class="footer-link d-none d-sm-inline-block">Support</a>

                    </div>
                </div>
            </div>
        </footer>
        <!-- / Footer -->


        <div class="content-backdrop fade"></div>
    </div>
@endsection
