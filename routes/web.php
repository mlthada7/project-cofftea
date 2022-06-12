<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Models\Review;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
// |
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('user.home', [
//         'title' => 'homepage'
//     ]);
// });

Auth::routes();

// Route::get('/tessnap', [FrontendController::class, 'tesSnap']);

Route::get('/load-cart-data', [CartController::class, 'cartcount']);

Route::get('/', [FrontendController::class, 'index']);

Route::get('/about', [FrontendController::class, 'about']);

Route::get('/products', [FrontendController::class, 'find']);

Route::get('/product/{product:slug}', [FrontendController::class, 'viewProduct']);

Route::get('/categories', [FrontendController::class, 'kategori']);

Route::post('/add-to-cart', [CartController::class, 'store'])->name('add-item');
Route::post('/delete-cart-item', [CartController::class, 'delete'])->name('delete-item');

Route::post('update-cart', [CartController::class, 'update'])->name('update-cart');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart-list');
    Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('checkout');
    // Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/place-order', [CheckoutController::class, 'placeOrder']);

    // Route::post('/payment-gateway', [CheckoutController::class, 'paymentGateway']);

    Route::resource('/profile', ProfileController::class);
    
    Route::post('/add-rating', [RatingController::class, 'add']);
    
    Route::get('/{product:slug}/userreview', [ReviewController::class, 'add']);
    Route::post('/add-review', [ReviewController::class, 'create']);
    Route::get('/edit-review/{product:slug}/userreview', [ReviewController::class, 'edit']);
    Route::put('/update-review', [ReviewController::class, 'update']);

    Route::get('/my-orders', [UserController::class, 'index']);
    Route::get('/orders/{order:id}', [UserController::class, 'viewOrder']);

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard/categories/checkSlug', [CategoryController::class, 'checkSlug']);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard/orders', function() {
        return view('admin.orders.index', [
            'title' => 'Admin Dashboard | Cofftea'
        ]);
    });

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/dashboard/users', [DashboardController::class, 'users']);
    Route::get('/dashboard/users/{id}', [DashboardController::class, 'viewUser']);
    
    Route::get('/dashboard/orders', [OrderController::class, 'index']);
    Route::get('/dashboard/orders/{id}', [OrderController::class, 'view']);
    Route::put('/dashboard/orders/{id}/update', [OrderController::class, 'update'])->name('update-order');


    Route::resource('/dashboard/products', ProductController::class);
    Route::resource('/dashboard/categories', CategoryController::class);

    Route::get('order-list', [OrderController::class, 'orderListAjax']);
    Route::post('search-order', [OrderController::class, 'searchOrder']);

    // Route::get('/dashboard/categories/checkSlug', [CategoryController::class, 'checkSlug']);

    // Route::get('categories', [CategoryController::class, 'index']);
    // Route::get('add-categories', [CategoryController::class, 'add']);
});
