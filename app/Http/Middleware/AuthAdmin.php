<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; // Add this import
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->utype === 'ADM') {
                return $next($request); // Allow the request to proceed if the user is an admin
            } else {
                Auth::logout(); // Logout the user if they are not an admin
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    }
}