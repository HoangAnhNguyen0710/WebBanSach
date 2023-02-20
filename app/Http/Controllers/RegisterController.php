<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function register(RegisterRequest $request) {
        // dd($request->all());
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'contact' => $request->contact,
            'role' => 'user',
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Tạo user thành công!');
    }
}
