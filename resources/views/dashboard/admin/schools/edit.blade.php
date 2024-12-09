@extends('layouts.dashboard.layout')
@section('title', 'Edit School')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => 'Edit School'])

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">Edit School</h2>
            <a href="{{ route('schools.index') }}" class="btn btn-secondary">
                Back to List
            </a>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('schools.update', $school->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- English Name -->
                                    <div class="mb-4">
                                        <label for="name_en" class="form-label">Name (English)</label>
                                        <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                               id="name_en" name="name_en" value="{{ old('name_en', $school->name_en) }}" placeholder="Enter English name">
                                        @error('name_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Arabic Name -->
                                    <div class="mb-4">
                                        <label for="name_ar" class="form-label">Name (Arabic)</label>
                                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror" 
                                               id="name_ar" name="name_ar" value="{{ old('name_ar', $school->name_ar) }}" placeholder="Enter Arabic name">
                                        @error('name_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $school->email) }}" placeholder="Enter email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Address -->
                                    <div class="mb-4">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                               id="address" name="address" value="{{ old('address', $school->address) }}" placeholder="Enter address">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" placeholder="Enter password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Established Year -->
                                    <div class="mb-4">
                                        <label for="type" class="form-label">Type</label>
                                        <select class="form-control @error('type') is-invalid @enderror" 
                                                id="type" name="type">
                                            <option value="primary" {{ old('type', $school->type) == 'primary' ? 'selected' : '' }}>Primary</option>
                                            <option value="secondary" {{ old('type', $school->type) == 'secondary' ? 'selected' : '' }}>Secondary</option>
                                            <option value="high_school" {{ old('type', $school->type) == 'high_school' ? 'selected' : '' }}>High School</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- Phone -->
                                    <div class="mb-4">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ old('phone', $school->phone) }}" placeholder="Enter phone number">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Logo -->
                                    <div class="mb-4">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                               id="logo" name="logo" accept="image/*" placeholder="Select logo">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- Description English -->
                                    <div class="mb-4">
                                        <label for="description_en" class="form-label">Description (English)</label>
                                        <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                                  id="description_en" name="description_en" rows="4" placeholder="Enter English description">{{ old('description_en', $school->description_en) }}</textarea>
                                        @error('description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Description Arabic -->
                                    <div class="mb-4">
                                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                                        <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                                  id="description_ar" name="description_ar" rows="4" placeholder="Enter Arabic description">{{ old('description_ar', $school->description_ar) }}</textarea>
                                        @error('description_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Organization -->
                            <div class="mb-4">
                                <label for="organization_id" class="form-label">Organization</label>
                                <select class="form-control @error('organization_id') is-invalid @enderror" 
                                        id="organization_id" name="organization_id">
                                    @foreach($organizations as $organization)
                                        <option value="{{ $organization->id }}" {{ old('organization_id', $school->organization_id) == $organization->id ? 'selected' : '' }}>
                                            {{ $organization->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('organization_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Max Students -->
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label for="max_students" class="form-label">Max Students</label>
                                    <input type="number" class="form-control @error('max_students') is-invalid @enderror" 
                                           id="max_students" name="max_students" value="{{ old('max_students', $school->max_students) }}" placeholder="Enter max students">
                                    @error('max_students')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="max_teachers" class="form-label">Max Teachers</label>
                                    <input type="number" class="form-control @error('max_teachers') is-invalid @enderror" 
                                           id="max_teachers" name="max_teachers" value="{{ old('max_teachers', $school->max_teachers) }}" placeholder="Enter max teachers">
                                    @error('max_teachers')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Grades -->
                            <div class="row">
                                <div class="col-6 mb-4">
                                    <label for="grades" class="form-label">Grades</label>
                                    <select class="form-control select2 @error('grades') is-invalid @enderror" id="grades" name="grades[]" multiple="multiple">
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ is_array(old('grades')) && in_array($grade->id, old('grades')) ? 'selected' : '' }}>
                                                {{ $grade->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mb-4">
                                    <label for="subjects" class="form-label">Subjects</label>
                                    <select class="form-control select2 @error('subjects') is-invalid @enderror" id="subjects" name="subjects[]" multiple="multiple">
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ is_array(old('subjects')) && in_array($subject->id, old('subjects')) ? 'selected' : '' }}>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update School</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection