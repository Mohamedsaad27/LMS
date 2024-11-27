@extends('layouts.dashboard.layout')

@section('title', 'School Details')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => 'School Details'])

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">School Details</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit School
                </a>
                <a href="{{ route('schools.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Schools
                </a>
            </div>
        </div>

        <div class="row">
            <!-- School Overview Card -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body text-center pt-4">
                        <div class="mb-4">
                            <img src="{{ asset($school->logo) }}" alt="{{ $school->name_en }}"
                                class="rounded-circle school-logo mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                            <h4 class="mb-1">{{ $school->name_en }}</h4>
                            <h6 class="text-muted mb-3">{{ $school->name_ar }}</h6>
                            <span class="badge bg-primary-soft text-primary mb-3">{{ ucfirst($school->type) }} School</span>
                        </div>
                        
                        <div class="border-top pt-4">
                            <div class="row text-start">
                                <div class="col-12 mb-3">
                                    <label class="text-muted small mb-1">Email</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <span>{{ $school->email }}</span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted small mb-1">Phone</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone text-primary me-2"></i>
                                        <span>{{ $school->phone }}</span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted small mb-1">Address</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <span>{{ $school->address }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-muted small mb-1">Organization</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-building text-primary me-2"></i>
                                        <span>{{ $school->organization->name_en ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
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
                                <h3 class="mb-2">{{ $school->teachers->count() }}</h3>
                                <a href="#teachersTab" class="small text-primary" data-bs-toggle="pill">View All Teachers</a>
                            </div>
                        </div>
                    </div>

                    <!-- Students Card -->
                    <div class="col-sm-6 col-xl-6 mb-4">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="mb-0">Students</h6>
                                    <div class="avatar bg-success-soft rounded p-1">
                                        <i class="fas fa-user-graduate text-success"></i>
                                    </div>
                                </div>
                                <h3 class="mb-2">{{ $school->students->count() }}</h3>
                                <a href="#studentsTab" class="small text-success" data-bs-toggle="pill">View All Students</a>
                            </div>
                        </div>
                    </div>

                    <!-- Classrooms Card -->
                    <div class="col-sm-6 col-xl-6 mb-4">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="mb-0">Classrooms</h6>
                                    <div class="avatar bg-warning-soft rounded p-1">
                                        <i class="fas fa-door-open text-warning"></i>
                                    </div>
                                </div>
                                <h3 class="mb-2">{{ $school->classrooms->count() }}</h3>
                                <a href="#classroomsTab" class="small text-warning" data-bs-toggle="pill">View All Classrooms</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white py-3">
                        <ul class="nav nav-pills card-header-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="pill" href="#englishDesc">English Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#arabicDesc">Arabic Description</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="englishDesc">
                                <p class="mb-0">{{ $school->description_en ?? 'No English description available.' }}</p>
                            </div>
                            <div class="tab-pane fade" id="arabicDesc">
                                <p class="mb-0">{{ $school->description_ar ?? 'No Arabic description available.' }}</p>
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
                        <a class="nav-link" data-bs-toggle="pill" href="#studentsTab">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#classroomsTab">Classrooms</a>
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
                                        <th>Subject</th>
                                        <th>Qualification</th>
                                        <th>Experience</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($school->teachers as $teacher)
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
                                            <td>{{ $teacher->subject_specialization }}</td>
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

                    <!-- Students Tab -->
                    <div class="tab-pane fade" id="studentsTab">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Grade</th>
                                        <th>Enrollment Date</th>
                                        <th>Parent Contact</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($school->students as $student)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($student->photo) }}" alt=""
                                                        class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0">{{ $student->user->name }}</h6>
                                                        <small class="text-muted">{{ $student->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $student->grade->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->enrollment_date)->format('M d, Y') }}</td>
                                            <td>{{ $student->parent_contact }}</td>
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

                    <!-- Classrooms Tab -->
                    <div class="tab-pane fade" id="classroomsTab">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Grade</th>
                                        <th>Capacity</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($school->classrooms as $classroom)
                                        <tr>
                                            <td>{{ $classroom->name }}</td>
                                            <td>{{ $classroom->grade->name ?? 'N/A' }}</td>
                                            <td>{{ $classroom->capacity }} students</td>
                                            <td>{{ Str::limit($classroom->description, 50) }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-light-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">No classrooms found</td>
                                        </tr>
                                    @endforelse
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

