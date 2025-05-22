<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ProHire Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body{
      background-color: #f8f9fa;
    }
    .main-contianer{
      margin-top: 75px;
    }
    /* Sidebar */
    #sidebarMenu {
    min-width: 220px;
    max-width: 220px;
    margin-bottom: 3rem;
    background-color: #fcfdff;
    position: fixed;
    top: 120px;
    left: 7%;
    padding-top: 30px;
    transition: all 0.3s;
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.175)
    }

    #sidebarMenu-right {
    min-width: 220px;
    max-width: 220px;
    margin-bottom: 3rem;
    background-color: #fcfdff;
    position: fixed;
    top: 120px;
    right: 7%;
    padding-top: 30px;
    transition: all 0.3s;
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.175)
    }
    .navbar {
      width: 
    }
    #sidebarMenu a {
      padding: 10px 20px;
      display: block;
      color: #333;
      text-decoration: none;
      font-weight: 500;
    }
    #sidebarMenu a:hover {
      background: #0d6efd;
      color: #fff;
    
    }
    #sidebarMenu-right a {
      padding: 10px 20px;
      display: block;
      color: #333;
      text-decoration: none;
      font-weight: 500;
    }
    #sidebarMenu-right a:hover {
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
    .sidebar-collapsed #sidebarMenu {
      margin-left: -220px;
    }
    .sidebar-collapsed #sidebarMenu-right {
      margin-left: -220px;
    }
    .sidebar-collapsed .content {
      margin-left: 0;
    }
    .navbar-custom {
    /*  margin-top: 36px; */
    background-color: #eaf4fc;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    /* width: 100%; */
    /* margin: 15px auto; */
    /* border-radius: 20px; */
    padding: 0 6.5%;
  }
    
    /* Mega Menu */
    .dropdown-mega {
      position: static;
    }
    .dropdown-menu-mega {
      width: 100%;
      left: 0;
      right: 0;
      top: 100%;
      padding: 1rem;
      background: #fff;
      border-radius: 0;
      border-top: 1px solid #dee2e6;
    }
    .dropdown-menu-mega .col-md-3 {
      margin-bottom: 1rem;
    }
    .logo{
      width: 60px;
      border-radius: 10px
    }
  </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
  <div class="container-fluid">
    

    <a class="navbar-brand" href="#"><img class="logo" src="{{asset('default-images\prohire-logo-white.png')}}" alt=""><strong></strong></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <button class="btn btn-outline-primary me-3" id="menu-toggle">☰</button> --}}
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item dropdown dropdown-mega">
          <a class="nav-link dropdown-toggle" href="#" id="megaMenuDropdown" role="button" data-bs-toggle="dropdown">
            Jobs
          </a>
          <div class="dropdown-menu dropdown-menu-mega p-4">
            <div class="row">
              <div class="col-md-3">
                <h6>By Category</h6>
                <a class="dropdown-item" href="#">IT Jobs</a>
                <a class="dropdown-item" href="#">Sales Jobs</a>
                <a class="dropdown-item" href="#">Marketing Jobs</a>
              </div>
              <div class="col-md-3">
                <h6>By Location</h6>
                <a class="dropdown-item" href="#">Remote</a>
                <a class="dropdown-item" href="#">Bangalore</a>
                <a class="dropdown-item" href="#">Delhi NCR</a>
              </div>
              <div class="col-md-3">
                <h6>By Experience</h6>
                <a class="dropdown-item" href="#">Fresher</a>
                <a class="dropdown-item" href="#">1-3 years</a>
                <a class="dropdown-item" href="#">5+ years</a>
              </div>
              <div class="col-md-3">
                <h6>Top Companies</h6>
                <a class="dropdown-item" href="#">Google</a>
                <a class="dropdown-item" href="#">Microsoft</a>
                <a class="dropdown-item" href="#">TCS</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Companies</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown">
            Services
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Resume Writing</a></li>
            <li><a class="dropdown-item" href="#">Career Advice</a></li>
          </ul>
        </li>

        <li class="nav-item mx-2 d-flex">
          <input class="form-control" type="search" placeholder="Search Jobs" aria-label="Search">
          <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-between"><i class="fas fa-search my-2 fs-6"></i></button>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
            <img src="{{asset('default-images\profile-picture.jpg')}}" class="rounded-circle logo" alt="User">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{route('user.profile-update')}}">My Profile</a></li>
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
  <!-- Sidebar -->
  <div id="sidebarMenu">
    <div class="text-center mb-4">
      <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
        <img src="{{asset('default-images\profile-picture.jpg')}}" class="rounded-circle logo" alt="User">
      </a>
      <h6 class="mt-2">John Doe</h6>
      <p class="small text-muted">Developer</p>
    </div>

    <hr>

    <a href="#">Dashboard</a>
    <a href="#">My Applications</a>
    <a href="#">Saved Jobs</a>
    <a href="#">Messages</a>
    <a href="#">Notifications</a>
    <hr>
    <a href="#">Settings</a>
  </div>

  <!-- Main Content -->
  <div class="content">
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>

  <!-- Sidebar -->
  <div id="sidebarMenu-right">
    <div class="text-center mb-4">
      <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
        <img src="{{asset('default-images\profile-picture.jpg')}}" class="rounded-circle logo" alt="User">
      </a>
      <h6 class="mt-2">John Doe</h6>
      <p class="small text-muted">Developer</p>
    </div>

    <hr>

    <a href="#">Dashboard</a>
    <a href="#">My Applications</a>
    <a href="#">Saved Jobs</a>
    <a href="#">Messages</a>
    <a href="#">Notifications</a>
    <hr>
    <a href="#">Settings</a>
  </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Sidebar Toggle Script
  document.getElementById('menu-toggle').addEventListener('click', function () {
    document.body.classList.toggle('sidebar-collapsed');
  });
</script>

</body>
</html>
