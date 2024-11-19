@extends('layouts.dashboard.layout')

@section('title', 'Organization Details')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">{{ __('Organization Details') }}</h2>
    </div>
    <div>
        <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i> {{ __('Edit Organization') }}
        </a>
        <a href="{{ route('organizations.index') }}" class="btn btn-sm btn-dark">
            <i class="fas fa-arrow-left"></i> {{ __('Back to List') }}
        </a>
    </div>
</div>

<div class="row">
    <!-- Organization Details Card -->
    <div class="col-12 col-xl-8">
        <div class="card card-body border-0 shadow mb-4">
            <div class="row">
                <div class="col-md-3 text-center">
                    @if($organization->logo)
                        <img src="{{ asset($organization->logo) }}" alt="Organization Logo" 
                             class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-gray-200 rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 150px; height: 150px; margin: 0 auto;">
                            <span class="h3 text-gray-600">{{ substr($organization->name_en, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <h2 class="h5 mb-4">{{ __('Basic Information') }}</h2>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>{{ __('English Name') }}:</strong>
                            <p>{{ $organization->name_en }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>{{ __('Arabic Name') }}:</strong>
                            <p>{{ $organization->name_ar }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>{{ __('Email') }}:</strong>
                            <p>{{ $organization->email }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>{{ __('Phone') }}:</strong>
                            <p>{{ $organization->phone }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>{{ __('Established Year') }}:</strong>
                            <p>{{ $organization->established_year }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>{{ __('Address') }}:</strong>
                            <p>{{ $organization->address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>{{ __('English Description') }}</h5>
                    <p>{{ $organization->description_en }}</p>
                </div>
                <div class="col-md-6">
                    <h5>{{ __('Arabic Description') }}</h5>
                    <p>{{ $organization->description_ar }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Card -->
    <div class="col-12 col-xl-4">
        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">{{ __('Statistics') }}</h2>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="h6 mb-0">{{ __('Total Schools') }}</span>
                <span class="badge bg-primary">{{ $organization->schools->count() }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="h6 mb-0">{{ __('Total Subjects') }}</span>
                <span class="badge bg-info">{{ $organization->subjects->count() }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="h6 mb-0">{{ __('Total Students') }}</span>
                <span class="badge bg-success">
                    {{ $organization->schools->sum(function($school) {
                        return $school->students->count();
                    }) }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Schools List -->
<div class="card border-0 shadow mb-4">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="h5 mb-0">{{ __('Schools') }}</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('schools.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> {{ __('Add School') }}
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">{{ __('Name') }}</th>
                        <th class="border-0">{{ __('Email') }}</th>
                        <th class="border-0">{{ __('Phone') }}</th>
                        <th class="border-0">{{ __('Type') }}</th>
                        <th class="border-0 rounded-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organization->schools as $school)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($school->logo)
                                    <img src="{{ asset( $school->logo) }}" 
                                         class="rounded-circle me-2" width="30" alt="School Logo">
                                @endif
                                {{ $school->name_en }}
                            </div>
                        </td>
                        <td>{{ $school->email }}</td>
                        <td>{{ $school->phone }}</td>
                        <td><span class="badge bg-primary">{{ $school->type }}</span></td>
                        <td>
                            <a href="{{ route('schools.show', $school->id) }}" 
                               class="btn btn-sm btn-info" title="{{ __('View Details') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('schools.edit', $school->id) }}" 
                               class="btn btn-sm btn-warning" title="{{ __('Edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            {{ __('No schools found') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any custom JavaScript here
</script>
@endpush