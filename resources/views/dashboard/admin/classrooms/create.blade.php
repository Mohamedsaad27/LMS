@extends('layouts.dashboard.layout')
@section('title', 'Classrooms')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', [
        'component' => trans('messages.create_classroom'),
    ])
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.create_classroom') }}</h2>
            <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">
                {{ trans('messages.back_to_list') }}
            </a>
        </div>
        <!-- Form Section -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('classrooms.store') }}" method="POST" >
                            @csrf
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">{{ trans('messages.name') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror mb-2" id="name" name="name"
                                            value="{{ old('name') }}" placeholder="{{ trans('messages.enter_name') }}">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="school_id">{{ trans('messages.school') }}</label>
                                        <select class="form-control @error('school_id') is-invalid @enderror mb-2" id="school_id" name="school_id">
                                            <option value="">{{ trans('messages.select_school') }}</option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}">{{ app()->getLocale() == 'ar' ? $school->name_ar : $school->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('school_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="capacity"
                                            class="form-label">{{ trans('messages.capacity') }}</label>
                                        <input type="number"
                                            class="form-control @error('capacity') is-invalid @enderror mb-2"
                                            id="capacity" name="capacity"
                                            value="{{ old('capacity') }}" min="0" 
                                            placeholder="{{ trans('messages.enter_capacity') }}">
                                        @error('capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="description"
                                            class="form-label">{{ trans('messages.description') }}</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror mb-2"
                                            id="description" name="description" rows="2"
                                            placeholder="{{ trans('messages.description') }}">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                             
                                <div class="col-lg-6">
                                <div class="form-group">
                                        <label for="grade_id">{{ trans('messages.grade') }}</label>
                                        <select class="form-control @error('grade_id') is-invalid @enderror mb-2" id="grade_id" name="grade_id">
                                            <option value="">{{ trans('messages.select_grade') }}</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ app()->getLocale() == 'ar' ? $grade->name_ar : $grade->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('grade_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary ml-3">{{ trans('messages.create_classroom') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

