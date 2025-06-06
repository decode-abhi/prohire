<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
   public function index(){
     $user = Auth::user();
     if($user->role == 'admin'){
          $applications = Application::orderBy('id','desc')->paginate(20);

     }elseif ($user->role == 'jobseeker') {
         $applications = Application::where('user_id',$user->id)->paginate(10);

     }elseif ($user->role == 'recruiter') {
          $applications = Application::whereHas('job', function($query) use ($user) {
              $query->where('user_id', $user->id);
          })->paginate(10);
      }
      
        return view('application.index', compact('applications'));
   }
   public function create($job){
     $applications = Application::findOrFail($job);
        return view('application.create',compact('applications'));
   }

   public function store(Request $request, $id){
       $request->validate([
         'job_id' => 'required',
         'cover_letter' => 'required',
         'resume' => 'required|mimes:pdf,doc,docx|max:10000',
         'email' => 'required',
      ]);
      $file = $request->file('resume');
      $resumePath = time().'.'.$file->extension();
      $file->storeAs('uploads',$resumePath,'public');
      Application::create([
          'job_id' => $request->job_id,
          'user_id' => $id,
          'cover_letter' => $request->cover_letter,
          'resume' => $resumePath,
          'applicant_name' => $request->applicant_name,
          'status' => 'applied', // Default status
      ]);
        return redirect()->route('job.index')->with('success', 'Job applied successfully');
   }

   public function edit($id){

        $applications = Application::findOrFail($id);
        return view('application.edit', compact('applications'));
   }

  public function update(Request $request, $id)
{
    $application = Application::with('job')->findOrFail($id);

    if (auth()->user()->role == 'recruiter') {
        // Ensure recruiter owns the job
        if ($application->job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $application->status = $request->input('status');
        $application->save();

        return redirect()->back()->with('success', 'Application status updated.');
    }

    // Ensure jobseeker is owner of this application
    if ($application->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'job_id' => 'required',
        'cover_letter' => 'required',
        'resume' => 'nullable|mimes:pdf,doc,docx|max:10000',
        'email' => 'required|email',
    ]);

    $resumePath = $application->resume;

    if ($request->hasFile('resume')) {
        $file = $request->file('resume');
        $resumePath = time() . '.' . $file->extension();
        $file->storeAs('uploads', $resumePath, 'public');
    }

    $application->update([
        'job_id' => $request->job_id,
        'user_id' => auth()->id(),
        'cover_letter' => $request->cover_letter,
        'resume' => $resumePath,
        'applicant_name' => $request->applicant_name,
        'status' => 'applied',
    ]);

    return redirect()->route('application.index')->with('success', 'Application updated successfully');
}

   

   public function destroy($id)
{
    $application = Application::findOrFail($id);

    // Delete resume file if it exists
    if ($application->resume && \Storage::disk('public')->exists('uploads/' . $application->resume)) {
        \Storage::disk('public')->delete('uploads/' . $application->resume);
    }

    $application->delete();

    return redirect()->route('application.index')->with('success', 'Application deleted successfully');
}


public function show(Request $request, $appId)
{
    $application = Application::with('user', 'job.user')->findOrFail($appId);
    $currentUser = auth()->user();

    // Role-based access control
    if (
        ($currentUser->role === 'recruiter' && $application->job->user->id !== $currentUser->id) ||
        ($currentUser->role === 'jobseeker' && $application->user_id !== $currentUser->id)
    ) {
        abort(403, 'Unauthorized access to this application.');
    }

    return view('application.show', compact('application'));
}



   public function appliedApplicants(){
    $user = auth()->user(); // current recruiter
    $applications = Application::whereHas('job', function ($query) use ($user) {
        $query->where('user_id', $user->id); // recruiter ID
    })->with(['job', 'user'])->orderBy('id','desc')->paginate(10);

    return view('recruiter.applicants',compact('applications'));
   }
}

