@extends('admin.admin-layout')
@section('content')
 @include('message')
<div class="container mt-5 card z-index-2 h-100">
  <div class="mb-4 text-2 card-header pb-0 d-flex justify-content-between">
   <h5> User List</h5>
   <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Create User</a>
  </div>
  <div class="table-responsive p-0">
    <table class="table align-items-center mb-0 table-striped table-bordered">
      <thead class="">
        <tr>
          <th class="text-uppercase  text-xxs font-weight-bolder">ID</th>
          <th class="text-uppercase  text-xxs font-weight-bolder">Profile</th>
          <th class="text-uppercase  text-xxs font-weight-bolder">Role</th>
          <th class="text-uppercase  text-xxs font-weight-bolder">Email</th>
          <th class="text-uppercase  text-xxs font-weight-bolder">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>
            <div class="d-flex px-2 py-1">
              <div>
                @if ($user->profile_picture && $user->profile_picture !== 'profile-picture.jpg')
                  <img src="{{ asset('storage/uploads/' . $user->profile_picture) }}" class="avatar avatar-sm me-3 rounded-circle" alt="Profile">
                @else
                  <img src="{{ asset('default-images/profile-picture.jpg') }}" class="avatar avatar-sm me-3 rounded-circle" alt="Default">
                @endif
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
              </div>
            </div>
          </td>
          <td>
            @php
              $badgeClass = match($user->role) {
                'admin' => 'bg-gradient-success',
                'recruiter' => 'bg-gradient-warning',
                default => 'bg-gradient-secondary'
              };
            @endphp
            <span class="badge badge-sm {{ $badgeClass }}">{{ ucfirst($user->role) }}</span>
          </td>
          <td class="text-center">{{ $user->email }} <span style="float: right"> <a href="{{route('admin.user.show',$user->id)}}"><i class="fa-solid fa-eye"></i></a></span></td>
          <td class="text-center">
            <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{route('admin.user.delete',$user->id)}}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="mt-3 px-3">
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection
