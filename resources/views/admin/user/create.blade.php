@extends('admin.admin-layout') {{-- Or your layout file --}}

@section('content')
@include('message')

<div class="container mt-5">
  <div class="card shadow-lg rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0 text-light">Create User</h4>
      <a href="{{ route('admin.user.index') }}" class="btn btn-light btn-sm rounded-pill">
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

      <form action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" id="name" class="form-control rounded-3" placeholder="Enter full name" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" id="email" class="form-control rounded-3" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control rounded-3" placeholder="Create password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3" placeholder="Confirm password" required>
          </div>
          

        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-select rounded-3" required>
            <option value="jobseeker">-- Select Role --</option>
            <option value="admin">Admin</option>
            <option value="recruiter">Recruiter</option>
            <option value="jobseeker">Jobseeker</option>
            <!-- Add more roles as needed -->
          </select>
        </div>

        <div class="mb-4">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" name="profile_picture" class="form-control">
          </div>

        <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">
          <i class="fas fa-user-plus me-1"></i> Create User
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
