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
use Illuminate\Support\Facades\Storage;

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

        $user = Cache::remember($userkey, 20, function () use ($request) {
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

    public function Setting()
    {
        $userkey = 'user-' . Auth::user()->id;

        $user = Cache::remember($userkey, 20, function () {
            return User::find(Auth::user()->id);
        });

        return view('settinguser', [
            'user' => $user
        ]);
    }

    public function UpdateSetting(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|string|unique:users,email',
            'photo' => 'required|image',
            'password' => 'required|string',
            'newpassword' => 'required|string',
            'credit_card' => 'required|string'
        ]);

        $users = User::find(Auth::user()->id);
        $oldphoto = $users->username;
        $users->username = $validate['username'];
        $users->email = $validate['email'];
        $users->credit_card = Hash::make($validate['credit_card']);
        if ($validate['newpassword'] != $validate['password']) {
            $users->password = Hash::make($validate['newpassword']);
        }

        if ($users->save()) {
            if (UsersController::UploadPhoto($validate['photo'], $users->username, $oldphoto)) {
                session()->flash('success', 'User profile update successfully!');
                return redirect()->back();
            }
            session()->flash('fail', 'User profile update successfully but failed to upload!');
            return redirect()->back();
        }
        session()->flash('fail', 'User profile failed to update!');
        return redirect()->back();
    }

    public function Delete(Request $request)
    {
        $users = User::find($request->users_id);
        if ($users == null) {
            session()->flash('fail', 'users not found!');
            return redirect()->back();
        }

        if (Auth::user()->id == $users->id || Auth::user()->admin) {

            foreach ($users->product as $row) {
                Storage::delete('public/image/product/' . $row->productname . '.png');
            }
            foreach ($users->blog as $row) {
                Storage::delete('public/image/blog/' . $row->title . '.png');
            }

            if (Storage::delete('public/image/profile/' . $users->username . '.png')) {
                session()->flash('success', 'Failed to delete photo!');
                return redirect()->back();
            }
            if (DB::table('users')->where('id', $users->id)->delete()) {
                session()->flash('success', 'users successfully deleted!');
                return redirect()->back();
            }

            session()->flash('fail', 'Failed to delete users!');
            return redirect()->back();
        } else {
            session()->flash('fail', 'Invalid Pervilege!');
            return redirect()->route('Home');
        }
    }

    private static function UploadPhoto($photo, $title, $oldphoto)
    {
        $directory = "public/image/profile";

        if (!$oldphoto || $oldphoto == "") {
            $path = Storage::putFileAs(
                $directory,
                $photo,
                $title . '.png'
            );
            return $path;
        } else {
            if (!Storage::delete($directory . '/' . $oldphoto . '.png')) {
                session()->flash('fail', 'Old image failed to deleted!');
            }

            $path = Storage::putFileAs(
                $directory,
                $photo,
                $title . '.png'
            );

            return $path;
        }
    }

    public function Index()
    {
        $users = Cache::remember('user-list', 2, function () {
            return User::paginate(6);
        });

        return view('dashboard.userslist', [
            'users' => $users
        ]);
    }

    public function CreateView()
    {
        if (Auth::user()->admin) {
            return view('settinguser');
        }
    }

    public function Create(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|string|unique:users,email',
            'photo' => 'required|image',
            'password' => 'required|string',
            'credit_card' => 'required|string'
        ]);

        $users = new User();
        $users->username = $validate['username'];
        $users->email = $validate['email'];
        $users->password = Hash::make($validate['password']);
        $users->credit_card = Hash::make($validate['credit_card']);
        $users->admin = 0;
        $users->vendor = 0;

        if ($users->save()) {
            if (UsersController::UploadPhoto($validate['photo'], $validate['username'], null)) {
                session()->flash('success', 'User profile update successfully!');
                return redirect()->back();
            }
            session()->flash('fail', 'User profile update successfully but failed to upload!');
            return redirect()->back();
        }
        session()->flash('fail', 'User profile failed to update!');
        return redirect()->back();
    }
}
