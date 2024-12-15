@extends('layouts.dashboard.layout')
@section('title', 'Lessons')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', [
        'component' => trans('messages.create_lesson'),
    ])
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.create_lesson') }}</h2>
            <a href="{{ route('lessons.index') }}" class="btn btn-secondary">
                {{ trans('messages.back_to_list') }}
            </a>
        </div>
        <!-- Form Section -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name_ar">{{ trans('messages.name_ar') }}</label>
                                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="name_ar"
                                            value="{{ old('name_ar') }}" placeholder="{{ trans('messages.enter_name_ar') }}">
                                        @error('name_ar')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name_en">{{ trans('messages.name_en') }}</label>
                                        <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en"
                                            value="{{ old('name_en') }}" placeholder="{{ trans('messages.enter_name_en') }}">
                                        @error('name_en')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="mt-2" for="description_ar">{{ trans('messages.description_ar') }}</label>
                                        <textarea class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" name="description_ar" rows="2"
                                            placeholder="{{ trans('messages.enter_description_ar') }}">{{ old('description_ar') }}</textarea>
                                        @error('description_ar')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="mt-2" for="description_en">{{ trans('messages.description_en') }}</label>
                                        <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en" rows="2"
                                            placeholder="{{ trans('messages.enter_description_en') }}">{{ old('description_en') }}</textarea>
                                        @error('description_en')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="unit_id">{{ trans('messages.unit') }}</label>
                                        <select class="form-control @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id">
                                            <option value="">{{ trans('messages.select_unit') }}</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ app()->getLocale() == 'ar' ? $unit->name_ar : $unit->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image">{{ trans('messages.image') }}</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                        @error('image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary ml-3">{{ trans('messages.create_lesson') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

