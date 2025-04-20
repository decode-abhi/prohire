<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - User List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5">
    <h2 class="mb-4">User List</h2>
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
          <tr>
            <th scope="col">#ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Profile Picture</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <th scope="row">{{ $user->id }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if($user->role === 'admin')
                    <span class="badge bg-success">
                @elseif($user->role === 'recruiter')
                    <span class="badge bg-warning">
                @else
                    <span class="badge bg-secondary">
                @endif
                {{ ucfirst($user->role) }}
                </span>
              </td>
              <td>
                @if ($user->profile_picture && $user->profile_picture !== 'profile-picture.jpg')
                  <img src="{{ asset('storage/uploads/' . $user->profile_picture) }}" alt="Profile" width="50px" class="rounded-circle">
                @else
                  <img src="{{ asset('default-images/profile-picture.jpg') }}" alt="Default" width="50px" class="rounded-circle">
                @endif
              </td>
              <td>
                {{-- route('admin.users.edit', $user->id)
                     route('admin.users.destroy', $user->id) --}}
                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                <form action="#" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $users->links() }}
    </div>
  </div>

</body>
</html>
