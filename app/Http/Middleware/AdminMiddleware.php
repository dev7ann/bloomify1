<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->usertype == 'admin') {
            return $next($request);
        }
        // Redirect non-admins to the user dashboard
        return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
    }
}