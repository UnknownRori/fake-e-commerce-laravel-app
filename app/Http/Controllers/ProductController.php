<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private static function VendorOnly()
    {
        if (!Auth::user()->vendor) {
            session()->flash('fail', 'Invalid Pervilege');
            return redirect()->back();
        }
    }

    public function Form(Request $request)
    {
        ProductController::VendorOnly();

        if ($request->id) {
            $key = "product-" . strval($request->id);

            $product = Cache::remember($key, 180, function () use ($request) {
                return Product::find($request->id);
            });

            if ($product->user->id == Auth::user()->id) {
                return view('dashboard.productform', [
                    'product' => $product
                ]);
            } else {
                session()->flash('fail', 'Invalid Pervilege');
                return redirect()->back();
            }
        }

        return view('dashboard.productform');
    }
    public function Create(Request $request)
    {
        ProductController::VendorOnly();

        $validate = $request->validate([
            'productname' => 'required|string|unique:product,productname',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|numeric|gt:0',
            'description' => 'required|string',
            'photo' => 'required|image',
        ]);

        $product = new Product();
        $product->users_id = Auth::user()->id;
        $product->productname = $validate['productname'];
        $product->price = $validate['price'];
        $product->stock = $validate['stock'];
        $product->description = $validate['description'];

        if ($product->save()) {

            if (ProductController::UploadPhoto($validate['photo'], $validate['productname'], null)) {
                session()->flash('success', 'product successfully posted!');
                return redirect()->back();
            }
            session()->flash('fail', 'Image cannot be saved! but product has successfully posted!');
            return redirect()->back();
        }

        session()->flash('fail', 'Internal Server Error!');
        return redirect()->back();
    }

    public function Update(Request $request)
    {
        ProductController::VendorOnly();

        $validate = $request->validate([
            'productname' => 'required|string|unique:product,productname',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|numeric|gt:0',
            'description' => 'required|string',
            'photo' => 'required|image',
        ]);

        $product = Product::find($request->id);
        $oldphoto = $product->productname;
        $product->productname = $validate['productname'];
        $product->price = $validate['price'];
        $product->stock = $validate['stock'];
        $product->description = $validate['description'];

        if ($product->save()) {

            if (ProductController::UploadPhoto($validate['photo'], $validate['productname'], $oldphoto)) {
                session()->flash('success', 'Product successfully edited!');
                return redirect()->back();
            }
            session()->flash('fail', 'Image cannot be saved! but Product has been edited!');
            return redirect()->back();
        }

        session()->flash('fail', 'Internal Server Error!');
        return redirect()->back();
    }

    public function Delete(Request $request)
    {
        ProductController::VendorOnly();

        $product = Product::find($request->id);
        if ($product == null) {
            session()->flash('fail', 'Product not found!');
            return redirect()->back();
        }

        if (Auth::user()->id == $product->users_id || Auth::user()->admin) {
            if (!Storage::delete('public/image/product/' . $product->productname . '.png')) {
                session()->flash('success', 'Image failed to delete!');
                return redirect()->back();
            }

            if (DB::table('product')->where('id', $product->id)->delete()) {
                session()->flash('success', 'Product successfully deleted!');
                return redirect()->back();
            }

            session()->flash('fail', 'Failed to delete product!');
            return redirect()->back();
        } else {
            session()->flash('fail', 'Invalid Pervilege!');
            return redirect()->route('Home');
        }
    }

    public function AllProductList()
    {
        ProductController::VendorOnly();

        $product = Cache::remember('owned-product-list', 2, function () {
            return Product::paginate(4);
        });

        return view('dashboard.productlist', [
            'product' => $product
        ]);
    }

    public function OwnedProduct()
    {
        ProductController::VendorOnly();

        $product = Cache::remember('owned-product-list', 2, function () {
            return Product::where('users_id', Auth::user()->id)->paginate(4);
        });

        return view('dashboard.productlist', [
            'product' => $product
        ]);
    }

    public function ProductList()
    {
        $product = Cache::remember('product-list', 2, function () {
            return Product::paginate(6);
        });

        return view('productlist', [
            'product' => $product
        ]);
    }

    public function Product($id)
    {
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

    private static function UploadPhoto($photo, $title, $oldphoto)
    {
        $directory = "public/image/product";

        if (!$oldphoto || $oldphoto == "") {
            $path = Storage::putFileAs(
                $directory,
                $photo,
                $title . '.png'
            );
            return $path;
        } else {
            if (!Storage::delete($directory . '/' . $oldphoto . '.png')) {
                session()->flash('fail', 'Old image failed to deleted!');
            }

            $path = Storage::putFileAs(
                $directory,
                $photo,
                $title . '.png'
            );

            return $path;
        }
    }
}
