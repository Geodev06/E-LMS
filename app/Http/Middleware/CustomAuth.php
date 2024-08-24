<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // Optionally, you could handle specific logic here
            // For example, redirect to a custom login page or return an error response
            return redirect()->route('login');
        }

        // Optionally, you can add additional custom checks here
        // For example, check if the user has a specific role
        if (Auth::user()->role_code !== 'ADMIN') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
