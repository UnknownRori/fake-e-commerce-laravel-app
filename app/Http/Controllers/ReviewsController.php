<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function Create (Request $request) {
        $validate = $request->validate([
            'product_id' => 'required|numeric',
            'star' => 'required|digits_between:1,5',
            'comment' => 'required|string'
        ]);

        $check = Reviews::all()->where('product_id', '=', $validate['product_id'])->where('users_id', '=', Auth::user()->id);

        if($check->isEmpty()) {
            $reviews = new Reviews();
            $reviews->users_id = Auth::user()->id;
            $reviews->product_id = $validate['product_id'];;
            $reviews->star = $validate['star'];
            $reviews->comment = $validate['comment'];

            if ($reviews->save()) {
                session()->flash('success', 'Successfully create review!');
                return redirect()->back();
            }

            session()->flash('fail', 'Failed to create review!');
            return redirect()->back();
        }

        session()->flash('fail', 'Cannot create review if there are old review!');
        return redirect()->back();
    }

    public function Update (Request $request) {
        $validate = $request->validate([
            'star' => 'required|digits_between:1,5',
            'comment' => 'required|string'
        ]);

        $review = Reviews::find($request->reviews_id);
        $review->star = $validate['star'];
        $review->comment = $validate['comment'];

        if ($review->save()) {
            session()->flash('success', 'Review successfully edited!');
            return redirect()->back();
        }

        session()->flash('fail', 'Review failed to edited!');
        return redirect()->back();
    }

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
