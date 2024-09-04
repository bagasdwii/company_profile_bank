<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function authlogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return back()->withErrors([
            'loginError'=>'Email atau Password Salah'
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
        
    }

}
