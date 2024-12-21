@extends('layouts.dashboard.layout')
@section('title', 'View Book')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', [
        'component' => trans('messages.view_book'),
    ])
    
    <div class="container-fluid px-4">
        <!-- Header Section with improved styling -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-primary fw-bold mb-0">
                <i class="fas fa-book me-2"></i>{{ trans('messages.view_book') }}
            </h2>
            <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>{{ trans('messages.back_to_list') }}
            </a>
        </div>

        <!-- Book Details Card -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Book Cover Column -->
                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <div class="text-center">
                                    @if ($book->cover_image)
                                        <img src="{{ asset($book->cover_image) }}" 
                                             alt="{{ $book->title }}" 
                                             class="img-fluid rounded-3 shadow-sm mb-3"
                                             style="max-height: 400px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-3 p-4 text-center">
                                            <i class="fas fa-book-open fa-4x text-secondary mb-3"></i>
                                            <p class="text-muted">{{ trans('messages.no_image_available') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Book Details Column -->
                            <div class="col-lg-8">
                                <div class="row g-4">
                                    <!-- Title -->
                                    <div class="col-12">
                                        <h3 class="text-primary mb-3 fw-bold">{{ $book->title }}</h3>
                                    </div>

                                    <!-- Author -->
                                    <div class="col-md-6">
                                        <div class="detail-group">
                                            <label class="text-muted fw-bold mb-2">
                                                <i class="fas fa-user-edit me-2"></i>{{ trans('messages.author') }}
                                            </label>
                                            <p class="h5">{{ $book->author }}</p>
                                        </div>
                                    </div>

                                    <!-- Publication Year -->
                                    <div class="col-md-6">
                                        <div class="detail-group">
                                            <label class="text-muted fw-bold mb-2">
                                                <i class="fas fa-calendar me-2"></i>{{ trans('messages.publication_year') }}
                                            </label>
                                            <p class="h5">{{ $book->publication_year }}</p>
                                        </div>
                                    </div>

                                    <!-- Subject -->
                                    <div class="col-md-6">
                                        <div class="detail-group">
                                            <label class="text-muted fw-bold mb-2">
                                                <i class="fas fa-bookmark me-2"></i>{{ trans('messages.subject') }}
                                            </label>
                                            <p class="h5">{{ $book->subject->name ?? trans('messages.not_available') }}</p>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12 mt-4">
                                        <div class="detail-group">
                                            <label class="text-muted fw-bold mb-2">
                                                <i class="fas fa-align-left me-2"></i>{{ trans('messages.description') }}
                                            </label>
                                            <p class="lead">{{ $book->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('styles')

<style>
        .detail-group {
            background-color: #f8f9fa;
            padding: 1.25rem;
            border-radius: 0.5rem;
            height: 100%;
        }
        
        .detail-group label {
            display: block;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .detail-group p {
            margin-bottom: 0;
            color: #2c3e50;
        }
        
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        .btn-outline-primary {
            border-width: 2px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            transform: translateY(-2px);
        }
    </style>
    @endpush