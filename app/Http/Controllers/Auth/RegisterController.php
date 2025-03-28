<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Notifications\UserVerify;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function registerCustomer(RegisterRequest $request)
    {   
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'verification_token' => Str::random(20),
        ]);

        $user->notify(new UserVerify($user));

        return view('verify',compact( 'user'))->with(['message' => 'Customer registered successfully. Please check your email for verification.']);
    }

    public function registerAdmin(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_token' => Str::random(20),
            'role' => 'admin',
        ]);

        $user->notify(new UserVerify($user));

        return view('verify',compact( 'user'))->with(['message' => 'Admin registered successfully. Please check your email for verification.']);
    }

    public function verify($token)
    {       
        // Find user by verification token
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid verification link.'], 400);
        }

        // Mark user as verified
        $user->email_verified_at = Carbon::now();
        $user->verification_token = null;
        $user->save();

        $success = 'Email successfully verified. You can now log in.';
        return view('verify',compact('success'));
    }   

    public function resendEmail(Request $request)
    {   
        $user = User::where('id', $request->email)->first();

        if($user)
        {
            $user->notify(new UserVerify($user));
            return redirect()->back()->with(['message' => 'Verification email resent successfully.']);    
        }else{
            return response()->json(['message' => 'User not found.'], 404);
        }
    }
}
