@extends(auth()->user()->role === 'admin' ? 'admin.admin-layout' :
         (auth()->user()->role === 'recruiter' ? 'recruiter.recruiter-layout' :
         'jobseeker.jobseeker-layout'))

@section('content')
@include('message')

<div class="container mt-4">
    <h4 class="mb-4">Applicants for Your Job Postings</h4>

    @forelse ($applications as $application)
    <div class="card mb-3 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-start gap-3">
                <div>
                    <i class="fa fa-user-circle fa-3x text-secondary"></i>
                </div>
                <div>
                    <h5 class="mb-1">{{ $application->user->name ?? $application->applicant_name }}</h5>
                    <p class="mb-1 text-muted"><strong>Email:</strong> {{ $application->user->email ?? $application->email }}</p>
                    <p class="mb-1 text-muted"><strong>Role:</strong> {{ $application->user->role ?? 'N/A' }}</p>

                    @if($application->resume)
                        <p class="mb-1">
                            <strong>Resume:</strong>
                            <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="text-primary">View Resume</a>
                        </p>
                    @endif

                    @if($application->cover_letter)
                        <p class="mb-1"><strong>Cover Letter:</strong> {{ Str::limit($application->cover_letter, 150) }}</p>
                    @endif

                    <p class="mb-0 text-muted"><strong>Applied On:</strong> {{ $application->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="d-flex flex-column gap-2">
                <a href="{{ route('application.show', $application->id) }}" class="btn btn-sm btn-outline-info">
                    <i class="fa fa-eye"></i> View Profile
                </a>
                <a href="{{ route('admin.user.edit', $application->user->id ?? 0) }}" class="btn btn-sm btn-outline-primary">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.user.delete', $application->user->id ?? 0) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
                <form action="{{route('application.update',$application->id)}}" method="POST">
    @csrf
    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm upd-status" style="border-color: #e3aa00;color: #e3aa00;">
        <option value=""disabled selected>Update Status</option>
        <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlist</option>
        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Reject</option>
    </select>
</form>

            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-warning">No applications found for your job posts yet.</div>
    @endforelse

    <div class="mt-4">
        {{ $applications->links() }}
    </div>
</div>
@endsection
