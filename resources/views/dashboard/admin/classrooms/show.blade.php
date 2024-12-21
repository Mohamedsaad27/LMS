@extends('layouts.dashboard.layout')
@section('title', 'Classroom Details')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', [
        'component' => trans('messages.classroom_details'),
    ])
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.classroom_details') }}</h2>
            <div>
                <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-1"></i>{{ trans('messages.edit') }}
                </a>
                <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">
                    {{ trans('messages.back_to_list') }}
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Main Info Card -->
            <div class="col-12 col-xl-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ trans('messages.basic_information') }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="30%">{{ trans('messages.classroom_name') }}:</th>
                                    <td>{{ $classroom->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.capacity') }}:</th>
                                    <td>
                                        <span class="badge bg-info">{{ $classroom->capacity }} {{ trans('messages.students') }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.description') }}:</th>
                                    <td>{{ $classroom->description ?? trans('messages.not_available') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- School Info Card -->
            <div class="col-12 col-xl-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">{{ trans('messages.school_information') }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="30%">{{ trans('messages.school_name') }}:</th>
                                    <td>{{ $classroom->school->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.school_email') }}:</th>
                                    <td>{{ $classroom->school->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.school_phone') }}:</th>
                                    <td>{{ $classroom->school->phone }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.school_address') }}:</th>
                                    <td>{{ $classroom->school->address }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.school_type') }}:</th>
                                    <td>
                                        @if($classroom->school->type == 'primary')
                                            <span class="badge bg-primary">{{ $classroom->school->type }}</span>
                                        @elseif($classroom->school->type == 'secondary')
                                            <span class="badge bg-info">{{ $classroom->school->type }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $classroom->school->type }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Grade Info Card -->
            <div class="col-12 col-xl-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">{{ trans('messages.grade_information') }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="30%">{{ trans('messages.grade_name') }}:</th>
                                    <td>{{ $classroom->grade->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.grade_description') }}:</th>
                                    <td>{{ $classroom->grade->description ?? trans('messages.not_available') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
@endsection