<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // public function login(){
    //     return view('login');
    // }
    public function auth(Request $request)
    {
        $validasiAuth = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($validasiAuth)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('failed', 'Login Failed!')->withInput();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
