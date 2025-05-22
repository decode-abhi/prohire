@extends('admin.admin-layout') {{-- Or your layout file --}}

@section('content')
<div class="container mt-5">
  <div class="card shadow-lg rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0 text-light">Create Job</h4>
      @php
          $id = Auth::user()->id;
      @endphp
      <a href="{{ route('job.allJobs',$id) }}" class="btn btn-light btn-sm rounded-pill">
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
        @php
            $id = Auth::user()->id;
            
        @endphp
      <form action="{{route('job.store',$id)}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Title Of Job</label>
          <input type="text" name="title" value="{{old('title')}}" id="title" class="form-control rounded-3" placeholder="job title" required>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Enter job details</label>
          <textarea name="description" value="{{old('description')}}" id="description" class="form-control rounded-3" cols="30" rows="20"placeholder="enter job details"></textarea>
        </div>

        <div class="mb-3">
          <label for="salary" class="form-label">Salary</label>
          <input type="number" name="salary" value="{{old('salary')}}" id="salary" class="form-control rounded-3" placeholder="enter salary" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Enter Company Location</label>
            <input type="text" name="location" value="{{old('location')}}" id="location" class="form-control rounded-3" placeholder="Enter Company location" required>
        </div>

        <div class="mb-3">
          <label for="type" class="form-label">Job Type</label>
          <select name="type" id="type" value="{{old('type')}}" class="form-select rounded-3" required>
            <option value="full-time">-- Select Role --</option>
            <option value="full-time">Full Time</option>
            <option value="part-time">Part Time</option>
            <option value="internship">Internship</option>
            <!-- Add more roles as needed -->
          </select>
        </div>

        <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">
          <i class="fas fa-user-plus me-1"></i> Create Job
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
