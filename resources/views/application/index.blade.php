@extends(auth()->user()->role === 'admin' ? 'admin.admin-layout' : (auth()->user()->role === 'recruiter' ? 'recruiter.recruiter-layout' : 'jobseeker.jobseeker-layout'))

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Applications</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($applications->count() > 0)
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">Sr. No</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Company</th>
                        <th scope="col">Resume</th>
                        <th scope="col">Cover Letter</th>
                        <th scope="col">Applied On</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($applications as $index => $application)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td class="text-capitalize fw-semibold">{{ $application->job->title }}</td>
                            <td>{{ $application->job->company }}</td>
                            <td class="text-center">
                                @if($application->resume)
                                    <a href="{{ asset('storage/uploads/' . $application->resume) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        View Resume
                                    </a>
                                @else
                                    <span class="text-muted">Not Uploaded</span>
                                @endif
                            </td>
                            <td>{{ Str::limit(strip_tags($application->cover_letter), 50) }}</td>
                            <td>{{ $application->created_at->format('d M, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="table-footer">
                    {{$applications->links('pagination::bootstrap-5')}}
                </div>
            </table>
        </div>
    @else
        <div class="alert alert-info mt-4 text-center">
            <i class="bi bi-info-circle-fill me-2"></i> You haven't applied to any jobs yet.
        </div>
    @endif
</div>
@endsection
