<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function LoginView()
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

    public function Login(Request $request)
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

    public function Register(Request $request)
    {
        if (!Auth::check()) {

            if ($credentials = $request->validate([
                'username' => 'required|string|unique:users,username|max:255',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string'
            ])) {
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

    public function Logout(Request $request)
    {

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

    public function JoinVendor()
    {
        $user = User::find(Auth::user()->id);
        $user->vendor = 1;
        if ($user->save()) {
            session()->flash('success', 'Successfully joined to Fake E-Commerce Vendor!');
            return redirect()->route('Dashboard');
        }

        session()->flash('fail', 'Failed joined to Fake E-Commerce Vendor!');
        return redirect()->route('Dashboard');
    }

    public function GetUser(Request $request)
    {
        $userkey = 'user-' . $request->users_id;

        $user = Cache::remember($userkey, 30, function () use ($request) {
            return User::find($request->users_id);
        });

        if ($user->vendor) {
            $vendorkey = 'user-product-' . $request->users_id;

            $product = Cache::remember($vendorkey, 30, function () use ($user) {
                return Product::where('users_id', $user->id)->paginate(8);
            });

            return view('user', [
                'user' => $user,
                'product' => $product
            ]);
        }

        return view('user', [
            'user' => $user
        ]);
    }
}
