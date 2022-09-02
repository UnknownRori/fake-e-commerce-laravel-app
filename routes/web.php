<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ImageManagementController;
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

// Dashboard route

Route::prefix('/dashboard')->group(function () {

    Route::post('/createblog', [BlogController::class, "Create"])
        ->name("PostCreateBlog")
        ->middleware('auth');

    Route::get('/listownedblog', [BlogController::class, 'ListOwnedBlog'])
        ->name("OwnedBlog")
        ->middleware('auth');

    Route::get('/listallblog', [BlogController::class, 'AllBlogList'])
        ->name("AllBloglist")
        ->middleware('auth');

    Route::get('/createblog', [BlogController::class, "Form"])
        ->name("CreateBlog")
        ->middleware('auth');

    Route::get('/listownedproduct', [ProductController::class, "OwnedProduct"])
        ->name("OwnedProduct")
        ->middleware('auth');

    Route::get('/listallproduct', [ProductController::class, "AllProductList"])
        ->name("AllProductList")
        ->middleware('auth');

    Route::get('/createproduct', [ProductController::class, "Form"])
        ->name("CreateProduct")
        ->middleware('auth');

    Route::post('/createproduct', [ProductController::class, "Create"])
        ->name("PostCreateProduct")
        ->middleware('auth');

    // Join Vendor
    Route::post('/joinvendor', [UsersController::class, 'JoinVendor'])
        ->name("JoinVendor")
        ->middleware('auth');

    // Image Management
    Route::get('/imagemanagement', [ImageManagementController::class, "Index"])
        ->name("ImageManagement")
        ->middleware('auth');

    Route::prefix('/imagemanagement')->group(function () {
        Route::get('/upload', [ImageManagementController::class, "View"])
            ->name("Image")
            ->middleware('auth');

        Route::post('/upload', [ImageManagementController::class, "Create"])
            ->name("UploadImage")
            ->middleware('auth');

        Route::delete('/delete', [ImageManagementController::class, "Delete"])
            ->name("DeleteImage")
            ->middleware('auth');
    });
});


// User Route

Route::prefix('/user')->group(function () {
    Route::get('/purchasehistory', [PurchaseController::class, "Index"])
        ->name("PurchaseIndex")
        ->middleware("auth");

    Route::get('/{users_id}', [UsersController::class, 'GetUser'])
        ->name("User")
        ->whereNumber('users_id');

    Route::get('/{users_id}/setting', [UsersController::class, 'Setting'])
        ->name("UserSetting")
        ->whereNumber('users_id')
        ->middleware('auth');

    Route::post('/{users_id}/setting', [UsersController::class, 'UpdateSetting'])
        ->name("UpdateSetting")
        ->whereNumber('users_id')
        ->middleware('auth');

    Route::delete('/{users_id}/delete', [UsersController::class, 'Delete'])
        ->name("UserDelete")
        ->whereNumber('users_id')
        ->middleware('auth');

    Route::get('/', [UsersController::class, 'Index'])
        ->name("UsersList")
        ->middleware('auth');

    Route::get('/createusers', [UsersController::class, 'CreateView'])
        ->name("CreateUsersView")
        ->middleware('auth');

    Route::post('/createusers', [UsersController::class, 'Create'])
        ->name("CreateUsers")
        ->middleware('auth');
});

// Reviews Route

Route::prefix('/product')->group(function () {

    Route::post('/{id}/editproduct', [ProductController::class, "Update"])
        ->name("PostEditProduct")
        ->middleware('auth')
        ->whereNumber('id');

    Route::delete('/{id}/deleteproduct', [ProductController::class, "Delete"])
        ->name("DeleteProduct")
        ->middleware('auth')
        ->whereNumber('id');

    Route::post('/{id}/purchase', [PurchaseController::class, "Create"])
        ->name("Purchase")
        ->whereNumber('id')
        ->middleware('auth');

    Route::get('/', [ProductController::class, 'ProductList'])
        ->name("ProductList");

    Route::get('/{id}', [ProductController::class, "Product"])
        ->name('Product')
        ->whereNumber('id');

    Route::get('/{id}/editproduct', [ProductController::class, "Form"])
        ->name("EditProduct")
        ->middleware('auth')
        ->whereNumber('id');

    Route::middleware('auth')->group(function () {
        Route::post('/{product_id}/createreviews', [ReviewsController::class, "Create"])
            ->name("CreateReviews")
            ->whereNumber('product_id');

        Route::delete('/{product_id}/{reviews_id}/deletereviews', [ReviewsController::class, 'Delete'])
            ->name("ReviewsDelete")
            ->whereNumber(['product_id', 'reviews_id']);

        Route::post('/{product_id}/{reviews_id}/updatereviews', [ReviewsController::class, 'Update'])
            ->name("UpdateReviews")
            ->whereNumber(['product_id', 'reviews_id']);
    });
});

// Subscribe Route

Route::prefix('subscribe')->group(function () {
    Route::get('/', [SubscribeController::class, 'Index'])
        ->name("SubscribeList")
        ->middleware('auth');

    Route::post('/register', [SubscribeController::class, 'Create'])
        ->name("Subscribe");


    Route::delete('/{id}/delete', [SubscribeController::class, 'Delete'])
        ->name("DeleteSubscribe")
        ->middleware('auth')
        ->whereNumber('id');
});

// Purchase Route


Route::delete('/purchase/{purchase_id}/deletepurchase', [PurchaseController::class, "Delete"])
    ->name("DeletePurchase")
    ->middleware("auth");

// User Route

// Blog Route

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'BlogList'])
        ->name("BlogList");

    Route::get('/{id}', [BlogController::class, 'Blog'])
        ->name('Blog')
        ->whereNumber('id');

    Route::get('/{id}/editblog', [BlogController::class, "Form"])
        ->name("EditBlog")
        ->middleware('auth')
        ->whereNumber('id');

    Route::post('/{id}/editblog', [BlogController::class, "Update"])
        ->name("PostEditBlog")
        ->middleware('auth')
        ->whereNumber('id');

    Route::delete('/{id}/deleteblog', [BlogController::class, "Delete"])
        ->name("DeleteBlog")
        ->middleware('auth')
        ->whereNumber('id');
});

// Login Route

Route::prefix('/auth')->group(function () {
    Route::get('/logout', [UsersController::class, 'Logout'])
        ->name("Logout");

    Route::get('/login', [UsersController::class, 'LoginView'])
        ->name("Login");
    Route::get('/register', [UsersController::class, 'RegisterView'])
        ->name("Register");

    Route::post('/login/post', [UsersController::class, 'Login'])
        ->name("PostLogin");
    Route::post('/register/post', [UsersController::class, 'Register'])
        ->name("PostRegister");
});
