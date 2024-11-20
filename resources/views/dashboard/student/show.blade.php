@extends('layouts.dashboard.layout')
@section('title', 'Show Student')
@section('content')
    @include('layouts.dashboard.breadcrumb', ['component' => 'Show Student'])

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Student Profile Card -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="position-relative mb-4">
                            @if($student->photo)
                                <img src="{{ asset($student->photo) }}" 
                                     class="rounded-circle img-thumbnail" 
                                     style="width: 150px; height: 150px; object-fit: cover;"
                                     alt="{{ $student->user->name_en }}">
                            @else
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 150px; height: 150px;">
                                    <span class="text-white display-4">
                                        {{ strtoupper(substr($student->user->name_en, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                            <span class="position-absolute bottom-0 end-0 p-2 bg-success rounded-circle">
                                <i class="fas fa-check-circle text-white"></i>
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $student->user->name_en }}</h4>
                        <p class="text-muted mb-3">{{ $student->user->name_ar }}</p>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-envelope me-1"></i> Message
                            </button>
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit Profile
                            </button>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row text-center">
                            <div class="col">
                                <h6 class="mb-0">Grade</h6>
                                <small class="text-muted">{{ $student->grade->name }}</small>
                            </div>
                            <div class="col border-start">
                                <h6 class="mb-0">Enrolled</h6>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($student->enrollment_date)->format('M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Contact Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                {{ $student->user->email }}
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-phone text-primary me-2"></i>
                                {{ $student->user->phone }}
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                {{ $student->user->address }}
                            </li>
                            <li>
                                <i class="fas fa-phone-square text-primary me-2"></i>
                                Parent-Contact: {{ $student->parent_contact }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Academic Information</h5>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Report</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Download PDF</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="text-muted mb-2">School</h6>
                                    <div class="d-flex align-items-center">
                                        @if($student->school->logo)
                                            <img src="{{ asset($student->school->logo) }}" 
                                                 alt="School Logo" 
                                                 class="me-2" 
                                                 style="width: 40px; height: 40px; object-fit: contain;">
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $student->school->name_en }}</h6>
                                            <small class="text-muted">{{ $student->school->name_ar }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="text-muted mb-2">Grade Information</h6>
                                    <h6 class="mb-0">{{ $student->grade->name }}</h6>
                                    <small class="text-muted">{{ $student->grade->description }}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="text-muted mb-2">Date of Birth</h6>
                                    <h6 class="mb-0">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') }}</h6>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($student->date_of_birth)->age }} years old</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="text-muted mb-2">Current Grade</h6>
                                    <h6 class="mb-0">{{ $student->grade->name }}</h6>
                                    <div class="progress mt-2" style="height: 6px;">
                                        @php
                                            $gradePercentage = (100/ 100) * 100;
                                        @endphp
                                        <div class="progress-bar bg-success" 
                                             role="progressbar" 
                                             style="width: {{ $gradePercentage }}%" 
                                             aria-valuenow="{{ $gradePercentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="mt-4">
                            <h6 class="mb-3">Recent Activity</h6>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Completed Mid-term Examination</h6>
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Submitted Mathematics Assignment</h6>
                                        <small class="text-muted">5 days ago</small>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-info"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Participated in Science Fair</h6>
                                        <small class="text-muted">1 week ago</small>
                                    </div>
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
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }
        
        .timeline-marker {
            position: absolute;
            left: -30px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-top: 5px;
        }
        
        .timeline-item:not(:last-child):before {
            content: '';
            position: absolute;
            left: -24px;
            width: 2px;
            height: 100%;
            background-color: #e9ecef;
        }
        
        .card {
            border: none;
            transition: transform 0.2s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
    @endpush
@endsection