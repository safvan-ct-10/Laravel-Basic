<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if(auth()->check()) {
            return redirect()->route('admin.home');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 1
        ];
        $remember = $request->has('remember') ? true : false;

        if(auth()->attempt($data, $remember)) {
            return redirect()->route('admin.home');
        }
        return redirect()->route('admin.login')->with('error', 'Invalid Login!');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }
}
