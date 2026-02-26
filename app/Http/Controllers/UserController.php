<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->route('login')
            ->with('success', 'Registration successful! Please login.');
        }
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' =>'required'
        ]);

        if(Auth::attempt($credentials)){
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
}
