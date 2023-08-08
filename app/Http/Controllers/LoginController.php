<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $req)
    {
        $credentials = $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $password = md5($credentials['password']);
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $password])) {
            $req->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->with('loginError', "Periksa username dan password anda !!");
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/');
    }
}
