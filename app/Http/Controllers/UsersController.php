<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function LoginView ()
    {

        if (!Auth::check()) {

            return view('login');

        } else {

            session()->flash('alert', 'User already logged in!');

            return redirect()->route('Home');

        }

    }

    public function RegisterView()
    {

        if (!Auth::check()) {

            return view('register');

        } else {

            session()->flash('alert', 'User already logged in!');

            return redirect()->route('Home');

        }
    }

    public function Login (Request $request)
    {
        if (!Auth::check()) {

            $credentials = $request->validate([
                'username' => 'required|string|max:255',
                'password' => 'required|string'
            ]);

            if (Auth::attempt($credentials)) {

                $request->session()->regenerate();

                session()->flash('alert', 'User successfully logged in!');

                return redirect()->route('Home');

            } else {

                session()->flash('alert', 'User already logged in!');

                return redirect()->route('Login');

            }
        } else {

            return redirect()->route('Home');

        }
    }

    public function Register (Request $request)
    {
        if (!Auth::check()) {

            $credentials = $request->validate([
                'username' => 'required|string|unique:users|max:255',
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            $users = new User();
            $users->username = $credentials['username'];
            $users->email = $credentials['email'];
            $users->password = Hash::make($credentials['password']);
            $users->admin = 0;

            if ($users->save()) {

                if (Auth::attempt($credentials)) {

                    $request->session()->regenerate();

                    session()->flash('alert', 'User successfully logged in!');

                    return redirect()->route('Home');

                } else {

                    session()->flash('alert', 'Failed to create account');

                    return redirect()->route('Register');

                }

            }

        }
    }

    public function Logout (Request $request) {

        if (Auth::check()) {

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('Home');

        } else {

            session()->flash('alert', 'User must log in to use log out function!');

            return redirect()->route('Login');

        }

    }
}
