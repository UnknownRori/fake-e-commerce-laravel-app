<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    //
    public function Purchase(Request $request) {
        $valid = $request->validate([
            'id' => 'required|numeric|gt:0',
            'amount' => 'required|numeric|gt:0'
        ]);

        $product = Product::find($valid['id']);

        if ($product->stock >= $valid['amount']){

            $purchase = new Purchase();
            $purchase->users_id = Auth::user()->id;
            $purchase->product_id = $valid['id'];
            $purchase->amount = $valid['amount'];

            $product->stock = $product->stock - $valid['amount'];

            if($purchase->save() && $product->save()){
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
