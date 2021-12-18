<?php

use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('welcome');
})->name("Home");

Route::get('/productlist', function () {

})->name("ProductList");

Route::get('/auth/login', [UsersController::class, 'LoginView'])->name("Login");
Route::get('/auth/register', [UsersController::class, 'RegisterView'])->name("Register");
Route::post('/auth/login/post', [UsersController::class, 'Login'])->name("PostLogin");
