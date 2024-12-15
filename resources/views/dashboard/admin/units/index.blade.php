@extends('layouts.dashboard.layout')
@section('title', 'Units')
@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => trans('messages.units')])
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
            <h2 class="h3 text-gray-800 mb-0">{{ __('messages.units') }}</h2>
            <a href="{{ route('units.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>{{ __('messages.add_unit') }}
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
                                placeholder="{{ __('messages.search_unit') }}">
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
                                <th class="px-4 py-3 text-muted">{{ __('messages.name') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('messages.description') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('messages.grade') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('messages.subject') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($units as $unit)
                                <tr>
                                    <td class="px-4">
                                        <span class="text-primary fw-medium">{{ $unit->id }}</span>
                                    </td>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            @if (app()->getLocale() == 'ar')
                                                <span>{{ $unit->name_ar }}</span>
                                            @else
                                                <span>{{ $unit->name_en }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4">
                                        {{-- button modal --}}
                                        <div class="d-flex align-items-center">
                                            <button type="button" class="btn btn-sm btn-light-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#descriptionModal{{ $unit->id }}">
                                                {{ __('dashboard.view_description') }}
                                            </button>
                                        </div>

                                        {{-- modal for description --}}
                                        <div class="modal fade" id="descriptionModal{{ $unit->id }}" tabindex="-1"
                                            aria-labelledby="descriptionModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="descriptionModalLabel">
                                                            {{ __('dashboard.view_description') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (app()->getLocale() == 'ar')
                                                            <p>{{ $unit->description_ar ?? 'A/N' }}</p>
                                                        @else
                                                            <p> {{ $unit->description_en ?? 'A/N' }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('dashboard.close') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $unit->grade->name }}
                                    </td>
                                    <td>
                                        {{ $unit->subject->name_ar }}
                                    </td>
                                    <td class="px-4">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('units.show', $unit->id) }}"
                                                class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                                title="View Unit">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('units.edit', $unit->id) }}"
                                                class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                                title="Edit Unit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-light-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $unit->id }}"
                                                title="Delete Unit">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $unit->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Unit</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this Unit?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('units.destroy', $unit->id) }}"
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
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">{{ __('messages.no_units_found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            .btn-light-primary {
                color: #556ee6;
                background-color: rgba(85, 110, 230, 0.1);
                border-color: transparent;
            }

            .btn-light-primary:hover {
                color: #fff;
                background-color: #556ee6;
            }

            .btn-light-danger {
                color: #f46a6a;
                background-color: rgba(244, 106, 106, 0.1);
                border-color: transparent;
            }

            .btn-light-danger:hover {
                color: #fff;
                background-color: #f46a6a;
            }

            .avatar-sm {
                width: 40px;
                height: 40px;
            }

            .table> :not(caption)>*>* {
                padding: 1rem 0.75rem;
            }

            .modal-content {
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush
@endsection
