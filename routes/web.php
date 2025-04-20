<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleCheck;

Route::get('/', function () {
    return view('auth.login');
});

// function role(...$roles) {
//     return fn ($request, $next) => (new RoleMiddleware)->handle($request, $next, ...$roles);
// }


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Default auth dashboard
Route::middleware([RoleCheck::class . ':jobseeker'])->group(function () {
    Route::get('/jobseeker/dashboard', [DashboardController::class, 'jobseekerDashboard'])->name('jobseeker.dashboard');
});

// Recruiter-only routes
Route::middleware([RoleCheck::class . ':recruiter'])->group(function () {
    Route::get('/recruiter/dashboard', [DashboardController::class, 'recruiterDashboard'])->name('recruiter.dashboard');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/manage', [JobController::class, 'manage'])->name('jobs.manage');
});

// Admin-only routes
Route::middleware([RoleCheck::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::group(['prefix' => 'admin', 'as' => 'admin.'],function(){
        Route::get('user/index',[UserController::class,'index'])->name('user.index');
    });
});

require __DIR__.'/auth.php';
