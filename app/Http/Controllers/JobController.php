<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
   public function index(){
    $jobs = Job::orderBy('id','desc')->paginate(10);
     return view('job.index', compact('jobs'));
   }
   public function create(){
     return view('job.create');
   }
   public function store(Request $request,$id){
    $validation = $request->validate([
      'title' => 'required',
      'description' => 'required',
      'salary' => 'required',
      'location' => 'required',
      'type' => 'required',
    ]);
    Job::create([
      'title' => $request->title,
      'description' => $request->description,
      'salary' => $request->salary,
      'location' => $request->location,
      'type' => $request->type,
      'user_id' => $id,
    ]);
     return redirect()->route('job.allJobs',$id)->with('message','job created sucessfully');
   }
   public function show($id){
    $job = Job::findOrFail($id);
     return view('job.show',compact('job'));
   }
   public function edit(){
     return view('job.create');
   }
   public function update(){
     return view('job.create');
   }
   public function destroy(){
     return view('job.create');
   }
   public function recruiterJobs($id){
    $jobs = Job::where('user_id', $id)->orderBy('id', 'desc')->paginate(10);
    return view('recruiter.index',compact('jobs'));

   }
}
