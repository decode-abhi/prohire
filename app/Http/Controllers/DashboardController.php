<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function jobseekerDashboard(){
        return view('jobseeker.dashboard');
    }
    public function recruiterDashboard(){
        return view('recruiter.dashboard');
    }
    public function adminDashboard(){
        return view('admin.dashboard');
    }
}
