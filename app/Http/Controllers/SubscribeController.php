<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SubscribeController extends Controller
{
    private static function AdminOnly()
    {
        if (!Auth::user()->admin) {
            session()->flash('fail', 'Invalid Pervilege');
            return redirect()->back();
        }
    }

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
        SubscribeController::AdminOnly();

        $Subscribe = Cache::remember('subscribe-list', 3, function () {
            return Subscribe::paginate(6);
        });

        return view('dashboard.subscribelist', [
            'subscribe' => $Subscribe
        ]);
    }

    public function Delete(Request $request)
    {
        SubscribeController::AdminOnly();

        $Subscribe = Subscribe::find($request->id);
        if (Auth::user()->admin) {
            if (DB::table('subscribe')->where('id', $Subscribe->id)->delete()) {
                session()->flash('success', 'Subscribe successfully removed!');
                return redirect()->back();
            }
            session()->flash('success', 'Subscribe failed to removed!');
            return redirect()->back();
        }
    }
}
