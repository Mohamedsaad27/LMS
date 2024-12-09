@extends('layouts.dashboard.layout')
@section('title', trans('messages.schools'))

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => trans('messages.create_school')])

    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.create_school') }}</h2>
            <a href="{{ route('schools.index') }}" class="btn btn-secondary">
                {{ trans('messages.back_to_list') }}
            </a>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <form action="{{ route('schools.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-lg-6">

                                    <!-- English Name -->
                                    <div class="mb-4">
                                        <label for="name_en" class="form-label">{{ trans('messages.name_en') }}</label>
                                        <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                            id="name_en" name="name_en" value="{{ old('name_en') }}"
                                            placeholder="{{ trans('messages.enter_english_name') }}">
                                        @error('name_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label">{{ trans('messages.email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}"
                                            placeholder="{{ trans('messages.enter_email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label">{{ trans('messages.password') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password"
                                            placeholder="{{ trans('messages.enter_password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-4">
                                        <label for="phone" class="form-label">{{ trans('messages.phone') }}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') }}"
                                            placeholder="{{ trans('messages.enter_phone_number') }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description English -->
                                    <div class="mb-4">
                                        <label for="description_en"
                                            class="form-label">{{ trans('messages.description_en') }}</label>
                                        <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en"
                                            rows="4" placeholder="{{ trans('messages.enter_english_description') }}">{{ old('description_en') }}</textarea>
                                        @error('description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- Arabic Name -->
                                    <div class="mb-4">
                                        <label for="name_ar" class="form-label">{{ trans('messages.name_ar') }}</label>
                                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                            id="name_ar" name="name_ar" value="{{ old('name_ar') }}"
                                            placeholder="{{ trans('messages.enter_arabic_name') }}">
                                        @error('name_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-4">
                                        <label for="address" class="form-label">{{ trans('messages.address') }}</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" value="{{ old('address') }}"
                                            placeholder="{{ trans('messages.enter_address') }}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Established Year -->
                                    <div class="mb-4">
                                        <label for="type" class="form-label">{{ trans('messages.type') }}</label>
                                        <select class="form-control @error('type') is-invalid @enderror" id="type"
                                            name="type">
                                            <option value="primary" {{ old('type') == 'primary' ? 'selected' : '' }}>
                                                {{ trans('messages.primary') }}</option>
                                            <option value="secondary" {{ old('type') == 'secondary' ? 'selected' : '' }}>
                                                {{ trans('messages.secondary') }}</option>
                                            <option value="high_school"
                                                {{ old('type') == 'high_school' ? 'selected' : '' }}>High School</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Logo -->
                                    <div class="mb-4">
                                        <label for="logo" class="form-label">{{ trans('messages.logo') }}</label>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                            id="logo" name="logo" accept="image/*"
                                            placeholder="{{ trans('messages.select_logo') }}">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- Description Arabic -->
                                    <div class="mb-4">
                                        <label for="description_ar"
                                            class="form-label">{{ trans('messages.description_ar') }}</label>
                                        <textarea class="form-control @error('description_ar') is-invalid @enderror" id="description_ar"
                                            name="description_ar" rows="4" placeholder="{{ trans('messages.enter_arabic_description') }}">{{ old('description_ar') }}</textarea>
                                        @error('description_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    {{-- if role organxzation remove this field  --}}
                                    <!-- Organization -->
                                    <div class="mb-4">
                                        <label for="organization_id"
                                            class="form-label">{{ trans('messages.organizations') }}</label>
                                        <select class="form-control @error('organization_id') is-invalid @enderror"
                                            id="organization_id" name="organization_id">
                                            @foreach ($organizations as $organization)
                                                <option value="{{ $organization->id }}"
                                                    {{ old('organization_id') == $organization->id ? 'selected' : '' }}>
                                                    {{ $organization->name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('organization_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label for="max_students"
                                        class="form-label">{{ trans('messages.max_students') }}</label>
                                    <input type="number"
                                        class="form-control @error('max_students') is-invalid @enderror"
                                        placeholder="{{ trans('messages.enter_max_students') }}"
                                        id="max_students" name="max_students" value="{{ old('max_students') }}">
                                    @error('max_students')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label for="max_teachers"
                                        class="form-label">{{ trans('messages.max_teachers') }}</label>
                                    <input type="number"
                                        class="form-control @error('max_teachers') is-invalid @enderror"
                                        placeholder="{{ trans('messages.enter_max_teachers') }}"
                                        id="max_teachers" name="max_teachers" value="{{ old('max_teachers') }}">
                                    @error('max_teachers')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- Grades Multiselect -->
                                    <div class="col-12 mb-4">
                                        <label for="grades" class="form-label">{{ trans('messages.grades') }}</label>
                                        <select class="form-control select2 @error('grades') is-invalid @enderror"
                                            id="grades" name="grades[]" multiple="multiple">
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}"
                                                    {{ is_array(old('grades')) && in_array($grade->id, old('grades')) ? 'selected' : '' }}>
                                                    {{ $grade->name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('grades')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Subjects Multiselect -->
                                    <div class="col-12 mb-4">
                                        <label for="subjects" class="form-label">{{ trans('messages.subjects') }}</label>
                                        <select class="form-control select2 @error('subjects') is-invalid @enderror"
                                            id="subjects" name="subjects[]" multiple="multiple">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ is_array(old('subjects')) && in_array($subject->id, old('subjects')) ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subjects')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary">{{ trans('messages.create_school') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

