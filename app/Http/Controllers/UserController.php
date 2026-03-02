<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function register(Request $request){
        
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ], [
            'name.required'  => 'Name field is mandatory.',
            'name.min'       => 'Name must be at least 3 characters.',
            'email.required' => 'Email is required.',
            'email.email'    => 'Please enter a valid email address.',
        ]);
        $user = User::create($data);
        if($user){
            Mail::to($user->email)->send(new WelcomeMail($user));
            return redirect()->route('login')
            ->with('success', 'Registration successful! Please login.');
        }
    }

    public function login(Request $request)
    {
        // $user = User::where('email', 'vinaymalik@virtualemployee.com')->first();
        // Mail::to('laravel@yopmail.com')->send(new WelcomeMail($user));
        // dd('done');
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' =>'required'
        ]);

        $remember = $request->boolean('remember');

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } 
        
        return back()->withErrors([
            'credError' => 'Credentials do not match our records.',
        ])->withInput();
    }

    public function dashboardPage(){ 
        if(Auth::check()){
            return view('dashboard');
        } else {
            return redirect()->route('login');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    { 
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)])->withInput();
    }

    public function showResetPasswordForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]])->withInput();
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:8|different:current_password',
        ]);

        $user = $request->user();

        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }
}
