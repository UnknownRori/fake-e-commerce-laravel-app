<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reviews;
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
        $productkey = "product-" . strval($id);
        $reviewskey = "product-reviews-" . strval($id);

        // $product = Cache::remember($key, 180, function () use ($id) {
        //     return Product::find($id);
        // });

        $product = Cache::remember($productkey, 180, function () use ($id) {
            return Product::find($id);
        });

        $reviews = Cache::remember($reviewskey, 2, function () use ($id) {
            return Reviews::where('product_id', $id)->paginate(2);
        });

        return view('product', [
            'product' => $product,
            'reviews' => $reviews
        ]);

        // return view('product', [
        //     'product' => $product
        // ]);
    }
}
