<?php

use App\Http\Controllers\UsersController;
use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
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


Route::get('/product', function () {
    $product = Cache::remember('product-list', 2, function() {
        return Product::paginate(6);
    });

    return view('productlist', [
        'product' => $product
    ]);
})->name("ProductList");


Route::get('/dashboard', function () {
    return view('dashboard');
})->name("Dashboard")->middleware('auth');


Route::get('/blog', function () {
    $blog = Cache::remember('blog-list', 2, function () {
        return Blog::paginate(2);
    });

    return view('bloglist', [
        'blog' => $blog
    ]);
})->name("BlogList");


Route::get('/product/{id}', function ($id) {
    $key = "product-" . strval($id);

    $product = Cache::remember($key, 180, function () use ($id) {
        return Product::find($id);
    });

    return view('product', [
        'product' => $product
    ]);
})->name('Product')->whereNumber('id');


// Login Route

Route::get('/auth/logout', [UsersController::class, 'Logout'])->name("Logout");

Route::get('/auth/login', [UsersController::class, 'LoginView'])->name("Login");
Route::get('/auth/register', [UsersController::class, 'RegisterView'])->name("Register");

Route::post('/auth/login/post', [UsersController::class, 'Login'])->name("PostLogin");
Route::post('/auth/register/post', [UsersController::class, 'Register'])->name("PostRegister");
