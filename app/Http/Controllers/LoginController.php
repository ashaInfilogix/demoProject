<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyOtp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
 
        return redirect()->route('login')->with('error', 'The provided credentials do not match our records.');
    }

    public function forgotPasswordPage()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user){
            $otp = rand(1000, 9999);
            $data = [
                'otp' => $otp,
                'name' => $user->first_name,
                'email' => $request->email
            ];

            Mail::to($request->email)->send(new VerifyOtp($data));

            $user->update([
                'otp' => $otp
            ]);

            $request->session()->put('reset_email', $request->email);
            return redirect()->route('otp');
        } else {
            return redirect()->route('forgot-password')->with('error', 'User not found');
        }
    }

    public function otpPage()
    {
        $email = session('reset_email');

        return view('auth.otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp'   => 'required|max:4',
            'email' => 'required'
        ]);

        $otp = User::where('email', $request->email)->first();

        if ($otp && $otp->otp == $request->otp) {
            $otp->update([
                'otp' => NULL
            ]);

            return redirect()->route('change-password');
        } else {
            return redirect()->route('forgot-password')->with('error', 'This OTP is not valid please enter valid OTP.');
        }
    }

    public function passwordChange()
    {
        $email = session('reset_email');

        return view('auth.change-password', compact('email'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'new_password'  => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user) {
            if (Hash::check($request->new_password, $user->password)) {
                return redirect()->route('change-password')->with('error', 'This OTP is not valid please enter valid OTP.');
            } else {
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);

                $request->session()->forget('reset_email');

                return redirect()->route('login')->with('success', 'Password change successfully');
            }
        }
    }
}
