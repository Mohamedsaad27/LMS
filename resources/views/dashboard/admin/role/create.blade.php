@extends('layouts.dashboard.layout')
@section('title', __('dashboard.roles'))

@push('alerts')
    @if (Session::has('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ session('error') }}',
            });
        </script>
    @endif
@endpush

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => __('dashboard.create_role')])

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ __('dashboard.create_role') }}</h2>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                {{ __('dashboard.back_to_list') }}
            </a>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- Role Name -->
                                    <div class="mb-4">
                                        <label for="name" class="form-label">{{ __('dashboard.name') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}"
                                            placeholder="{{ __('dashboard.enter_role_name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="fv-row">
                                <p class="fs-5 fw-bold form-label mb-2 @error('permissions') is-invalid @enderror">Role Permissions</p>
                                @error('permissions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="d-flex flex-wrap">
                                    @forelse (config('permissions.roles') as $role => $permissions)
                                    <div class="col-lg-3">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ trans('messages.' . $role) }}</h3>
                                            </div>

                                            <div class="card-body d-flex flex-wrap ">
                        
                                                @foreach ($permissions as $permission)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="{{ $permission }}" id="{{ $permission }}" name="permissions[]"
                                                        @checked(isset($data) && $data->hasPermission($role . '-' . $permission))
                                                        >
                                                        <label class="form-check-label" for="{{ $permission }}">
                                                            {{ trans('messages.' . $permission) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary">{{ __('dashboard.create_role') }}</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
