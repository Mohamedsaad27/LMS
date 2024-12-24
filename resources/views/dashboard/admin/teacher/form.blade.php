<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="row mb-4">
        <div class="col-lg-6">
            <!-- English Name -->
            <div class="mb-2">
                <label for="name_en" class="form-label">{{ trans('messages.name_en') }}</label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                    name="name_en" value="{{ old('name_en', $teacher->user->name ?? '') }}" required>
                @error('name_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-2">
                <label for="email" class="form-label">{{ trans('messages.email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email', $teacher->user->email ?? '') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-2">
                <label for="password" class="form-label">{{ trans('messages.password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" {{ !isset($teacher) ? 'required' : '' }}>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-2">
                <label for="phone" class="form-label">{{ trans('messages.phone') }}</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    name="phone" value="{{ old('phone', $teacher->user->phone ?? '') }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- School -->
            <div class="mb-2">
                <label for="school_id" class="form-label">{{ trans('dashboard.select_school') }}</label>
                <select class="form-control @error('school_id') is-invalid @enderror" id="school_id" name="school_id"
                    required>
                    <option value="">{{ trans('dashboard.select_school') }}</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}"
                            {{ old('school_id', $teacher->school->id ?? '') == $school->id ? 'selected' : '' }}>
                            {{ $school->name }}
                        </option>
                    @endforeach
                </select>
                @error('school_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gender -->
            <div class="mb-2">
                <label for="gender" class="form-label">{{ trans('messages.gender') }}</label>
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender"
                    required>
                    <option value="">{{ trans('messages.select_gender') }}</option>
                    <option value="male"
                        {{ old('gender', $teacher->user->gender ?? '') == 'male' ? 'selected' : '' }}>
                        {{ trans('messages.male') }}
                    </option>
                    <option value="female"
                        {{ old('gender', $teacher->user->gender ?? '') == 'female' ? 'selected' : '' }}>
                        {{ trans('messages.female') }}
                    </option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div class="mb-2">
                <label for="date_of_birth" class="form-label">{{ trans('messages.date_of_birth') }}</label>
                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                    id="date_of_birth" name="date_of_birth"
                    value="{{ old('date_of_birth', $teacher->date_of_birth ?? '') }}" required>
                @error('date_of_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hire Date -->
            <div class="mb-2">
                <label for="hire_date" class="form-label">{{ trans('messages.hire_date') }}</label>
                <input type="date" class="form-control @error('hire_date') is-invalid @enderror" id="hire_date"
                    name="hire_date" value="{{ old('hire_date', $teacher->hire_date ?? '') }}" required>
                @error('hire_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Experience Years -->
            <div class="mb-2">
                <label for="experience_years" class="form-label">{{ trans('messages.experience_years') }}</label>
                <input type="number" class="form-control @error('experience_years') is-invalid @enderror"
                    id="experience_years" name="experience_years"
                    value="{{ old('experience_years', $teacher->experience_years ?? '') }}" min="0" required>
                @error('experience_years')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-lg-6">
            <!-- Arabic Name -->
            <div class="mb-2">
                <label for="name_ar" class="form-label">{{ trans('messages.name_ar') }}</label>
                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                    name="name_ar" value="{{ old('name_ar', $teacher->user->name_ar ?? '') }}" required>
                @error('name_ar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-2">
                <label for="address" class="form-label">{{ trans('dashboard.address') }}</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" value="{{ old('address', $teacher->user->address ?? '') }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Qualification -->
            <div class="mb-2">
                <label for="qualification" class="form-label">{{ trans('messages.qualification') }}</label>
                <input type="text" class="form-control @error('qualification') is-invalid @enderror"
                    id="qualification" name="qualification"
                    value="{{ old('qualification', $teacher->qualification ?? '') }}" required>
                @error('qualification')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Photo -->
            <div class="mb-2">
                <label for="photo" class="form-label">{{ trans('messages.photo') }}</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                    name="photo" accept="image/*">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (isset($teacher) && $teacher->photo)
                    <div class="mt-2">
                        <img src="{{ asset($teacher->photo) }}" alt="Teacher photo" class="img-thumbnail"
                            width="100">
                    </div>
                @endif
            </div>

            <!-- Status -->
            <div class="mb-2">
                <label for="status" class="form-label">{{ trans('messages.status') }}</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                    required>
                    <option value="">{{ trans('messages.select_status') }}</option>
                    <option value="active" {{ old('status', $teacher->status ?? '') == 'active' ? 'selected' : '' }}>
                        {{ trans('messages.active') }}
                    </option>
                    <option value="inactive"
                        {{ old('status', $teacher->status ?? '') == 'inactive' ? 'selected' : '' }}>
                        {{ trans('messages.inactive') }}
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Salary -->
            <div class="mb-2">
                <label for="salary" class="form-label">{{ trans('messages.salary') }}</label>
                <input type="number" step="0.01" class="form-control @error('salary') is-invalid @enderror"
                    id="salary" name="salary" value="{{ old('salary', $teacher->salary ?? '') }}" required>
                @error('salary')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Grades -->
            <div class="mb-2">
                <label for="grades" class="form-label">{{ trans('dashboard.grades') }}</label>
                <div id="grades-container"></div>
                <input id="grades-input"
                    class="tagify--outside w-100 px-2 gap-1 @error('grades') is-invalid @enderror"
                    placeholder="{{ trans('dashboard.grades') }}">
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
                            @forelse($grades as $grade)
                                {
                                    value: '{{ $grade->name }}',
                                    id: '{{ $grade->id }}',
                                },
                            @empty
                                {
                                    value: '{{ trans('dashboard.no_grades_available') }}',
                                    id: '',
                                }
                            @endforelse
                        ],
                        focusable: false,
                        dropdown: {
                            position: 'input',
                            enabled: 0
                        }
                    });

                    // Set initial value from old input or existing data
                    @if (old('grades') || isset($teacher))
                        var oldGrades = [];
                        @foreach ($grades as $grade)
                            @if (
                                (old('grades') && in_array($grade->id, old('grades'))) ||
                                    (isset($teacher) && $teacher->grades->contains($grade->id)))
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

            <!-- Subjects -->
            <div class="mb-2">
                <label for="subjects" class="form-label">{{ trans('messages.subjects') }}</label>
                <div id="subjects-container"></div>
                <input id="subjects-input"
                    class="tagify--outside w-100 px-2 gap-1 @error('subjects') is-invalid @enderror"
                    placeholder="{{ trans('messages.subjects') }}">
                @error('subjects')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @push('scripts')
                <script>
                    var subjectsInput = document.querySelector('#subjects-input');
                    var subjectsContainer = document.querySelector('#subjects-container');

                    var subjectsTagify = new Tagify(subjectsInput, {
                        whitelist: [
                            @forelse($subjects as $subject)
                                {
                                    value: '{{ $subject->name }}',
                                    id: '{{ $subject->id }}',
                                },
                            @empty
                                {
                                    value: '{{ trans('dashboard.no_subjects_available') }}',
                                    id: '',
                                }
                            @endforelse
                        ],
                        focusable: false,
                        dropdown: {
                            position: 'input',
                            enabled: 0
                        }
                    });

                    // Set initial value from old input or existing data
                    @if (old('subjects') || isset($teacher))
                        var oldSubjects = [];
                        @foreach ($subjects as $subject)
                            @if (
                                (old('subjects') && in_array($subject->id, old('subjects'))) ||
                                    (isset($teacher) && $teacher->subjects->contains($subject->id)))
                                oldSubjects.push({
                                    value: '{{ $subject->name }}',
                                    id: '{{ $subject->id }}'
                                });
                                var input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'subjects[]';
                                input.value = '{{ $subject->id }}';
                                subjectsContainer.appendChild(input);
                            @endif
                        @endforeach
                        subjectsTagify.addTags(oldSubjects);
                    @endif

                    subjectsTagify.on('remove', function() {
                        // Clear existing hidden inputs
                        subjectsContainer.innerHTML = '';

                        // Get current tagify values
                        var values = subjectsTagify.value;

                        // Recreate hidden inputs for remaining values
                        values.forEach(function(item) {
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'subjects[]';
                            input.value = item.id;
                            subjectsContainer.appendChild(input);
                        });
                    });

                    subjectsTagify.on('change', function(e) {
                        // Clear existing hidden inputs
                        subjectsContainer.innerHTML = '';

                        // Get selected values
                        var values = e.detail.tagify.value;

                        // Create new hidden inputs for each selected subject
                        values.forEach(function(item) {
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'subjects[]';
                            input.value = item.id;
                            subjectsContainer.appendChild(input);
                        });
                    });
                </script>
            @endpush

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button type="submit"
                class="btn btn-primary">{{ isset($teacher) ? trans('dashboard.update') : trans('dashboard.create') }}</button>
        </div>
    </div>
</form>
