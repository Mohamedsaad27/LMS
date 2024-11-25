@extends('layouts.dashboard.layout')
@section('title', trans('messages.students'))
@section('content')
@include('layouts.dashboard.breadcrumb', ['component' => trans('messages.students')])
@if (session('success'))
    <script>
        iziToast.success({
            title: trans('messages.success'),
            message: '{{ session('success') }}',
            position: 'topRight'
        });
    </script>
@endif
@if (session('error'))
    <script>
        iziToast.error({
            title: trans('messages.error'),
            message: '{{ session('error') }}',
            position: 'topRight'
        });
    </script>
@endif
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.students') }}</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>{{ trans('messages.add_student') }}
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
                            placeholder="{{ trans('messages.search_students') }}">
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
                            <th class="px-4 py-3 text-muted">{{ trans('messages.student') }}</th>
                            <th class="px-4 py-3 text-muted">{{ trans('messages.contact_info') }}</th>
                            <th class="px-4 py-3 text-muted">{{ trans('messages.grade') }}</th>
                            <th class="px-4 py-3 text-muted">{{ trans('messages.school') }}</th>
                            <th class="px-4 py-3 text-muted">{{ trans('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="px-4">
                                    <span class="text-primary fw-medium">{{ $student->id }}</span>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3">
                                            <img src="{{ asset($student->photo) }}"
                                                alt="{{ $student->name }}" class="rounded-circle"
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $student->user->name_en ?? 'N/A' }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex flex-column">
                                        <span class="text-dark">
                                            <i
                                                class="fas fa-envelope me-2 text-muted"></i><span class="text-muted">{{ trans('messages.email') }} :</span> : {{ $student->user->email ?? 'N/A' }}
                                        </span>
                                        <span class="text-dark mt-1">
                                            <i
                                                class="fas fa-phone me-2 text-muted"></i><span class="text-muted">{{ trans('messages.phone') }} :</span> {{ $student->user->phone ?? 'N/A' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <span>{{ app()->getLocale() == 'en' ? $student->grade->name_en ?? 'N/A' : $student->grade->name_ar ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <span>{{ $student->school->name_en ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('students.show', $student->id) }}"
                                            class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                            title="{{ trans('messages.show_student') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                            title="{{ trans('messages.edit_student') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->id }}"
                                            title="{{ trans('messages.delete_student') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>  
                                
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">{{ trans('messages.delete_student') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ trans('messages.are_you_sure') }} {{ trans('messages.delete_student') }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">{{ trans('messages.cancel') }}</button>
                                                    <form action="{{ route('students.destroy', $student->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">{{ trans('messages.delete') }}</button>
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
