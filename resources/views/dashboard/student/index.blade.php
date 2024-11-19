@extends('layouts.dashboard.layout')
@section('title', 'Students')
@section('content')
@include('layouts.dashboard.breadcrumb', ['component' => 'Organizations'])
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
        <h2 class="h3 text-gray-800 mb-0">Students</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Student
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
                            placeholder="Search students...">
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
                            <th class="px-4 py-3 text-muted">Student</th>
                            <th class="px-4 py-3 text-muted">Contact Info</th>
                            <th class="px-4 py-3 text-muted">Grade</th>
                            <th class="px-4 py-3 text-muted">School</th>
                            <th class="px-4 py-3 text-muted">Actions</th>
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
                                            <img src="{{ asset($student->profile_picture) }}"
                                                alt="{{ $student->name }}" class="rounded-circle"
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $student->name ?? 'N/A' }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex flex-column">
                                        <span class="text-dark">
                                            <i
                                                class="fas fa-envelope me-2 text-muted"></i><span class="text-muted">Email :</span> : {{ $student->email ?? 'N/A' }}
                                        </span>
                                        <span class="text-dark mt-1">
                                            <i
                                                class="fas fa-phone me-2 text-muted"></i><span class="text-muted">Phone :</span> {{ $student->phone ?? 'N/A' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <span>{{ $student->grade->name ?? 'N/A' }}</span>
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
                                            title="Show Student">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                            title="Edit Student">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->id }}"
                                            title="Delete Student">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>  
                                
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Student</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this Student?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('students.destroy', $student->id) }}"
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
