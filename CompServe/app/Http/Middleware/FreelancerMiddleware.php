<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FreelancerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('/');
        }

        // Check if the role is freelancer
        if (Auth::user()->role !== 'freelancer') {
            abort(403, 'Unauthorized action.'); // or redirect to a default dashboard
        }

        return $next($request);
    }
}
