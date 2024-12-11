@extends('layouts.dashboard.layout')
@section('title', 'Subjects')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', [
        'component' => trans('messages.edit_subject'),
    ])
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.edit_subject') }}</h2>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                {{ trans('messages.back_to_list') }}
            </a>
        </div>
        <!-- Form Section -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('subjects.update', $subject->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">{{ trans('messages.name') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                            value="{{ old('name', $subject->name) }}" placeholder="{{ trans('messages.enter_name') }}">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="description">{{ trans('messages.description') }}</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2"
                                            placeholder="{{ trans('messages.enter_description') }}">{{ old('description', $subject->description) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="grade_id">{{ trans('messages.grade') }}</label>
                                        <select class="form-control @error('grade_id') is-invalid @enderror" id="grade_id" name="grade_id">
                                            <option value="">{{ trans('messages.select_grade') }}</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}" {{ $subject->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('grade_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="organization_id">{{ trans('messages.organization') }}</label>
                                        <select class="form-control @error('organization_id') is-invalid @enderror" id="organization_id" name="organization_id">
                                            <option value="">{{ trans('messages.select_organization') }}</option>
                                            @foreach ($organizations as $organization)
                                                <option value="{{ $organization->id }}" {{ $subject->organization_id == $organization->id ? 'selected' : '' }}>{{ $organization->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('organization_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div
                                            class="custom-control custom-switch custom-traffic-light d-flex align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="trafficLightSwitch" value="1"
                                                name="is_premium" {{ old('is_premium', $subject->is_premium) ? 'checked' : '' }}>
                                            <label class="custom-control-label mr-3" for="trafficLightSwitch"></label>
                                            <span class="ml-2">{{ trans('messages.is_premium') }}</span>
                                        </div>
                                        @error('is_premium')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary">{{ trans('messages.create_subject') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        /* Custom Traffic Light Switch Styles */
        .custom-traffic-light {
            display: flex;
            align-items: center;
        }

        .custom-traffic-light .custom-control-label {
            margin-right: 10px;
        }

        .custom-traffic-light .custom-control-input {
            position: absolute;
            z-index: 1;
            opacity: 0;
        }

        .custom-traffic-light .custom-control-label {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
            background-color: #dc3545;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-traffic-light .custom-control-label::before {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 26px;
            height: 26px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .custom-traffic-light .custom-control-input:checked+.custom-control-label {
            background-color: #28a745;
        }

        .custom-traffic-light .custom-control-input:checked+.custom-control-label::before {
            transform: translateX(30px);
        }
    </style>
@endpush
