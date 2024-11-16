@extends('layouts.dashboard.layout')
@section('title', 'Organizations')

@section('content')
    @include('layouts.dashboard.breadcrumb', ['component' => 'create Organizations'])

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">create Organizations</h2>
            <a href="{{ route('organization.create') }}" class="btn btn-primary">
            </a>
        </div>

@endsection        