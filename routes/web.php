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
        return Product::inRandomOrder()->limit(6)->get();
    });

    return view('welcome', [
        'product' => $product
    ]);
})->name("Home");

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name("Dashboard")->middleware('auth');

// User Route

Route::get('/users/{users_id}', [UsersController::class, 'GetUser'])
    ->name("User")
    ->whereNumber('users_id');

Route::get('/users/{users_id}/setting', [UsersController::class, 'Setting'])
    ->name("UserSetting")
    ->whereNumber('users_id')
    ->middleware('auth');

Route::post('/users/{users_id}/setting', [UsersController::class, 'UpdateSetting'])
    ->name("UpdateSetting")
    ->whereNumber('users_id')
    ->middleware('auth');

Route::delete('/users/{users_id}/delete', [UsersController::class, 'Delete'])
    ->name("UserDelete")
    ->whereNumber('users_id')
    ->middleware('auth');

Route::get('/users', [UsersController::class, 'Index'])
    ->name("UsersList")
    ->middleware('auth');

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

Route::post('/subscribe/register', [SubscribeController::class, 'Create'])
    ->name("Subscribe");

Route::get('/subscribe', [SubscribeController::class, 'Index'])
    ->name("SubscribeList")
    ->middleware('auth');

Route::delete('/subscribe/{id}/delete', [SubscribeController::class, 'Delete'])
    ->name("DeleteSubscribe")
    ->middleware('auth')
    ->whereNumber('id');


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

Route::get('/dashboard/createproduct', [ProductController::class, "Form"])
    ->name("CreateProduct")
    ->middleware('auth');

Route::get('/product/{id}/editproduct', [ProductController::class, "Form"])
    ->name("EditProduct")
    ->middleware('auth')
    ->whereNumber('id');

Route::post('/dashboard/createproduct', [ProductController::class, "Create"])
    ->name("PostCreateProduct")
    ->middleware('auth');

Route::post('/product/{id}/editproduct', [ProductController::class, "Update"])
    ->name("PostEditProduct")
    ->middleware('auth')
    ->whereNumber('id');

Route::delete('/product/{id}/deleteproduct', [ProductController::class, "Delete"])
    ->name("DeleteProduct")
    ->middleware('auth')
    ->whereNumber('id');

// Purchase Route

Route::post('/product/{id}/purchase', [PurchaseController::class, "Create"])
    ->name("Purchase")
    ->whereNumber('id')
    ->middleware('auth');

Route::get('/user/purchasehistory', [PurchaseController::class, "Index"])
    ->name("PurchaseIndex")
    ->middleware("auth");

Route::delete('/purchase/{purchase_id}/deletepurchase', [PurchaseController::class, "Delete"])
    ->name("DeletePurchase")
    ->middleware("auth");

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

Route::get('/dashboard/createblog', [BlogController::class, "Form"])
    ->name("CreateBlog")
    ->middleware('auth');

Route::get('/blog/{id}/editblog', [BlogController::class, "Form"])
    ->name("EditBlog")
    ->middleware('auth')
    ->whereNumber('id');

Route::post('/dashboard/createblog', [BlogController::class, "Create"])
    ->name("PostCreateBlog")
    ->middleware('auth');

Route::post('/blog/{id}/editblog', [BlogController::class, "Update"])
    ->name("PostEditBlog")
    ->middleware('auth')
    ->whereNumber('id');

Route::delete('/blog/{id}/deleteblog', [BlogController::class, "Delete"])
    ->name("DeleteBlog")
    ->middleware('auth')
    ->whereNumber('id');

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
