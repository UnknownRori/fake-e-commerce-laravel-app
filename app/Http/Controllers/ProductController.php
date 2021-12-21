<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function ProductList () {
        $product = Cache::remember('product-list', 2, function () {
            return Product::paginate(6);
        });

        return view('productlist', [
            'product' => $product
        ]);
    }

    public function Product ($id) {
        $key = "product-" . strval($id);

        $product = Cache::remember($key, 180, function () use ($id) {
            return Product::find($id);
        });

        return view('product', [
            'product' => $product
        ]);
    }
}
