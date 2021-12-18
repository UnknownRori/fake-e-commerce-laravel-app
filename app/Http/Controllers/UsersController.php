<?php

namespace App\Http\Controllers;

use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function LoginView ()
    {

        if (!Auth::check()) {
            return view('login');
        } else {
            return redirect()->route('Home');
        }

    }

    public function RegisterView()
    {

        if (!Auth::check()) {
            return view('register');
        }
    }

    public function Login (Request $request)
    {
        if (!Auth::check()) {

            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required']
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('Home');
            } else {
                return redirect()->route('Login');
            }
        } else {
            return redirect()->route('Home');
        }
    }
}
