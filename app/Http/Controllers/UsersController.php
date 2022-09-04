<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function LoginView()
    {

        return view('login');
    }

    public function RegisterView()
    {

        return view('register');
    }

    public function Login(Request $request)
    {
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
    }

    public function Register(Request $request)
    {
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

    public function Logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('Home');
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

    public function GetUser(User $user)
    {
        if ($user->vendor) {
            $vendorkey = 'user-product-' . $user->id;

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
        return view('settinguser', [
            'user' => auth()->user()
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

    public function Delete(User $user)
    {
        if (Auth::user()->id == $user->id || Auth::user()->admin) {

            foreach ($user->product as $row) {
                Storage::delete('public/image/product/' . $row->productname . '.png');
            }
            foreach ($user->blog as $row) {
                Storage::delete('public/image/blog/' . $row->title . '.png');
            }

            Storage::delete('public/image/profile/' . $user->username . '.png');

            if (User::destroy($user->id))
                return redirect()->back()->with('success', 'User successfully deleted!');

            return redirect()->back()->with('fail', 'Failed to delete users!');
        }

        return redirect()->route('Home')->with('fail', 'Invalid Pervilege!');
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
