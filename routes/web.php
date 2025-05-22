<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Middleware\RoleCheck;
use App\Http\Middleware\RoleMiddleware;
use bootstrap\app;

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
    Route::get('/update-profile',[ProfileController::class,'profileForm'])->name('user.profile-update');

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
            Route::get('user/create',[UserController::class,'create'])->name('user.create');
            Route::post('user/store',[UserController::class,'store'])->name('user.store');
            Route::get('user/show/{id}',[UserController::class,'show'])->name('user.show');
            Route::get('user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
            Route::put('user/update/{id}',[UserController::class,'update'])->name('user.update');
            Route::delete('user/delete/{id}',[UserController::class,'destroy'])->name('user.delete');
        });
        
    });
        // job routes
            Route::get('job/index',[JobController::class,'index'])->name('job.index');
            Route::get('job/show/{id}',[JobController::class,'show'])->name('job.show');
            Route::get('/application/index',[ApplicationController::class, 'index'])->name('application.index');
            
            Route::get('/application/edit/{id}',[ApplicationController::class, 'edit'])->name('application.edit');
            Route::post('/applciation/update/{id}',[ApplicationController::class, 'update'])->name('application.update');
            Route::get('/application/delete/{id}',[ApplicationController::class, 'destroy'])->name('application.delete');
            Route::get('/application/show/{id}',[ApplicationController::class, 'show'])->name('application.show');
            
            //admin job middleware
        Route::middleware(RoleMiddleware::class.':admin')->group(function(){
            Route::get('job/edit/{id}',[JobController::class,'edit'])->name('job.edit');
            Route::put('job/update/{id}',[JobController::class,'update'])->name('job.update');
            Route::delete('job/delete/{id}',[JobController::class,'destroy'])->name('job.delete');
        });
            //recruiter job middleware
        Route::middleware(RoleMiddleware::class.':recruiter')->group(function(){
            Route::get('job/create',[JobController::class,'create'])->name('job.create');
            Route::post('job/store/{id}',[JobController::class,'store'])->name('job.store');
            Route::get('job/allJobs/{id}',[JobController::class,'recruiterJobs'])->name('job.allJobs');
            
        });

        Route::middleware(RoleMiddleware::class.':jobseeker')->group(function(){
            Route::get('/job/{job}/apply',[ApplicationController::class, 'create'])->name('application.create');
            Route::post('/applciation/store/{id}',[ApplicationController::class, 'store'])->name('application.store');
            
        });
           
        

});



require __DIR__.'/auth.php';
