<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ProHire Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body{ background-color: #f8f9fa; }
    .main-contianer{ margin-top: 75px; }
    #sidebarMenu, #sidebarMenu-right {
      min-width: 220px;
      max-width: 220px;
      margin-bottom: 3rem;
      background-color: #fcfdff;
      position: fixed;
      top: 120px;
      padding-top: 30px;
      transition: all 0.3s;
      border-radius: 20px;
      border: 1px solid rgba(0, 0, 0, 0.175)
    }
    #sidebarMenu { left: 7%; }
    #sidebarMenu-right { right: 7%; }

    #sidebarMenu a, #sidebarMenu-right a {
      padding: 10px 20px;
      display: block;
      color: #333;
      text-decoration: none;
      font-weight: 500;
    }
    #sidebarMenu a:hover, #sidebarMenu-right a:hover {
      background: #0d6efd;
      color: #fff;
    }

    .content {
      position: fixed;
      top: 120px;
      left: 22%;
      right: 22%;
      bottom: 0;
      padding: 30px;
      background: #fcfdff;
      overflow-y: auto;
      border: 1px solid rgba(0, 0, 0, 0.175);
      border-radius: 20px;
      margin-bottom: 3rem;
    }

    .navbar-custom {
      background-color: #eaf4fc;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      padding: 0 6.5%;
    }

    .dropdown-menu-mega {
      width: 100%;
      left: 0;
      right: 0;
      top: 100%;
      padding: 1rem;
      background: #fff;
      border-top: 1px solid #dee2e6;
    }

    .logo {
      width: 60px;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img class="logo" src="{{asset('default-images/prohire-logo-white.png')}}" alt=""></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- Mega Menu -->
        <li class="nav-item dropdown dropdown-mega">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Jobs</a>
          <div class="dropdown-menu dropdown-menu-mega p-4">
            <div class="row">
              <div class="col-md-3">
                <h6>By Category</h6>
                <a class="dropdown-item" href="#">IT Jobs</a>
                <a class="dropdown-item" href="#">Sales Jobs</a>
              </div>
              <div class="col-md-3">
                <h6>By Location</h6>
                <a class="dropdown-item" href="#">Remote</a>
              </div>
              <div class="col-md-3">
                <h6>By Experience</h6>
                <a class="dropdown-item" href="#">Fresher</a>
              </div>
              <div class="col-md-3">
                <h6>Top Companies</h6>
                <a class="dropdown-item" href="#">Google</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Companies</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Services</a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Resume Writing</a></li>
          </ul>
        </li>

        <li class="nav-item mx-2 d-flex">
          <input class="form-control" type="search" placeholder="Search Jobs">
          <button class="btn btn-primary d-flex align-items-center"><i class="fas fa-search my-2 fs-6"></i></button>
        </li>

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
            <img src="{{asset('default-images/profile-picture.jpg')}}" class="rounded-circle logo" alt="User">
          </a>
          @php $user_id = auth()->user()->id; @endphp
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{route('user.profileBuilder', $user_id)}}">My Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="main-contianer">

  <!-- Left Sidebar -->
  <div id="sidebarMenu">
    <div class="text-center mb-4">
      <img src="{{asset('default-images/profile-picture.jpg')}}" class="rounded-circle logo" alt="User">
      <h6 class="mt-2">{{ auth()->user()->name }}</h6>
      <p class="small text-muted">{{ ucfirst(auth()->user()->role) }}</p>
    </div>
    <hr>
    @if(auth()->user()->role === 'admin')
      <a href="{{route('admin.dashboard')}}">Admin Dashboard</a>
      <a href="{{route('admin.user.index')}}">Manage Users</a>
    @elseif(auth()->user()->role === 'recruiter')
      <a href="{{route('recruiter.dashboard')}}">Recruiter Dashboard</a>
      <a href="{{route('job.index')}}">All Jobs</a>
      <a href="{{route('job.allJobs',auth()->user()->id)}}">Posted Job</a>
      <a href="{{route('jobs.manage')}}">Manage Jobs</a>
      <a href="{{route('recruiter.applicants')}}">Applicants</a>
    @elseif(auth()->user()->role === 'jobseeker')
      <a href="{{route('jobseeker.dashboard')}}">Jobseeker Dashboard</a>
      <a href="#">My Applications</a>
      <a href="#">Saved Jobs</a>
    @endif
    <a href="#">Messages</a>
    <a href="#">Notifications</a>
    <hr>
    <a href="#">Settings</a>
  </div>

  <!-- Content Area -->
  <div class="content">
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>

  <!-- Right Sidebar -->
  <div id="sidebarMenu-right">
    <div class="text-center mb-4">
      <img src="{{asset('default-images/profile-picture.jpg')}}" class="rounded-circle logo" alt="User">
      <h6 class="mt-2">{{ auth()->user()->name }}</h6>
      <p class="small text-muted">{{ ucfirst(auth()->user()->role) }}</p>
    </div>
    <hr>
    <a href="{{route('dashboard')}}">Main Dashboard</a>
    <a href="{{route('profile.edit')}}">Edit Profile</a>
    <a href="#">Messages</a>
    <a href="#">Notifications</a>
    <hr>
    <a href="#">Logout</a>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Optional: Sidebar toggle if needed
  // document.getElementById('menu-toggle').addEventListener('click', function () {
  //   document.body.classList.toggle('sidebar-collapsed');
  // });
</script>
</body>
</html>
