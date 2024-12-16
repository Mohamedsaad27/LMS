@extends('layouts.dashboard.layout')

@section('title', __('messages.lesson_details'))

@section('content')
    {{-- Breadcrumb Section --}}
    @include('layouts.dashboard.partials.breadcrumb', ['component' => trans('messages.lesson_details')])

    {{-- Lesson Details Container --}}
    <div class="container-fluid px-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-book me-2"></i>
                    {{ app()->getLocale() == 'ar' ? $lesson->name_ar : $lesson->name_en }}
                </h5>
                <div class="card-header-actions">
                    @can('edit', $lesson)
                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-sm btn-light">
                            <i class="fas fa-edit me-1"></i> {{ __('messages.edit') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    {{-- Basic Information Section --}}
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ __('messages.basic_information') }}
                        </h6>
                        <table class="table table-borderless">
                            <tr>
                                <th class="w-25">{{ __('messages.name') }}</th>
                                <td>
                                    {{ app()->getLocale() == 'ar' ? $lesson->name_ar : $lesson->name_en }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('messages.unit') }}</th>
                                <td>
                                    {{ app()->getLocale() == 'ar' ? $lesson->unit->name_ar : $lesson->unit->name_en }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('messages.subject') }}</th>
                                <td>{{ $lesson->unit->subject->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('messages.grade') }}</th>
                                <td>
                                    {{ app()->getLocale() == 'ar' ? $lesson->unit->grade->name_ar : $lesson->unit->grade->name_en }}
                                </td>
                            </tr>
                        </table>
                    </div>

                    {{-- Description Section --}}
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-paragraph me-2"></i>
                            {{ __('messages.description') }}
                        </h6>
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <p class="text-muted">
                                    {{ app()->getLocale() == 'ar' ? ($lesson->description_ar ?? __('messages.no_description')) : ($lesson->description_en ?? __('messages.no_description')) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Lesson Image --}}
                @if($lesson->image)
                <hr class="my-4">
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-image me-2"></i>
                            {{ __('messages.lesson_image') }}
                        </h6>
                        <div class="text-center">
                            <img src="{{ asset($lesson->image) }}" alt="{{ __('messages.lesson_image') }}" class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                        </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Footer Section --}}
            <div class="card-footer bg-light text-muted text-end">
                {{ __('messages.last_updated') }}: {{ $lesson->updated_at->diffForHumans() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Optional: Add any page-specific JavaScript
    </script>
@endpush

@push('styles')
    <style>
        /* Optional: Add any custom styles */
    </style>
@endpush