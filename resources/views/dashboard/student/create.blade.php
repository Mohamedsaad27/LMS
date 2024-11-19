@extends('layouts.dashboard.layout')
@section('title', 'Create Student')
@section('content')
    @include('layouts.dashboard.breadcrumb', ['component' => 'Create Student'])
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">Create School</h2>
            <a href="{{ route('schools.index') }}" class="btn btn-secondary">
                Back to List
            </a>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">

                        @include('dashboard.student.form', [
                            'student' => null,
                            'grades' => $grades,
                            'schools' => $schools,
                            'method' => 'POST',
                            'action' => route('students.store'),
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('syles')
<style>
    .form-control{
        border: 1px solid #e5e7eb;
        border-radius: 5px;
        padding: 15px; /* Increased padding for larger field */
        font-size: 18px; /* Increased font size for larger field */
        color: #333;
        font-weight: 400;
        transition: all 0.3s ease;
        box-shadow: none;
        
    }
</style>
@endpush