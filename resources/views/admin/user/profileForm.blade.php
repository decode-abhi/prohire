@extends(auth()->user()->role == 'admin' ? 'admin.admin-layout' : (auth()->user()->role == 'recruiter' ? 'recruiter.recruiter-layout' : 'jobseeker.jobseeker-layout'))
@section('content')
<!-- resources/views/user/profile_form.blade.php -->
{{--  --}}

<form action="{{ route('user-profile.update',$id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($userProfile))
        @method('PUT')
    @endif

    <div class="container mt-4">
        <div class="row">
            
            <!-- Personal Info -->
            <div class="col-md-6">
                <div class="mb-3">
                    @include('message')
                    @php
                        $user = auth()->user();
                        $profile = $user->user_profile;
                    @endphp
                    

    <label class="form-label">Profile Picture</label>
    <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
    <div class="mt-2">
        <img id="profile_picture_preview" src="{{ isset($userProfile->profile_picture) ? asset('storage/profile_pictures/' . $userProfile->profile_picture) : '#' }}" alt="Preview" style="max-height: 150px; display: {{ isset($userProfile->profile_picture) ? 'block' : 'none' }};">
    </div>
</div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" disabled class="form-control" value="{{$user->name ? $user->name : '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" disabled class="form-control" value="{{$user->email ? $user->email : '' }}">
                </div>
               
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
    <label class="form-label">Certificates (Upload multiple files)</label>
    <input type="file" name="certificates[]" id="certificates" class="form-control" multiple accept="image/*,application/pdf">
    <div class="mt-2 d-flex gap-2 flex-wrap" id="certificates_preview"></div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Profile Picture Preview
        const profileInput = document.getElementById('profile_picture');
        const profilePreview = document.getElementById('profile_picture_preview');

        profileInput?.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profilePreview.src = e.target.result;
                    profilePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Certificates Preview
        const certificatesInput = document.getElementById('certificates');
        const certificatesPreview = document.getElementById('certificates_preview');

        certificatesInput?.addEventListener('change', function () {
            certificatesPreview.innerHTML = ''; // Clear previous previews
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewElement = document.createElement(file.type.startsWith('image/') ? 'img' : 'a');

                    if (file.type.startsWith('image/')) {
                        previewElement.src = e.target.result;
                        previewElement.style.maxHeight = '100px';
                        previewElement.style.marginRight = '10px';
                        previewElement.style.border = '1px solid #ccc';
                        previewElement.style.padding = '4px';
                    } else {
                        previewElement.href = e.target.result;
                        previewElement.textContent = file.name;
                        previewElement.target = "_blank";
                        previewElement.style.display = 'block';
                    }

                    certificatesPreview.appendChild(previewElement);
                };
                reader.readAsDataURL(file);
            });
        });
    });
</script>



@endsection