@extends('layouts.dashboard.layout')
@section('title', __('dashboard.roles'))

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
                                <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>

                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <tbody class="text-gray-600 fw-semibold">
                                            <tr>
                                                <td class="text-gray-800">
                                                    Administrator Access

                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Allows a full access to the system"
                                                        data-bs-original-title="Allows a full access to the system"
                                                        data-kt-initialized="1">
                                                        <i
                                                            class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>
                                                </td>
                                                <td>
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="kt_roles_select_all" data-gtm-form-interact-field-id="1">
                                                        <span class="form-check-label" for="kt_roles_select_all">
                                                            Select all
                                                        </span>
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">User Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="user_management_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="user_management_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="user_management_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Content Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="content_management_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="content_management_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="content_management_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Financial Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="financial_management_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="financial_management_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="financial_management_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Reporting</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="reporting_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="reporting_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="reporting_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Payroll</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="payroll_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="payroll_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="payroll_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Disputes Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="disputes_management_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="disputes_management_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="disputes_management_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">API Controls</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="api_controls_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="api_controls_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="api_controls_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Database Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="database_management_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="database_management_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="database_management_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Repository Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="repository_management_read">
                                                            <span class="form-check-label">
                                                                Read
                                                            </span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="repository_management_write">
                                                            <span class="form-check-label">
                                                                Write
                                                            </span>
                                                        </label>
                                                        <label class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" name="repository_management_create">
                                                            <span class="form-check-label">
                                                                Create
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
