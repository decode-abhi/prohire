@extends('admin.admin-layout')

@section('content')
 @include('message')
<div class="container mt-5">
  <div class="card shadow-lg rounded-4">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Edit User</h4>
      <a href="{{ route('admin.user.index') }}" class="btn btn-dark btn-sm rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Back to List
      </a>
    </div>

    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger rounded-3">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" id="name" class="form-control rounded-3"
            value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" id="email" class="form-control rounded-3"
            value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">New Password <small>(leave blank if not changing)</small></label>
          <input type="password" name="password" id="password" class="form-control rounded-3"
            placeholder="New password (optional)">
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirm New Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3"
            placeholder="Confirm new password">
        </div>

        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-select rounded-3" required>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="recruiter" {{ old('role', $user->role) == 'recruiter' ? 'selected' : '' }}>Recruiter</option>
            <option value="jobseeker" {{ old('role', $user->role) == 'jobseeker' ? 'selected' : '' }}>Jobseeker</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Current Profile Picture</label><br>
          @if ($user->profile_picture && $user->profile_picture !== 'profile-picture.jpg')
            <img src="{{ asset('storage/uploads/' . $user->profile_picture) }}" width="100" class="rounded-circle">
          @else
            <img src="{{ asset('default-images/profile-picture.jpg') }}" width="100" class="rounded-circle">
          @endif
        </div>

        <div class="mb-4">
          <label for="profile_picture" class="form-label">Change Profile Picture</label>
          <input type="file" name="profile_picture" class="form-control rounded-3">
        </div>

        <button type="submit" class="btn btn-warning text-dark rounded-pill shadow-sm px-4">
          <i class="fas fa-save me-1"></i> Update User
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
