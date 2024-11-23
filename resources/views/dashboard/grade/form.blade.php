<form action="{{$action}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('dashboard.grade_name') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  value="{{ old('name', $grade->name ?? '') }}" placeholder="{{ __('dashboard.enter_grade_name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('dashboard.description') }}</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="{{ __('dashboard.enter_grade_description') }}">{{ old('description', $grade->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ __('dashboard.submit') }}</button>
</form>
