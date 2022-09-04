<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function Create(Request $request)
    {
        $validate = $request->validate([
            'star' => 'required|digits_between:1,5',
            'comment' => 'required|string'
        ]);

        $check = Reviews::where('product_id', '=', $request->product_id)->where('users_id', '=', Auth::user()->id);

        if ($check->isEmpty()) {
            $reviews = new Reviews();
            $reviews->users_id = Auth::user()->id;
            $reviews->product_id = $request->product_id;
            $reviews->star = $validate['star'];
            $reviews->comment = $validate['comment'];

            if ($reviews->save())
                return redirect()->back()->with('success', 'Successfully create review!');

            return redirect()->back()->with('fail', 'Failed to create review!');
        }

        return redirect()->back()->with('fail', 'Cannot create review if there are old review!');
    }

    public function Update(Reviews $review, Request $request)
    {
        $validate = $request->validate([
            'star' => 'required|digits_between:1,5',
            'comment' => 'required|string'
        ]);

        $review->star = $validate['star'];
        $review->comment = $validate['comment'];

        if ($review->save())
            return redirect()->back()->with('success', 'Review successfully edited!');

        return redirect()->back()->with('fail', 'Review failed to edited!');
    }

    public function Delete(Reviews $review)
    {
        if (Auth::user()->id == $review->users_id || Auth::user()->admin) {

            if ($review->delete())
                return redirect()->back()->with('success', 'Review successfully deleted!');

            return redirect()->back()->with('fail', 'Failed to delete review!');
        }

        return redirect()->route('Home')->with('fail', 'Invalid Pervilege!');
    }
}
