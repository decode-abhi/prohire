@extends(auth()->user()->role === 'admin' ? 'admin.admin-layout' :
         (auth()->user()->role === 'recruiter' ? 'recruiter.recruiter-layout' :
         'jobseeker.jobseeker-layout'))

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h4 class="mb-4">Applicant Profile</h4>

        <h5>{{ $application->user->name ?? 'N/A' }}</h5>
        <p><strong>Email:</strong> {{ $application->user->email ?? $application->email }}</p>
        <p><strong>Applied For:</strong> {{ $application->job->title ?? 'N/A' }}</p>
        <p><strong>Applied On:</strong> {{ $application->created_at->format('M d, Y') }}</p>

        @if ($application->cover_letter)
            <p><strong>Cover Letter:</strong><br>{{ $application->cover_letter }}</p>
        @endif

        @if ($application->resume)
            <p><strong>Resume:</strong> 
                <a href="{{ asset('storage/uploads/' . $application->resume) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                    View Resume
                </a>
            </p>
        @endif

        @if(auth()->user()->role == 'recruiter')

        <form action="{{route('application.update',$application->id)}}" method="POST">
        @csrf
            <label for="status"><strong>Update Status:</strong></label>
            <select name="status" class="form-select mb-2" required>
                <option value="applied" selected disabled {{ $application->status == 'applied' ? 'selected' : '' }}>Applied</option>
                <option value="reviewed" {{ $application->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                <option value="interviewed" {{ $application->status == 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired</option>
            </select>
            <button type="submit" class="btn btn-sm btn-success">Update Status</button>
        </form>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>
@endsection
