<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $role): Response
    {
        if (Auth::check()) {
            $level = Auth::user()->role;
            if ($level == $role) {
                return $next($request);
            } else {
                return redirect('/')->with('message', 'You do not have permission to access this page.');
            }
        } {
            return redirect('/login')->with('message', 'You must be logged in to access this page.');
        }
    }
}
