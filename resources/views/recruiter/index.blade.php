@extends(auth()->user()->role === 'admin' ? 'admin.admin-layout' :
         (auth()->user()->role === 'recruiter' ? 'recruiter.recruiter-layout' :
         'jobseeker.jobseeker-layout'))

@section('content')
@include('message')
<div class="container mt-5">
  <div class="card shadow-lg rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Job Listings</h4>
      @can('create', App\Models\Job::class)
        <a href="{{ route('job.create') }}" class="btn btn-light btn-sm rounded-pill">
          <i class="fas fa-plus-circle me-1"></i> Create Job
        </a>
      @endcan
    </div>

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
