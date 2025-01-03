@extends('layouts.dashboard.layout')
@section('title', 'Edit Grade')

@push('alerts')
    @if (Session::has('success'))
        <script>
            iziToast.success({
                title: 'OK',
                message: '{{ session('success') }}',
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ session('error') }}',
            });
        </script>
    @endif
@endpush

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => 'Edit Grade'])
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ __('dashboard.edit_grade') }}</h2>
            <a href="{{ route('grades.index') }}" class="btn btn-secondary">
                {{ __('dashboard.back_to_list') }}
            </a>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">

                        @include('dashboard.admin.grade.form', [
                            'grade' => $grade,
                            'method' => 'PUT',
                            'action' => route('grades.update', $grade->id),
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
