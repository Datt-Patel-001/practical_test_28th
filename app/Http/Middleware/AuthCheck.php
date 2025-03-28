<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!Auth::check()) {
            return redirect()->route('login')->with(['message' => 'Please verify your email address.']);        
        }

        if(Auth::user()->email_verified_at == null){
            Auth::logout();
            return redirect()->route('verify');
        }

        return $next($request);
    }
}
