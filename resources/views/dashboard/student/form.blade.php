    <form action="{{$action}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">English Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en"  value="{{ old('name_en', $student->name_en ?? '') }}" placeholder="Enter English Name">
                @error('name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_ar">Arabic Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="name_ar"  value="{{ old('name_ar', $student->name_ar ?? '') }}" placeholder="Enter Arabic Name">
                @error('name_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  value="{{ old('email', $student->email ?? '') }}" placeholder="Enter Email">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  placeholder="Enter Password">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $student->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $student->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address">{{ old('address', $student->address ?? '') }}</textarea>
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $student->phone ?? '') }}" placeholder="Enter Phone">
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="school_id">School <span class="text-danger">*</span></label>
                <select class="form-control @error('school_id') is-invalid @enderror" id="school_id" name="school_id" required>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}" {{ old('school_id', $student->school_id ?? '') == $school->id ? 'selected' : '' }}>{{ $school->name_en }}</option>
                    @endforeach
                </select>
                @error('school_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth"  value="{{ old('date_of_birth', $student->date_of_birth ?? '') }}" placeholder="Enter Date of Birth">
                @error('date_of_birth')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="parent_contact">Parent Contact</label>
                <input type="text" class="form-control @error('parent_contact') is-invalid @enderror" id="parent_contact" name="parent_contact"  value="{{ old('parent_contact', $student->parent_contact ?? '') }}" placeholder="Enter Parent Contact">
                @error('parent_contact')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"  placeholder="Select Photo">
                @error('photo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="grade_id">Grade <span class="text-danger">*</span></label>
                <select class="form-control @error('grade_id') is-invalid @enderror" id="grade_id" name="grade_id">
                    <option value="">Select Grade</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ old('grade_id', $student->grade_id ?? '') == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                    @endforeach
                </select>
                @error('grade_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
