@extends('admin.admin-layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">User Details</h4>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Profile Picture</strong>
                </div>
                <div class="col-md-9">
                    @if ($user->profile_picture && $user->profile_picture !== 'profile-picture.jpg')
                        <img src="{{ asset('storage/uploads/' . $user->profile_picture) }}" class="rounded-circle" width="100" height="100" alt="Profile Picture">
                    @else
                        <img src="{{ asset('default-images/profile-picture.jpg') }}" class="rounded-circle" width="100" height="100" alt="Default Picture">
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Name:</strong>
                </div>
                <div class="col-md-9">
                    {{ $user->name }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Email:</strong>
                </div>
                <div class="col-md-9">
                    {{ $user->email }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Role:</strong>
                </div>
                <div class="col-md-9">
                    <span class="badge bg-{{ $user->role === 'admin' ? 'success' : ($user->role === 'recruiter' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary rounded-pill">← Back to List</a>
                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary rounded-pill">Edit User</a>
            </div>
        </div>
    </div>
</div>
@endsection
