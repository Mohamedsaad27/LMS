@extends('layouts.dashboard.layout')

@section('title', 'Subject Details')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => 'Subject Details'])

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">Subject Details</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Subject
                </a>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Subjects
                </a>
            </div>
        </div>

        <div class="row">
            <!-- School Overview Card -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body text-center pt-4">
                        <div class="mb-4">
                            <h4 class="mb-1">{{ $subject->name }}</h4>
                            <span class="badge {{ $subject->is_premium ? 'bg-success text-dark' : 'bg-primary-soft text-primary' }} mb-3">Premium</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="col-xl-8 col-lg-7">
                <div class="row">
                    <!-- Teachers Card -->
                    <div class="col-sm-6 col-xl-6 mb-4">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="mb-0">Teachers</h6>
                                    <div class="avatar bg-primary-soft rounded p-1">
                                        <i class="fas fa-chalkboard-teacher text-primary"></i>
                                    </div>
                                </div>
                                <h3 class="mb-2">{{ $subject->teachers->count() }}</h3>
                                <a href="#teachersTab" class="small text-primary" data-bs-toggle="pill">View All Teachers</a>
                            </div>
                        </div>
                    </div>

                    <!-- Students Card -->
                    <div class="col-sm-6 col-xl-6 mb-4">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="mb-0">Units</h6>
                                    <div class="avatar bg-success-soft rounded p-1">
                                        <i class="fas fa-user-graduate text-success"></i>
                                    </div>
                                </div>
                                <h3 class="mb-2">{{ $subject->units->count() }}</h3>
                                <a href="#studentsTab" class="small text-success" data-bs-toggle="pill">View All Units</a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Description Card -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white py-3">
                        <ul class="nav nav-pills card-header-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#arabicDesc">Description</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="englishDesc">
                                <p class="mb-0">{{ $subject->description ?? 'No description available.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <ul class="nav nav-pills card-header-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="pill" href="#teachersTab">Teachers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#studentsTab">Units</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#classroomsTab">book</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Teachers Tab -->
                    <div class="tab-pane fade show active" id="teachersTab">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Teacher</th>
                                        <th>Salary</th>
                                        <th>Qualification</th>
                                        <th>Experience</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subject->teachers as $teacher)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($teacher->photo) }}" alt=""
                                                        class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0">{{ $teacher->user->name }}</h6>
                                                        <small class="text-muted">{{ $teacher->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $teacher->salary }}</td>
                                            <td>{{ $teacher->qualification }}</td>
                                            <td>{{ $teacher->experience_years }} years</td>
                                            <td>
                                                <span class="badge bg-{{ $teacher->status === 'active' ? 'success' : 'danger' }}-soft">
                                                    {{ ucfirst($teacher->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-light-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">No teachers found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Units Tab -->
                    <div class="tab-pane fade" id="studentsTab">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Grade</th>
                                        <th>Subject</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subject->units as $unit)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="mb-0">{{ $unit->name_en }}</h6>
                                                        <small class="text-muted">{{ $unit->description_en }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $unit->grade->name ?? 'N/A' }}</td>
                                            <td>{{ $unit->subject->name }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-light-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">No students found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- Book Tab --}}
                    <div class="tab-pane fade" id="studentsTab">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Book</th>
                                        <th>Description</th>
                                        <th>Author</th>
                                        <th>publication Year</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($subject->book->cover_image ?? 'default_image.png') }}" alt=""
                                                        class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0">{{ $subject->title}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $subject->book->description ?? 'N/A' }}</td>
                                            <td>{{ $subject->book->author ?? 'N/A' }}</td>
                                            <td>{{ $subject->book->publication_year ?? 'N/A'}}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-light-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    @push('styles')
        <style>
            .bg-primary-soft {
                background-color: rgba(85, 110, 230, 0.1) !important;
            }
            
            .bg-success-soft {
                background-color: rgba(34, 197, 94, 0.1) !important;
            }
            
            .bg-warning-soft {
                background-color: rgba(255, 171, 0, 0.1) !important;
            }
            
            .text-primary {
                color: #556ee6 !important;
            }
            
            .text-success {
                color: #22c55e !important;
            }
            
            .text-warning {
                color: #ffab00 !important;
            }

            .badge.bg-success-soft {
                color: #22c55e !important;
            }

        </style>
    @endpush

