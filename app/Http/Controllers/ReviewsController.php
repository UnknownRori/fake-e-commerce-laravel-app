<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    //
    public function Delete (Request $request) {

        $review = Reviews::find($request->reviews_id);

        if ($review == null) {
            session()->flash('fail', 'Failed to delete review!');
            return redirect()->back();
        }

        if (Auth::user()->id == $review->users_id || Auth::user()->admin) {

            if (DB::table('reviews')->where('id', $review->id)->delete()) {

                session()->flash('success', 'Review successfully deleted!');
                return redirect()->back();

            }

            session()->flash('fail', 'Failed to delete review!');
            return redirect()->back();

        } else {
            session()->flash('fail', 'Invalid Pervilege!');
            return redirect()->route('Home');
        }
    }
}
