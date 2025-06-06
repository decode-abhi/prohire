@extends(auth()->user()->role === 'admin' ? 'admin.admin-layout' :
         (auth()->user()->role === 'recruiter' ? 'recruiter.recruiter-layout' :
         'jobseeker.jobseeker-layout'))

@section('content')
@include('message')
<div class="container mt-5">
  <div class="">
    <div class="mb-2">
      <h4 class="mb-2">Jobs</h4>
      @can('create', App\Models\Job::class)
        <a href="{{ route('job.create') }}" class="btn btn-light btn-sm rounded-pill">
          <i class="fas fa-plus-circle me-1"></i> Create Job
        </a>
      @endcan
    </div>
    <form method="GET" action="{{ route('job.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
          <input type="text" name="search" class="form-control" placeholder="Search by title or company" value="{{ old('search') }}">
        </div>
        <div class="col-md-3">
          <select name="location" class="form-select">
            <option value="">All Locations</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Delhi">Delhi</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Chennai">Chennai</option>
            <option value="Pune">Pune</option>
            <option value="Surat">Surat</option>
            <option value="Ahmedabad">Ahmedabad</option>
            <!-- Add other locations -->
          </select>
        </div>
        <div class="col-md-3">
          <select name="type" class="form-select">
            <option value="">All Types</option>
            <option value="Full-time">Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Internship">Internship</option>
            <option value="Remote">Remote</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-outline-primary w-100" id="filter">
            <i class="fas fa-filter me-1"></i> Filter
          </button>
        </div>
      </form>
    <div class="card-body">
      @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
      @endif

      @if($jobs->isEmpty())
        <div class="alert alert-info">No jobs found.</div>
      @else
        <div class="table-responsive">
          @foreach($jobs as $job)
            @include('job.jobsCard')
          @endforeach
        </div>

        <div class="mt-3">
          {{ $jobs->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
@endsection