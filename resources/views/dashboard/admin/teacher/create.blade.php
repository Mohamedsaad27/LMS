@extends('layouts.dashboard.layout')
@section('title', 'Teachers')

@push('alerts')
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
    @include('layouts.dashboard.partials.breadcrumb', ['component' => trans('dashboard.add_teacher')])


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    title: 'Error',
                    message: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('dashboard.add_teacher') }}</h2>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                {{ trans('messages.back_to_list') }}
            </a>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">

                        @include('dashboard.admin.teacher.form', [
                            'schools' => $schools,
                            'grades' => $grades,
                            'subjects' => $subjects,

                            'method' => 'POST',
                            'action' => route('teachers.store'),
                        ])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
