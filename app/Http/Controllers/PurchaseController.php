<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function Index()
    {
        $key = 'purchase-history-' . Auth::user()->id;
        $purchase = Cache::remember($key, 30, function () {
            return Purchase::where('users_id', Auth::user()->id)->paginate(4);
        });

        return view('purchasehistory', [
            'purchase' => $purchase
        ]);
    }

    public function Delete(Purchase $purchase)
    {
        if (Auth::user()->id == $purchase->users_id || auth()->user()->id) {
            if ($purchase->delete())
                return redirect()->back()->with('success', 'Purchase record successfully deleted!');

            return redirect()->back()->with('success', 'Purchase record failed to delete!');
        }

        return redirect()->back()->with('fail', 'Invalid Pervilege');
    }

    public function Create(Product $product, Request $request)
    {
        $valid = $request->validate([
            'amount' => 'required|numeric|gt:0'
        ]);

        if ($product->stock >= $valid['amount']) {

            $purchase = new Purchase();
            $purchase->users_id = Auth::user()->id;
            $purchase->product_id = $product->id;
            $purchase->amount = $valid['amount'];

            $product->stock = $product->stock - $valid['amount'];

            if ($purchase->save() && $product->save())
                return redirect()->back()->with('success', 'Transaction successfully!');

            return redirect()->back()->with('fail', 'Transaction failed!');
        }

        return redirect()->back()->with('fail', 'Cannot purchase above available stock!');
    }
}
