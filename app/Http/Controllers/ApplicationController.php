<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApplicationController extends Controller
{
   public function index(){
     if(auth()->user()->role == 'admin'){
          $applications = Application::orderBy('id','desc')->paginate(20);
     }elseif (auth()->user()->role == 'jobseeker') {
         $applications = Application::where('user_id',user()->id())->get();
     }elseif (auth()->user()->role == 'recruiter') {
          $applications = Application::whereHas('job', function($query){
               $query->where('user_id',auth()->id());
          })->get();
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

   public function edit(){

        $applications = Application::paginate(10);
        return view('application.index', compact('applications'));
   }

   public function update(){
        $applications = Application::paginate(10);
        return view('application.index', compact('applications'));
   }

   public function destroy(){
        $applications = Application::paginate(10);
        return view('application.index', compact('applications'));
   }
   
   public function show(){
        $applications = Application::paginate(10);
        return view('application.index', compact('applications'));
   }
}
