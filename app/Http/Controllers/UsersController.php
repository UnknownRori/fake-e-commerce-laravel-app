<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function LoginView () {

        if (!Auth::check()) {
            return view('login');
        }

    }

    public function RegisterView()
    {

        if (!Auth::check()) {
            return view('register');
        }
    }
}
