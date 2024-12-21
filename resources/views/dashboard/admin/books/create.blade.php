@extends('layouts.dashboard.layout')
@section('title', 'Books')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', [
        'component' => trans('messages.create_book'),
    ])
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.create_book') }}</h2>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                {{ trans('messages.back_to_list') }}
            </a>
        </div>
        <!-- Form Section -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">{{ trans('messages.title') }}</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror mb-2" id="title" name="title"
                                            value="{{ old('title') }}" placeholder="{{ trans('messages.enter_title') }}">
                                        @error('title')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="author">{{ trans('messages.author') }}</label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror mb-2" id="author" name="author"
                                            value="{{ old('author') }}" placeholder="{{ trans('messages.enter_author') }}">
                                        @error('author')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="publication_year"
                                                    class="form-label">{{ trans('messages.publication_year') }}</label>
                                                <input type="number"
                                                    class="form-control @error('publication_year') is-invalid @enderror mb-2"
                                                    id="publication_year" name="publication_year"
                                            value="{{ old('publication_year') }}" min="1900" max="{{ date('Y') }}"
                                            placeholder="{{ trans('messages.enter_publication_year') }}">
                                        @error('publication_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-6">
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
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="subject_id">{{ trans('messages.subjects') }}</label>
                                        <select class="form-control @error('subject_id') is-invalid @enderror mb-2" id="subject_id" name="subject_id">
                                            <option value="">{{ trans('messages.select_subject') }}</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ app()->getLocale() == 'ar' ? $subject->name : $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="cover_image">{{ trans('messages.cover_image') }}</label>
                                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
                                        @error('cover_image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary ml-3">{{ trans('messages.create_book') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

