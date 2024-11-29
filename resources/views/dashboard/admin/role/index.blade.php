@extends('layouts.dashboard.layout')
@section('title', 'Roles')
@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => 'Roles'])
    @if (session('success'))
        <script>
            iziToast.success({
                title: 'Success',
                message: '{{ session('success') }}',
                position: 'topRight'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ session('error') }}',
                position: 'topRight'
            });
        </script>
    @endif
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ __('dashboard.roles') }}</h2>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>{{ __('dashboard.add_role') }}
            </a>
        </div>

        <!-- Main Card -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0 bg-light"
                                placeholder="{{ __('dashboard.search_role') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-muted">#</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.role') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.description') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="px-4">
                                        <span class="text-primary fw-medium">{{ $role->id }}</span>
                                    </td>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            <span>{{ $role->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4">
                                        {{-- button modal --}}
                                        <div class="d-flex align-items-center">
                                            <button type="button" class="btn btn-sm btn-light-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#permissionsModal{{ $role->id }}">
                                                {{ __('dashboard.view_permissions') }}
                                            </button>
                                        </div>

                                        {{-- modal for permissions --}}
                                        <div class="modal fade" id="permissionsModal{{ $role->id }}" tabindex="-1"
                                            aria-labelledby="permissionsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="permissionsModalLabel">
                                                            {{ __('dashboard.view_permissions') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body fmxw-400 ">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover align-middle mb-0">
                                                                <thead class="bg-light">
                                                                    <tr>
                                                                        <th class="px-4 py-3 text-muted">{{ __('dashboard.permission') }}</th>
                                                                        <th class="px-4 py-3 text-muted">{{ __('dashboard.read') }}</th>
                                                                        <th class="px-4 py-3 text-muted">{{ __('dashboard.write') }}</th>
                                                                        <th class="px-4 py-3 text-muted">{{ __('dashboard.create') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($role->permissions as $permission)
                                                                        <tr>
                                                                            <td class="px-4">
                                                                                <span>{{ $permission->name }}</span>
                                                                            </td>
                                                                            <td class="px-4">
                                                                                <span>{{ $permission->pivot->read ? 'Yes' : 'No' }}</span>
                                                                            </td>
                                                                            <td class="px-4">
                                                                                <span>{{ $permission->pivot->write ? 'Yes' : 'No' }}</span>
                                                                            </td>
                                                                            <td class="px-4">
                                                                                <span>{{ $permission->pivot->create ? 'Yes' : 'No' }}</span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('dashboard.close') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                                title="Edit Role">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-light-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}"
                                                title="Delete Role">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Role</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this Role?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
