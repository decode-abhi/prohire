@extends(auth()->user()->role == 'admin' ? 'admin.admin-layout' : (auth()->user()->role == 'recruiter' ? 'recruiter.recruiter-layout' : 'jobseeker.jobseeker-layout'))
@section('content')
<!-- resources/views/user/profile_form.blade.php -->

<form action="{{ route('user-profile.update', $userProfile->id ?? '') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($userProfile))
        @method('PUT')
    @endif

    <div class="container mt-4">
        <div class="row">

            <!-- Personal Info -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $userProfile->phone ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $userProfile->address ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $userProfile->city ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $userProfile->state ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $userProfile->country ?? '') }}">
                </div>
            </div>

            <!-- Education, Experience -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Qualification</label>
                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $userProfile->qualification ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Certificates</label>
                    <textarea name="certificates" class="form-control">{{ old('certificates', $userProfile->certificates ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Experience</label>
                    <textarea name="experience" class="form-control" rows="3">{{ old('experience', $userProfile->experience ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Professional Summary</label>
                    <textarea name="summary" class="form-control" rows="2">{{ old('summary', $userProfile->summary ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Links & Resume -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">LinkedIn</label>
                    <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $userProfile->linkedin ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">GitHub</label>
                    <input type="url" name="github" class="form-control" value="{{ old('github', $userProfile->github ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Skills (comma separated)</label>
                    <input type="text" name="skills" class="form-control" value="{{ old('skills', $userProfile->skills ?? '') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Resume (PDF)</label>
                    <input type="file" name="resume" class="form-control">
                    @if(isset($userProfile->resume))
                        <small class="text-muted">Current: {{ $userProfile->resume }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Save Profile</button>
        </div>
    </div>
</form>


@endsection