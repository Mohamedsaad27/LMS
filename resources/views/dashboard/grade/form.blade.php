<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">{{ __('dashboard.grade_name_en') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                    name="name_en" value="{{ old('name_en', $grade->name_en ?? '') }}"
                    placeholder="{{ __('dashboard.enter_grade_name_en') }}">
                @error('name_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="name_ar">{{ __('dashboard.grade_name_ar') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                    name="name_ar" value="{{ old('name_ar', $grade->name_ar ?? '') }}"
                    placeholder="{{ __('dashboard.enter_grade_name_ar') }}">
                @error('name_ar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="educational_stage_id">{{ __('dashboard.educational_stage') }} <span class="text-danger">*</span></label>
                <select class="form-control @error('educational_stage_id') is-invalid @enderror" id="educational_stage_id" name="educational_stage_id">
                    <option value="">{{ __('dashboard.select_educational_stage') }}</option>
                    @foreach($educationalStages as $stage)
                        <option value="{{ $stage->id }}" {{ old('educational_stage_id', $grade->educational_stage_id ?? '') == $stage->id ? 'selected' : '' }}>
                            {{ $stage->name }}
                        </option>
                    @endforeach
                </select>
                @error('educational_stage_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 mt-3 mt-md-0">
            <div class="form-group">
                <label for="description_en">{{ __('dashboard.description_en') }}</label>
                <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en"
                    placeholder="{{ __('dashboard.enter_grade_description_en') }}">{{ old('description_en', $grade->description_en ?? '') }}</textarea>
                @error('description_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="description_ar">{{ __('dashboard.description_ar') }}</label>
                <textarea class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" name="description_ar"
                    placeholder="{{ __('dashboard.enter_grade_description_ar') }}">{{ old('description_ar', $grade->description_ar ?? '') }}</textarea>
                @error('description_ar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-4">{{ __('dashboard.submit') }}</button>
</form>
