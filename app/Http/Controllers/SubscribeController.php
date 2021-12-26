<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{

    public function Create (Request $request)
    {

        $validate = $request->validate([
            'email' => 'required|string|unique:subscribe,email'
        ]);

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

}
