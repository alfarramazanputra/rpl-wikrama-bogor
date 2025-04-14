<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\User;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $log = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($log)) {
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
