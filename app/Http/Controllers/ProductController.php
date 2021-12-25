<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function AllProductList () {
        $product = Cache::remember('owned-product-list', 2, function () {
            return Product::paginate(4);
        });

        return view('dashboard.productlist', [
            'product' => $product
        ]);
    }

    public function OwnedProduct () {
        $product = Cache::remember('owned-product-list', 2, function () {
            return Product::where('users_id', Auth::user()->id)->paginate(4);
        });

        return view('dashboard.productlist', [
            'product' => $product
        ]);
    }

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
        $starkey = "product-star-" . strval($id);
        $user_reviewskey = "product-reviewskey-" . strval($id);

        $product = Cache::remember($productkey, 5, function () use ($id) {
            return Product::find($id);
        });

        $reviews = Cache::remember($reviewskey, 2, function () use ($id) {
            return Reviews::where('product_id', $id)->paginate(2);
        });

        $star = Cache::remember($starkey, 180, function () use ($id) {
            return Reviews::where('product_id', $id)->avg('star');
        });

        $user_reviews = Cache::remember($user_reviewskey, 2, function () use ($id) {
            return Reviews::all()->where('product_id', '=', $id)->where('users_id', '=', Auth::user()->id)->first();
        });

        return view('product', [
            'product' => $product,
            'reviews' => $reviews,
            'star' => $star,
            'user_reviews' => $user_reviews
        ]);
    }
}
