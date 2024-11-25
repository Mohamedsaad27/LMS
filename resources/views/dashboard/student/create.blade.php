@extends('layouts.dashboard.layout')
@section('title', trans('messages.create_student'))
@section('content')
    @include('layouts.dashboard.breadcrumb', ['component' => trans('messages.create_student')])
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.create_student') }}</h2>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                {{ trans('messages.back_to_list') }}
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