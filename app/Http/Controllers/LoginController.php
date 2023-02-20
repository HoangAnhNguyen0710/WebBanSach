<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(LoginRequest $request) {
       if(Auth::attempt($request->only('email', 'password'))) {
        return redirect()->route('home');
       }
       else {
        $errors = ['password'=> 'your password is invalid!'];
       }
       return back()->withErrors($errors);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
