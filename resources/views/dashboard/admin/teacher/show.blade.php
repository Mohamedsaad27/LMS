@extends('layouts.dashboard.layout')
@section('title', 'Teacher Details')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => 'Teacher Details'])

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">Teacher Details</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Teacher
                </a>
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Teachers
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Teacher Profile Card -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body text-center pt-4">
                        <div class="mb-4">
                            <img src="{{ $teacher->photo ? asset($teacher->photo) : asset('assets/images/default-avatar.png') }}"
                                alt="{{ $teacher->user->name_en }}" class="rounded-circle profile-image mb-3"
                                style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);">
                            <h4 class="mb-1">{{ $teacher->user->name_en }}</h4>
                            <p class="text-muted mb-3">{{ $teacher->user->name_ar }}</p>
                            <span
                                class="status-badge {{ $teacher->status === 'active' ? 'status-active' : 'status-inactive' }}">
                                {{ ucfirst($teacher->status) }}
                            </span>
                        </div>

                        <div class="border-top pt-4">
                            <div class="row text-start">
                                <div class="col-12 mb-3">
                                    <label class="text-muted small mb-1">Email</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <span>{{ $teacher->user->email }}</span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted small mb-1">Phone</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone text-primary me-2"></i>
                                        <span>{{ $teacher->user->phone }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-muted small mb-1">Address</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <span>{{ $teacher->user->address }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher Details -->
            <div class="col-xl-8 col-lg-7">
                <div class="row">
                    <!-- Statistics Cards -->
                    <div class="col-12 mb-4">
                        <div class="row">
                            <!-- Experience Card -->
                            <div class="col-sm-6 col-xl-4 mb-4">
                                <div class="card border-0 shadow-sm rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h6 class="mb-0">Experience</h6>
                                            <div class="avatar bg-primary-soft rounded p-2">
                                                <i class="fas fa-briefcase text-primary"></i>
                                            </div>
                                        </div>
                                        <h3 class="mb-2">{{ $teacher->experience_years }} Years</h3>
                                        <p class="text-muted mb-0">Professional Teaching</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Subjects Card -->
                            <div class="col-sm-6 col-xl-4 mb-4">
                                <div class="card border-0 shadow-sm rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h6 class="mb-0">Subjects</h6>
                                            <div class="avatar bg-success-soft rounded p-2">
                                                <i class="fas fa-book text-success"></i>
                                            </div>
                                        </div>
                                        <h3 class="mb-2">{{ $teacher->subjects->count() }}</h3>
                                        <p class="text-muted mb-0">Teaching Subjects</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Grades Card -->
                            <div class="col-sm-6 col-xl-4 mb-4">
                                <div class="card border-0 shadow-sm rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h6 class="mb-0">Grades</h6>
                                            <div class="avatar bg-warning-soft rounded p-2">
                                                <i class="fas fa-graduation-cap text-warning"></i>
                                            </div>
                                        </div>
                                        <h3 class="mb-2">{{ $teacher->grades->count() }}</h3>
                                        <p class="text-muted mb-0">Assigned Grades</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="col-12 mb-4">
                        <div class="info-card p-4">
                            <h5 class="d-flex align-items-center mb-4">
                                <i class="fas fa-user-circle text-primary me-2"></i>
                                Personal Information
                            </h5>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-venus-mars text-primary me-3"></i>
                                        <div>
                                            <label class="text-muted small mb-1">Gender</label>
                                            <p class="mb-0">{{ ucfirst($teacher->user->gender) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar text-primary me-3"></i>
                                        <div>
                                            <label class="text-muted small mb-1">Date of Birth</label>
                                            <p class="mb-0">{{ $teacher->date_of_birth }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check text-primary me-3"></i>
                                        <div>
                                            <label class="text-muted small mb-1">Hire Date</label>
                                            <p class="mb-0">{{ $teacher->hire_date }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-money-bill-wave text-primary me-3"></i>
                                        <div>
                                            <label class="text-muted small mb-1">Salary</label>
                                            <p class="mb-0">{{ number_format($teacher->salary, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="col-12 mb-4">
                        <div class="info-card p-4">
                            <h5 class="d-flex align-items-center mb-4">
                                <i class="fas fa-graduation-cap text-primary me-2"></i>
                                Academic Information
                            </h5>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-school text-primary me-3"></i>
                                        <div>
                                            <label class="text-muted small mb-1">School</label>
                                            <p class="mb-0">{{ $teacher->school->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book-reader text-primary me-3"></i>
                                        <div>
                                            <label class="text-muted small mb-1">Specialization</label>
                                            <p class="mb-0">{{ $teacher->specialization ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-award text-primary me-3"></i>
                                        <div>
                                            <label class="text-muted small mb-1">Qualification</label>
                                            <p class="mb-0">{{ $teacher->qualification ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assignments -->
                    <div class="col-12">
                        <div class="info-card p-4">
                            <h5 class="d-flex align-items-center mb-4">
                                <i class="fas fa-tasks text-primary me-2"></i>
                                Assignments
                            </h5>

                            <div class="row g-4">
                                <!-- Assigned Grades -->
                                <div class="col-md-6">
                                    <h6 class="d-flex align-items-center mb-3">
                                        <i class="fas fa-layer-group text-primary me-2"></i>
                                        Assigned Grades
                                    </h6>
                                    @if ($teacher->grades->count() > 0)
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($teacher->grades as $grade)
                                                <span
                                                    class="badge bg-primary-soft text-primary">{{ $grade->name }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">No grades assigned</p>
                                    @endif
                                </div>

                                <!-- Assigned Subjects -->
                                <div class="col-md-6">
                                    <h6 class="d-flex align-items-center mb-3">
                                        <i class="fas fa-book text-primary me-2"></i>
                                        Assigned Subjects
                                    </h6>
                                    @if ($teacher->subjects->count() > 0)
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($teacher->subjects as $subject)
                                                <span
                                                    class="badge bg-success-soft text-success">{{ $subject->name }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">No subjects assigned</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .avatar {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

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

            .info-card {
                background: #fff;
                border-radius: 15px;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
                transition: transform 0.2s;
            }

            .info-card:hover {
                transform: translateY(-2px);
            }

            .status-badge {
                padding: 0.5rem 1.5rem;
                border-radius: 50px;
                font-weight: 500;
            }

            .status-active {
                background-color: rgba(40, 199, 111, 0.1);
                color: #28c76f;
            }

            .status-inactive {
                background-color: rgba(234, 84, 85, 0.1);
                color: #ea5455;
            }
        </style>
    @endpush
@endsection
