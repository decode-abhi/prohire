<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $request->authenticate();
        $request->session()->regenerate();
        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();
            
            if ($user->role == 'admin') {
              
                return redirect()->route('admin.dashboard');  // Admin dashboard
            } elseif ($user->role == 'recruiter') {
               
                return redirect()->route('recruiter.dashboard');  // Recruiter dashboard
            } elseif (($user->role == 'jobseeker')) {
                
                return redirect()->route('jobseeker.dashboard');  // Jobseeker dashboard
            }
        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
