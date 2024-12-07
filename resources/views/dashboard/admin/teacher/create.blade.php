@extends('layouts.dashboard.layout')
@section('title', 'Teachers')

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => trans('dashboard.add_teacher')])

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
                        <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <!-- English Name -->
                                    <div class="mb-2">
                                        <label for="name_en" class="form-label">{{ trans('messages.name_en') }}</label>
                                        <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                            id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                                        @error('name_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-2">
                                        <label for="email" class="form-label">{{ trans('messages.email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-2">
                                        <label for="password" class="form-label">{{ trans('messages.password') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-2">
                                        <label for="phone" class="form-label">{{ trans('messages.phone') }}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- School -->
                                    <div class="mb-2">
                                        <label for="school_id"
                                            class="form-label">{{ trans('dashboard.select_school') }}</label>
                                        <select class="form-control @error('school_id') is-invalid @enderror" id="school_id"
                                            name="school_id" required>
                                            <option value="">{{ trans('dashboard.select_school') }}</option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('school_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                    <div class="mb-2">
                                        <label for="gender" class="form-label">{{ trans('messages.gender') }}</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                                            name="gender" required>
                                            <option value="">{{ trans('messages.select_gender') }}</option>
                                            <option value="male">{{ trans('messages.male') }}</option>
                                            <option value="female">{{ trans('messages.female') }}</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Grades -->
                                    <div class="mb-2">
                                        <label for="grades" class="form-label">{{ trans('dashboard.grades') }}</label>
                                        <div id="grades-container"></div>
                                        <input id="grades-input" class="tagify--outside w-100 px-2 gap-1 @error('grades') is-invalid @enderror" 
                                            placeholder="{{ trans('dashboard.grades') }}" required>
                                        @error('grades')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @push('scripts')
                                    <script>
                                        var gradesInput = document.querySelector('#grades-input');
                                        var gradesContainer = document.querySelector('#grades-container');
                                        
                                        var gradesTagify = new Tagify(gradesInput, {
                                            whitelist: [
                                                @foreach($grades as $grade)
                                                    {
                                                        value: '{{ $grade->name }}',
                                                        id: '{{ $grade->id }}',
                                                    },
                                                @endforeach
                                            ],
                                            focusable: false,
                                            dropdown: {
                                                position: 'input',
                                                enabled: 0
                                            }
                                        });

                                        // Set initial value from old input if exists
                                        @if(old('grades'))
                                            var oldGrades = [];
                                            @foreach($grades as $grade)
                                                @if(in_array($grade->id, old('grades')))
                                                    oldGrades.push({
                                                        value: '{{ $grade->name }}',
                                                        id: '{{ $grade->id }}'
                                                    });
                                                    var input = document.createElement('input');
                                                    input.type = 'hidden';
                                                    input.name = 'grades[]';
                                                    input.value = '{{ $grade->id }}';
                                                    gradesContainer.appendChild(input);
                                                @endif
                                            @endforeach
                                            gradesTagify.addTags(oldGrades);
                                        @endif

                                        gradesTagify.on('remove', function() {
                                            // Clear existing hidden inputs
                                            gradesContainer.innerHTML = '';
                                            
                                            // Get current tagify values
                                            var values = gradesTagify.value;
                                            
                                            // Recreate hidden inputs for remaining values
                                            values.forEach(function(item) {
                                                var input = document.createElement('input');
                                                input.type = 'hidden';
                                                input.name = 'grades[]';
                                                input.value = item.id;
                                                gradesContainer.appendChild(input);
                                            });
                                        });

                                        gradesTagify.on('change', function(e) {
                                            // Clear existing hidden inputs
                                            gradesContainer.innerHTML = '';
                                            
                                            // Get selected values
                                            var values = e.detail.tagify.value;
                                            
                                            // Create new hidden inputs for each selected grade
                                            values.forEach(function(item) {
                                                var input = document.createElement('input');
                                                input.type = 'hidden';
                                                input.name = 'grades[]';
                                                input.value = item.id;
                                                gradesContainer.appendChild(input);
                                            });
                                        });
                                    </script>
                                    @endpush

                                </div>

                                <div class="col-lg-6">
                                    <!-- Arabic Name -->
                                    <div class="mb-2">
                                        <label for="name_ar" class="form-label">{{ trans('messages.name_ar') }}</label>
                                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                            id="name_ar" name="name_ar" value="{{ old('name_ar') }}" required>
                                        @error('name_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-2">
                                        <label for="address" class="form-label">{{ trans('dashboard.address') }}</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" value="{{ old('address') }}" required>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Specialization -->
                                    <div class="mb-2">
                                        <label for="specialization"
                                            class="form-label">{{ trans('messages.specialization') }}</label>
                                        <input type="text"
                                            class="form-control @error('specialization') is-invalid @enderror"
                                            id="specialization" name="specialization" value="{{ old('specialization') }}"
                                            required>
                                        @error('specialization')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Subjects -->
                                    <div class="mb-2">
                                        <label for="subjects" class="form-label">{{ trans('messages.subjects') }}</label>
                                        <select class="form-control @error('subjects') is-invalid @enderror" id="subjects"
                                            name="subjects[]" multiple required>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('subjects')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Photo -->
                                    <div class="mb-2">
                                        <label for="photo" class="form-label">{{ trans('messages.photo') }}</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            id="photo" name="photo" accept="image/*">
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary">{{ trans('messages.create') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
