<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {   
        $user = Auth::user();
        if (!$user || $user->role !== $role) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        // if($user && $user->role !== $role) {
        //     return redirect()->route('home');
        // }
        return $next($request);
    }
}
