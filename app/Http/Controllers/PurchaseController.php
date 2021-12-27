<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function Delete(Request $request)
    {
        $purchase = Purchase::find($request->purchase_id);

        if ($purchase == null) {
            session()->flash('fail', 'Purchase not found!');
            return redirect()->back();
        }

        if (Auth::user()->id == $purchase->users_id) {
            if (DB::table('purchase')->where('id', $purchase->id)->delete()) {
                session()->flash('success', 'Purchase record successfully deleted!');
                return redirect()->back();
            }

            session()->flash('success', 'Purchase record failed to delete!');
            return redirect()->back();
        } else {
            session()->flash('fail', 'Invalid Pervilege');
            return redirect()->back();
        }
    }

    public function Create(Request $request)
    {
        $valid = $request->validate([
            'id' => 'required|numeric|gt:0',
            'amount' => 'required|numeric|gt:0'
        ]);

        $product = Product::find($valid['id']);

        if ($product->stock >= $valid['amount']) {

            $purchase = new Purchase();
            $purchase->users_id = Auth::user()->id;
            $purchase->product_id = $valid['id'];
            $purchase->amount = $valid['amount'];

            $product->stock = $product->stock - $valid['amount'];

            if ($purchase->save() && $product->save()) {
                session()->flash('success', 'Transaction successfully!');
                return redirect()->back();
            }
        } else {
            session()->flash('fail', 'Cannot purchase above available stock!');
            return redirect()->back();
        }

        session()->flash('fail', 'Transaction failed!');
        return redirect()->back();
    }
}
