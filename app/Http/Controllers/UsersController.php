<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function LoginView ()
    {

        if (!Auth::check()) {

            return view('login');

        } else {

            session()->flash('fail', 'User already logged in!');

            return redirect()->route('Home');

        }

    }

    public function RegisterView()
    {

        if (!Auth::check()) {

            return view('register');

        } else {

            session()->flash('fail', 'User already logged in!');

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

                session()->flash('success', 'User successfully logged in!');

                return redirect()->route('Home');

            } else {

                session()->flash('fail', 'Wrong username or password!');

                return redirect()->route('Login');

            }
        } else {

            session()->flash('fail', 'User already logged in!');

            return redirect()->route('Home');

        }
    }

    public function Register (Request $request)
    {
        if (!Auth::check()) {

            if ($credentials = $request->validate([
                'username' => 'required|string|unique:users,username|max:255',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string'
                ])
            ) {
                session()->flash('fail', 'Account already taken!');
            }

            $users = new User();
            $users->username = $credentials['username'];
            $users->email = $credentials['email'];
            $users->password = Hash::make($credentials['password']);
            $users->admin = 0;
            $users->vendor = 0;

            if ($users->save()) {

                if (Auth::attempt($credentials)) {

                    $request->session()->regenerate();

                    session()->flash('success', 'Account successfully created!');

                    return redirect()->route('Home');

                } else {

                    session()->flash('fail', 'Failed to create account');

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

            session()->flash('fail', 'User must log in to use log out function!');

            return redirect()->route('Login');

        }

    }

    public function JoinVendor () {

        if(DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['vendor' => 1]))
        {
            session()->flash('success', 'Successfully joined to Fake E-Commerce Vendor!');
            return redirect()->route('Dashboard');
        }

        session()->flash('fail', 'Failed joined to Fake E-Commerce Vendor!');
        return redirect()->route('Dashboard');

    }
}
