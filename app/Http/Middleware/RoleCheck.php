<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check()) {
            if (in_array(Auth::user()->role, $roles)) {
                return $next($request);
            }
    
            return redirect()->route(Auth::user()->role . '.dashboard')->with('error', 'Unauthorized access');
        }
        return redirect('login')->with('message', 'please login');
    }
}
