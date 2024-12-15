@extends('layouts.dashboard.layout')

@section('title', __('messages.unit_details'))

@section('content')
    {{-- Breadcrumb Section --}}
    @include('layouts.dashboard.partials.breadcrumb', ['component' => trans('messages.unit_details')])

    {{-- Unit Details Container --}}
    <div class="container-fluid px-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-book-open me-2"></i>
                    {{ $unit->name }}
                </h5>
                <div class="card-header-actions">
                    @can('edit', $unit)
                        <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-sm btn-light">
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
                                @if (app()->getLocale() == 'ar')
                                    <td>{{ $unit->name_ar }}</td>
                                @else
                                    <td>{{ $unit->name_en }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>{{ __('messages.grade') }}</th>
                                @if (app()->getLocale() == 'ar')
                                    <td>{{ $unit->grade->name_ar }}</td>
                                @else
                                    <td>{{ $unit->grade->name_en }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>{{ __('messages.subject') }}</th>
                                <td>{{ $unit->subject->name }}</td>
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
                                <p class="text-muted">{{ $unit->description ?? __('messages.no_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Additional Details --}}
                <hr class="my-4">
                
         
            </div>

            {{-- Footer Section --}}
            <div class="card-footer bg-light text-muted text-end">
                {{ __('messages.last_updated') }}: {{ $unit->updated_at->diffForHumans() }}
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