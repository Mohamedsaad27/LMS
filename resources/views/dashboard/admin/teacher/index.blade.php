@extends('layouts.dashboard.layout')
@section('title', 'Teachers')
@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => 'Teachers'])
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
            <h2 class="h3 text-gray-800 mb-0">{{ __('dashboard.teachers') }}</h2>
            <a href="{{ route('teachers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>{{ __('dashboard.add_teacher') }}
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
                            <input type="text" id="searchInput" class="form-control border-0 bg-light"
                                placeholder="{{ __('dashboard.search_teacher') }}">
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
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.photo') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.name') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.email') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.phone') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.status') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.details') }}</th>
                                <th class="px-4 py-3 text-muted">{{ __('dashboard.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td class="px-4">
                                        <span class="text-primary fw-medium">{{ $teacher->id }}</span>
                                    </td>
                                    <td class="px-4">
                                        <div class="avatar-sm">
                                            <img src="{{ $teacher->photo ? asset($teacher->photo) : asset('assets/images/default-avatar.png') }}"
                                                alt="Teacher Photo" class="rounded-circle" width="40" height="40">
                                        </div>
                                    </td>
                                    <td class="px-4">
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium">{{ $teacher->user->name_en }}</span>
                                            <small class="text-muted">{{ $teacher->user->name_ar }}</small>
                                        </div>
                                    </td>
                                    <td class="px-4">{{ $teacher->user->email }}</td>
                                    <td class="px-4">{{ $teacher->user->phone }}</td>
                                    <td class="px-4">
                                        <span
                                            class="badge {{ $teacher->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $teacher->status }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailsModal{{ $teacher->id }}">
                                            <i class="fas fa-eye me-1"></i>{{ __('dashboard.view_details') }}
                                        </button>

                                        <!-- Details Modal -->
                                        <div class="modal fade" id="detailsModal{{ $teacher->id }}" tabindex="-1"
                                            aria-labelledby="detailsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailsModalLabel">
                                                            {{ __('dashboard.teacher_details') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <p><strong>{{ __('dashboard.address') }}:</strong>
                                                                    {{ $teacher->user->address }}</p>
                                                                <p><strong>{{ __('dashboard.gender') }}:</strong>
                                                                    {{ $teacher->user->gender }}</p>
                                                                <p><strong>{{ __('dashboard.date_of_birth') }}:</strong>
                                                                    {{ $teacher->date_of_birth }}</p>
                                                                <p><strong>{{ __('dashboard.hire_date') }}:</strong>
                                                                    {{ $teacher->hire_date }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><strong>{{ __('dashboard.qualification') }}:</strong>
                                                                    {{ $teacher->qualification ?? 'N/A' }}</p>
                                                                <p><strong>{{ __('dashboard.experience_years') }}:</strong>
                                                                    {{ $teacher->experience_years }}</p>
                                                                <p><strong>{{ __('dashboard.salary') }}:</strong>
                                                                    {{ number_format($teacher->salary, 2) }}</p>
                                                            </div>
                                                            <div class="col-12">
                                                                <h6 class="mb-2">{{ __('dashboard.school') }}:</h6>
                                                                <p>{{ $teacher->school->name ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-12">
                                                                <h6 class="mb-2">{{ __('dashboard.assigned_grades') }}:
                                                                </h6>
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    @forelse($teacher->grades as $grade)
                                                                        <span
                                                                            class="badge bg-info">{{ $grade->name }}</span>
                                                                    @empty
                                                                        <span
                                                                            class="text-muted">{{ __('dashboard.no_grades_assigned') }}</span>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <h6 class="mb-2">{{ __('dashboard.assigned_subjects') }}:
                                                                </h6>
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    @forelse($teacher->subjects as $subject)
                                                                        <span
                                                                            class="badge bg-info">{{ $subject->name }}</span>
                                                                    @empty
                                                                        <span
                                                                            class="text-muted">{{ __('dashboard.no_subjects_assigned') }}</span>
                                                                    @endforelse
                                                                </div>
                                                            </div>
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
                                            <a href="{{ route('teachers.show', $teacher->id) }}"
                                                class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                                aria-label="{{ __('dashboard.show_teacher') }}"
                                                data-bs-original-title="{{ __('dashboard.show_teacher') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                                                class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                                title="{{ __('dashboard.edit_teacher') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-light-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $teacher->id }}"
                                                title="{{ __('dashboard.delete_teacher') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $teacher->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">
                                                            {{ __('dashboard.delete_teacher') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('dashboard.delete_teacher_confirmation') }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('dashboard.cancel') }}</button>
                                                        <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('dashboard.delete') }}</button>
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

            @if ($teachers->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $teachers->links('pagination::bootstrap-5') }}
                </div>
            @endif
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
                overflow: hidden;
                border-radius: 50%;
            }

            .avatar-sm img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .table> :not(caption)>*>* {
                padding: 1rem 0.75rem;
            }

            .modal-content {
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const tableRows = document.querySelectorAll('tbody tr');

                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();

                    tableRows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });

                // Initialize tooltips
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script>
    @endpush
@endsection
