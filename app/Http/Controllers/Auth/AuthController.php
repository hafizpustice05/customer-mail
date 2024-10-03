<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function create()
    {
        $user =  User::create([
            'name' => 'Hafizul Islam',
            'email' => 'hafizpustice05@gmail.com',
            'password' => '1234'
        ]);

        Auth::login($user);
        return \redirect()->route('home');
    }
    public function login(Request $request)
    {
        // return $request->all();
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required']
        ]);

        // return $fields;
        if (Auth::attempt($fields, $request->rememberMe)) {
            return \redirect()->intended('admin/dashboard');
            return \redirect()->route('home');
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our recordd.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return \redirect('/');
    }
}
