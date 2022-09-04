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

// Dashboard route

Route::prefix('/dashboard')->middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->name("Dashboard");

    Route::get('/listownedproduct', [ProductController::class, "OwnedProduct"])
        ->name("OwnedProduct");

    Route::get('/listallproduct', [ProductController::class, "AllProductList"])
        ->name("AllProductList");

    Route::get('/createproduct', [ProductController::class, "Form"])
        ->name("CreateProduct");

    Route::post('/createproduct', [ProductController::class, "Create"])
        ->name("PostCreateProduct");

    // Join Vendor
    Route::post('/joinvendor', [UsersController::class, 'JoinVendor'])
        ->name("JoinVendor");

    // Image Management
    Route::prefix('/imagemanagement')->group(function () {
        Route::get('/', [ImageManagementController::class, "Index"])
            ->name("ImageManagement");

        Route::get('/upload', [ImageManagementController::class, "View"])
            ->name("Image");

        Route::post('/upload', [ImageManagementController::class, "Create"])
            ->name("UploadImage");

        Route::delete('/delete', [ImageManagementController::class, "Delete"])
            ->name("DeleteImage");
    });

    Route::middleware('admin')->group(function () {
        Route::post('/createblog', [BlogController::class, "Create"])
            ->name("PostCreateBlog");

        Route::get('/listownedblog', [BlogController::class, 'ListOwnedBlog'])
            ->name("OwnedBlog");

        Route::get('/listallblog', [BlogController::class, 'AllBlogList'])
            ->name("AllBloglist");

        Route::get('/createblog', [BlogController::class, "Form"])
            ->name("CreateBlog");
    });
});


// User Route

Route::prefix('/user')->group(function () {
    Route::get('/{user:id}', [UsersController::class, 'GetUser'])
        ->name("User");

    Route::middleware('auth')->group(function () {
        Route::get('/purchasehistory', [PurchaseController::class, "Index"])
            ->name("PurchaseIndex");

        Route::get('/{users_id}/setting', [UsersController::class, 'Setting'])
            ->name("UserSetting")
            ->whereNumber('users_id');

        Route::post('/{users_id}/setting', [UsersController::class, 'UpdateSetting'])
            ->name("UpdateSetting")
            ->whereNumber('users_id');

        Route::delete('/{user:id}/delete', [UsersController::class, 'Delete'])
            ->name("UserDelete");

        Route::get('/', [UsersController::class, 'Index'])
            ->name("UsersList");

        Route::get('/createusers', [UsersController::class, 'CreateView'])
            ->name("CreateUsersView");

        Route::post('/createusers', [UsersController::class, 'Create'])
            ->name("CreateUsers");
    });
});

// Reviews Route

Route::prefix('/product')->group(function () {
    Route::get('/', [ProductController::class, 'ProductList'])
        ->name("ProductList");

    Route::get('/{id}', [ProductController::class, "Product"])
        ->name('Product')
        ->whereNumber('id');


    Route::middleware('auth')->group(function () {
        Route::post('/{id}/editproduct', [ProductController::class, "Update"])
            ->name("PostEditProduct")
            ->whereNumber('id');

        Route::delete('/{id}/deleteproduct', [ProductController::class, "Delete"])
            ->name("DeleteProduct")
            ->whereNumber('id');

        Route::post('/{id}/purchase', [PurchaseController::class, "Create"])
            ->name("Purchase")
            ->whereNumber('id');

        Route::get('/{id}/editproduct', [ProductController::class, "Form"])
            ->name("EditProduct")
            ->whereNumber('id');

        // Reviews

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

// Blog Route

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'BlogList'])
        ->name("BlogList");

    Route::get('/{id}', [BlogController::class, 'Blog'])
        ->name('Blog')
        ->whereNumber('id');

    Route::middleware('auth')->group(function () {
        Route::get('/{id}/editblog', [BlogController::class, "Form"])
            ->name("EditBlog")
            ->whereNumber('id');

        Route::post('/{id}/editblog', [BlogController::class, "Update"])
            ->name("PostEditBlog")
            ->whereNumber('id');

        Route::delete('/{id}/deleteblog', [BlogController::class, "Delete"])
            ->name("DeleteBlog")
            ->whereNumber('id');
    });
});

// Login Route

Route::prefix('/auth')->group(function () {
    Route::post('/logout', [UsersController::class, 'Logout'])
        ->name("Logout")
        ->middleware('auth');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [UsersController::class, 'LoginView'])
            ->name("Login");

        Route::get('/register', [UsersController::class, 'RegisterView'])
            ->name("Register");

        Route::post('/login', [UsersController::class, 'Login'])
            ->name("PostLogin");

        Route::post('/register', [UsersController::class, 'Register'])
            ->name("PostRegister");
    });
});
