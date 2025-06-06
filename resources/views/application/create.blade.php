@extends(auth()->user()->role == 'admin' ? 'admin.admin-layout' : (auth()->user()->role == 'recruiter' ? 'recruiter.recruiter-layout' : 'jobseeker.jobseeker-layout'))


@section('content')
@include('message')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Apply for Job</h4>
        </div>
        <div class="card-body">
            <form action="{{route('application.store',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @foreach($applications as $application) --}}
                    
                <input type="hidden" name="job_id" value="{{ $applications->job->id }}">

                <div class="mb-3">
                    <label class="form-label">Job Title</label>
                    <input type="text" name="job-title" class="form-control" value="{{ $applications->job->title }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Name</label>
                    <input type="text" name="applicant_name" class="form-control" value="{{ auth()->user()->name}}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Email</label>
                    <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}" >
                </div>

                <div class="mb-3">
                    <label for="cover_letter" class="form-label">Cover Letter</label>
                    <textarea name="cover_letter" id="cover_letter" class="form-control" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="resume" class="form-label">Upload Resume (PDF only)</label>
                    {{-- accept=".pdf" --}}
                    <input type="file" name="resume" id="resume" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Submit Application</button>
                <a href="{{ route('job.index') }}" class="btn btn-secondary">Back to Jobs</a>
                
            </form>
        </div>
    </div>
</div>
@endsection
