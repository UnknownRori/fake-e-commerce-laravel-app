<?php

use App\Http\Controllers\UsersController;
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

    $product = Cache::remember('product', 5, function () {
        return Product::all()->random(6);
    });

    return view('welcome', [
        'product' => $product
    ]);

})->name("Home");

Route::get('/productlist', function () {

})->name("ProductList");

Route::get('/dashboard', function () {
    return view('dashboard');
})->name("Dashboard")->middleware('auth');

Route::get('/blog', function () {
    return view('blog');
})->name("Blog");

// Login Route

Route::get('/auth/logout', [UsersController::class, 'Logout'])->name("Logout");

Route::get('/auth/login', [UsersController::class, 'LoginView'])->name("Login");
Route::get('/auth/register', [UsersController::class, 'RegisterView'])->name("Register");

Route::post('/auth/login/post', [UsersController::class, 'Login'])->name("PostLogin");
Route::post('/auth/register/post', [UsersController::class, 'Register'])->name("PostRegister");
