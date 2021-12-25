<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReviewsController;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Main Route

Route::get('/', function () {
    $product = Cache::remember('product-welcome', 60, function () {
        return Product::all()->random(6);
    });

    return view('welcome', [
        'product' => $product
    ]);
})->name("Home");

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name("Dashboard")->middleware('auth');

// Reviews Route

Route::post('/product/{product_id}/createreviews', [ReviewsController::class, "Create"])
        ->name("CreateReviews")
        ->whereNumber('product_id')
        ->middleware('auth');

Route::delete('/product/{product_id}/{reviews_id}/deletereviews', [ReviewsController::class, 'Delete'])
        ->name("ReviewsDelete")
        ->whereNumber(['product_id', 'reviews_id'])
        ->middleware('auth');

Route::post('/product/{product_id}/{reviews_id}/updatereviews', [ReviewsController::class, 'Update'])
        ->name("UpdateReviews")
        ->whereNumber(['product_id', 'reviews_id'])
        ->middleware('auth');

// Vendor Route

Route::post('/dashboard/joinvendor', [UsersController::class, 'JoinVendor'])
        ->name("JoinVendor")
        ->middleware('auth');

// Subscribe Route

Route::post('/subscribe/subs', [SubscribeController::class, 'Subscribe'])
        ->name("Subscribe")
        ->middleware('auth');

// Product Route

Route::get('/product', [ProductController::class, 'ProductList'])
        ->name("ProductList");

Route::get('/product/{id}', [ProductController::class, "Product"])
        ->name('Product')
        ->whereNumber('id');

Route::get('/dashboard/listownedproduct', [ProductController::class, "OwnedProduct"])
        ->name("OwnedProduct")
        ->middleware('auth');

Route::get('/dashboard/listallproduct', [ProductController::class, "AllProductList"])
        ->name("AllProductList")
        ->middleware('auth');

// Purchase Route

Route::post('/product/{id}/purchase', [PurchaseController::class, "Purchase"])
        ->name("Purchase")
        ->whereNumber('id')
        ->middleware('auth');

// Blog Route

Route::get('/blog', [BlogController::class, 'BlogList'])
        ->name("BlogList");

Route::get('/blog/{id}', [BlogController::class, 'Blog'])
        ->name('Blog')
        ->whereNumber('id');

Route::get('/dashboard/listownedblog', [BlogController::class, 'ListOwnedBlog'])
        ->name("OwnedBlog")
        ->middleware('auth');

Route::get('/dashboard/listallblog', [BlogController::class, 'AllBlogList'])
    ->name("AllBloglist")
    ->middleware('auth');

// Login Route

Route::get('/auth/logout', [UsersController::class, 'Logout'])
        ->name("Logout");

Route::get('/auth/login', [UsersController::class, 'LoginView'])
        ->name("Login");
Route::get('/auth/register', [UsersController::class, 'RegisterView'])
        ->name("Register");

Route::post('/auth/login/post', [UsersController::class, 'Login'])
        ->name("PostLogin");
Route::post('/auth/register/post', [UsersController::class, 'Register'])
        ->name("PostRegister");
