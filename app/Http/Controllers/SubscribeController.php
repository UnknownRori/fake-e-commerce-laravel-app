<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SubscribeController extends Controller
{
    public function Create(Request $request)
    {

        $validate = $request->validate([
            'email' => 'required|string|unique:subscribe,email'
        ]);
        if (Auth::check()) {
            if ($validate['email'] == Auth::user()->email) {

                $Subscribe = new Subscribe();
                $Subscribe->users_id = Auth::user()->id;
                $Subscribe->email = $validate['email'];

                if ($Subscribe->save()) {
                    session()->flash('success', 'Your account successfully registered to our newsletter!');
                }

                return redirect()->route("Home");
            } else {
                session()->flash('fail', 'You probably should use that email already registered in this!');
                return redirect()->route("Home");
            }
        }

        $Subscribe = new Subscribe();
        $Subscribe->email = $validate['email'];

        if ($Subscribe->save()) {
            session()->flash('success', 'Your email account successfully registered to our newsletter!');
            return redirect()->route("Home");
        }
    }

    public function Index()
    {
        $Subscribe = Cache::remember('subscribe-list', 3, function () {
            return Subscribe::paginate(6);
        });

        return view('dashboard.subscribelist', [
            'subscribe' => $Subscribe
        ]);
    }

    public function Delete(Subscribe $subscribe)
    {
        if ($subscribe->delete())
            return redirect()->back()->with('success', 'Subscribe successfully removed!');

        return redirect()->back()->with('success', 'Subscribe failed to removed!');
    }
}
