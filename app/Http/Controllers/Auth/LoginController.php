<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{   
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // if ($user->email_verified_at != null) {
            //     Auth::logout();
            //     return response()->json(['message' => 'Please verify your email before logging in'], 403);
            // }
            if($user->role === 'customer'){
                return redirect()->route('customer.dashboard')->with(['message' => 'Login successful']);
            }else if($user->role === 'admin'){
                return redirect()->route('admin.dashboard')->with(['message' => 'Login successful']);
            }else{
                return redirect()->route('home');
            }
        }
        return redirect()->back()->with(['message' => 'Invalid credentials']);
    }

    public function logout(Request $request)       
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
