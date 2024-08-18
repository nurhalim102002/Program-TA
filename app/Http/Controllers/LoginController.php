<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function tampilLogin(){
        return view('halaman.login');
    }

    public function postLogin(Request $request) {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
            ]
        )) {
            return redirect('/');
        }
        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
