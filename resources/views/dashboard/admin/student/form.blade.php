    <form action="{{$action}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">{{ trans('messages.english_name') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en"  value="{{ old('name_en', $student->user->name_en ?? '') }}" placeholder="{{ trans('messages.enter_english_name') }}">
                @error('name_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_ar">{{ trans('messages.arabic_name') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="name_ar"  value="{{ old('name_ar', $student->user->name_ar ?? '') }}" placeholder="{{ trans('messages.enter_arabic_name') }}">
                @error('name_ar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">{{ trans('messages.email') }} <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  value="{{ old('email', $student->user->email ?? '') }}" placeholder="{{ trans('messages.enter_email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">{{ trans('messages.password') }} <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  placeholder="{{ trans('messages.enter_password') }}">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender">{{ trans('messages.gender') }}</label>
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                    <option value="">{{ trans('messages.select_gender') }}</option>
                    <option value="male" {{ old('gender', $student->user->gender ?? '') == 'male' ? 'selected' : '' }}>{{ trans('messages.male') }}</option>
                    <option value="female" {{ old('gender', $student->user->gender ?? '') == 'female' ? 'selected' : '' }}>{{ trans('messages.female') }}</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address">{{ trans('messages.address') }}</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="{{ trans('messages.enter_address') }}">{{ old('address', $student->address ?? '') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">{{ trans('messages.phone') }}</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $student->user->phone ?? '') }}" placeholder="{{ trans('messages.enter_phone') }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="school_id">{{ trans('messages.school') }} <span class="text-danger">*</span></label>
                <select class="form-control @error('school_id') is-invalid @enderror" id="school_id" name="school_id" >
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}" {{ old('school_id', $student->school_id ?? '') == $school->id ? 'selected' : '' }}>{{ $school->name_en }}</option>
                    @endforeach
                </select>
                @error('school_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date_of_birth">{{ trans('messages.date_of_birth') }}</label>
                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth"  value="{{ old('date_of_birth', $student->date_of_birth ?? '') }}" placeholder="{{ trans('messages.enter_date_of_birth') }}">
                @error('date_of_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="parent_contact">{{ trans('messages.parent_contact') }}</label>
                <input type="text" class="form-control @error('parent_contact') is-invalid @enderror" id="parent_contact" name="parent_contact"  value="{{ old('parent_contact', $student->parent_contact ?? '') }}" placeholder="{{ trans('messages.enter_parent_contact') }}">
                @error('parent_contact')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="photo">{{ trans('messages.photo') }}</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"  placeholder="{{ trans('messages.select_photo') }}">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="grade_id">{{ trans('messages.grade') }} <span class="text-danger">*</span></label>
                <select class="form-control @error('grade_id') is-invalid @enderror" id="grade_id" name="grade_id">
                    <option value="">{{ trans('messages.select_grade') }}</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ old('grade_id', $student->grade_id ?? '') == $grade->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $grade->name_en : $grade->name_ar }}</option>
                    @endforeach
                </select>
                @error('grade_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">{{ trans('messages.submit') }}</button>
</form>
