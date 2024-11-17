@extends('layouts.dashboard.layout')
@section('title', 'Edit Organization')

@section('content')
    @include('layouts.dashboard.breadcrumb', ['component' => 'Edit Organization'])

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">Edit Organization</h2>
            <a href="{{ route('organizations.index') }}" class="btn btn-secondary">
                Back to List
            </a>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('organizations.update', $organization->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- English Name -->
                                    <div class="mb-4">
                                        <label for="name_en" class="form-label">Name (English)</label>
                                        <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                               id="name_en" name="name_en" 
                                               value="{{ old('name_en', $organization->name_en) }}" 
                                               placeholder="Enter English name">
                                        @error('name_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email"
                                               value="{{ old('email', $organization->email) }}" 
                                               placeholder="Enter email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" 
                                               placeholder="Enter password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-4">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" name="phone" 
                                               value="{{ old('phone', $organization->phone) }}" 
                                               placeholder="Enter phone number">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description English -->
                                    <div class="mb-4">
                                        <label for="description_en" class="form-label">Description (English)</label>
                                        <textarea class="form-control @error('description_en') is-invalid @enderror"
                                                  id="description_en" name="description_en" 
                                                  rows="4" 
                                                  placeholder="Enter English description">{{ old('description_en', $organization->description_en) }}</textarea>
                                        @error('description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Arabic Name -->
                                    <div class="mb-4">
                                        <label for="name_ar" class="form-label">Name (Arabic)</label>
                                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                               id="name_ar" name="name_ar" 
                                               value="{{ old('name_ar', $organization->name_ar) }}" 
                                               placeholder="Enter Arabic name">
                                        @error('name_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-4">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                               id="address" name="address" 
                                               value="{{ old('address', $organization->address) }}" 
                                               placeholder="Enter address">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Established Year -->
                                    <div class="mb-4">
                                        <label for="established_year" class="form-label">Established Year</label>
                                        <input type="number" class="form-control @error('established_year') is-invalid @enderror"
                                               id="established_year" name="established_year" 
                                               value="{{ old('established_year', $organization->established_year) }}" 
                                               min="1900" max="{{ date('Y') }}" 
                                               placeholder="Enter established year">
                                        @error('established_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Logo -->
                                    <div class="mb-4">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                               id="logo" name="logo" accept="image/*">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description Arabic -->
                                    <div class="mb-4">
                                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                                        <textarea class="form-control @error('description_ar') is-invalid @enderror"
                                                  id="description_ar" name="description_ar" 
                                                  rows="4" 
                                                  placeholder="Enter Arabic description">{{ old('description_ar', $organization->description_ar) }}</textarea>
                                        @error('description_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Organization</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
