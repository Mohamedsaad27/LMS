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

    @if (Session::has('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ session('error') }}',
            });
        </script>
    @endif

    @if (old('permissions') || old('name'))
        <script>
            iziToast.error({
                title: 'Error',
                message: 'Try again' + ' ' +
                    @if (old('permissions') || old('name'))
                        '{{ implode(' | ', $errors->all()) }}'
                    @endif
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
                            <div class="card-body @if (old('id') == $role->id && (old('permissions') || old('name'))) bg-red-100 @endif">
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
                                        <a data-bs-toggle="modal" data-bs-target="#editModal{{ $role->id }}"
                                            class="role-edit-modal"><span>{{ __('dashboard.edit_role') }}</span></a>

                                        {{-- Edit Modal --}}
                                        <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">
                                                            {{ trans('dashboard.title_edit', ['name' => $role->name]) }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('roles.update', $role->id) }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf

                                                            <input type="hidden" name="id"
                                                                value="{{ $role->id }}">

                                                            <div class="mb-3">
                                                                <label for="roleName"
                                                                    class="form-label @if (old('id') == $role->id) @error('name') is-invalid @enderror @endif ">{{ __('dashboard.role_name') }}</label>
                                                                <input type="text" class="form-control" id="roleName"
                                                                    name="name"
                                                                    value="{{ old('id') == $role->id ? old('name', $role->name) : $role->name }} "
                                                                    required>
                                                                @if (old('id') == $role->id)
                                                                    @error('name')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                @endif
                                                            </div>
                                                            <p
                                                                class="fs-5 fw-bold form-label mb-2 @if (old('id') == $role->id) @error('permissions') is-invalid @enderror @endif">
                                                                {{ __('dashboard.permissions') }}</p>
                                                            @if (old('id') == $role->id)
                                                                @error('permissions')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            @endif

                                                            <div class="d-flex flex-wrap mb-3">
                                                                @forelse ($role->permissions as $permission)
                                                                    <div
                                                                        class="d-flex align-items-center form-check form-check-sm form-check-custom form-check-solid me-3 my-2 mb-0 px-4 py-2 w-fit h-fit rounded bg-gray-100 transition">
                                                                        <span class="form-check-label fs-7 permission-label"
                                                                            id="permissionLabel{{ $role->id . $permission->id }}">
                                                                            {{ $permission->name }}
                                                                        </span>

                                                                        <input type="checkbox" data-bs-toggle="tooltip"
                                                                            data-popup="tooltip-custom"
                                                                            value="{{ $permission->name }}"
                                                                            data-bs-placement="top"
                                                                            aria-label="{{ $permission->name }}"
                                                                            data-bs-original-title="{{ __('dashboard.delete_permission') }}"
                                                                            class="form-check-input ms-1 mb-1"
                                                                            id="permissionCheck{{ $role->id . $permission->id }}"
                                                                            name="permissions[]"
                                                                            @checked(in_array($permission->name, old('permissions', [])))
                                                                            onchange="togglePermissionStyle(this, '{{ $role->id . $permission->id }}')"
                                                                            onload="togglePermissionStyle(this, '{{ $role->id . $permission->id }}');">
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

                                        {{-- Copy Role --}}
                                        <div class="text-main cursor-pointer" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" aria-label="{{ $role->name }}"
                                            data-bs-original-title="{{ __('dashboard.copy_role') . $role->name }}"
                                            onclick="copyToClipboard('role-{{ $role->id }}' , 'Role name copied to clipboard')">
                                            <i class="ki-duotone ki-copy fs-5"></i>
                                        </div>

                                        {{-- Delete Role --}}
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
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
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
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection
