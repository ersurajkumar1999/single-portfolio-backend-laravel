<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $remember = $request->has('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            toastr()->success('Welcome back, ' . $user->name . '! You have successfully logged in.');
            return redirect()->route('dashboard');
        }

        toastr()->error('Login failed. Please check your credentials and try again.');
        return redirect()->route('login')->withInput();
    }
}
