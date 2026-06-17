<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\GoldCoinController;
use App\Http\Controllers\CashfreeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdvertisementController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Route::middleware('auth')->group(function () {
//     Route::get('/', function () {
//     return view('index')->name('home');
// });
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'viewhome'])->name('home');
    Route::get('/sold-products', [ProductController::class, 'soldproducts'])->name('sold-products');
    Route::get('/add-products', [ProductController::class, 'addproducts'])->name('add-product');
    Route::get('/productsedit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/myproducts', [ProductController::class, 'myproducts'])->name('my-products');
    Route::get('/mystore', [ProductController::class, 'mystore'])->name('my-store');
    Route::get('/my-transactions', [TransactionsController::class, 'mytransactions'])->name('my-transactions');
    Route::get('/my-orders', [OrderController::class, 'myorders'])->name('my-orders');
    Route::get('/get-subcategories/{id}', [ProductController::class, 'getSubcategories']);
    Route::get('/productdetail/{id}', [ProductController::class, 'productdetail']);
    Route::post('/add-product', [ProductController::class, 'store'])->name('product.store');
    Route::post('/update-product/{id}', [ProductController::class, 'store'])->name('product.update');
    Route::post('/productsdelete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/wallet', [GoldCoinController::class, 'index'])->name('wallet');
    Route::post('/wallet/pay', [CashfreeController::class, 'createOrder'])->name('wallet.pay');
    Route::post('/price-window-gold/{pid}', [ProductController::class, 'goldcoin'])->middleware('auth');
    Route::post('/price-window-ads/{productId}', [ProductController::class, 'adsCoin']);
    Route::post('/price-window-two', [ProductController::class, 'hitSecondAPI']);
    Route::post('/use-purple-coin', [ProductController::class, 'usePurpleCoin']);
    Route::get('/cashfree/return', [CashfreeController::class, 'return'])->name('cashfree.return');
    Route::post('/cashfree/notify', [CashfreeController::class, 'notify'])->name('cashfree.notify');

    //ads routes
    Route::post('/ads/click', [AdvertisementController::class, 'clickAd'])->name('ads.click');
    Route::get('/myproduct', function () {
        return view('myproduct');
    });
    Route::get('/new-product', function () {
        return view('addproduct');
    });
    Route::get('/order', function () {
        return view('order');
    });


    Route::get('/ads/packages', [AdvertisementController::class, 'packages'])->name('ads.packages');
    Route::get('/ads/index', [AdvertisementController::class, 'index'])->name('ads.index');
    Route::get('/ads/create', [AdvertisementController::class, 'create'])->name('ads.create');
    Route::post('/ads/store', [AdvertisementController::class, 'store'])->name('ads.store');
    Route::post('/ads/pay', [AdvertisementController::class, 'pay'])->name('ads.pay');
    Route::get('/ads/payment-return', [AdvertisementController::class, 'paymentReturn'])->name('ads.payment.return');
    // Route::get('/ads/{id}', [AdvertisementController::class, 'show'])->name('ads.show');
    Route::get('/ads/update/{id}', [AdvertisementController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/edit/{id}', [AdvertisementController::class, 'update'])->name('ads.update');
    Route::delete('/ads/delete/{id}', [AdvertisementController::class, 'destroy'])->name('ads.destroy');


    Route::get('/ads/dashboard', [AdvertisementController::class, 'adsdashboard'])->name('ads.dash');
    Route::get('/show-ad/{slot}', [AdvertisementController::class, 'showAd'])
        ->name('ads.showAd');
    Route::get('/ads/{id}/analytics', [AdvertisementController::class, 'analytics'])
        ->name('ads.analytics');
    Route::post('/complete-task', [AdvertisementController::class, 'completeTask'])
        ->name('ads.completeTask');

    // Route::get('about-us',[HomeController],'')->name();
    // Route::get('faq',[],'')->name();
    // Route::get('buyer',[],'')->name();
    // Route::get('executive',[],'')->name();
    // Route::get('seller',[],'')->name();
});



Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('adminlogin');

    Route::post('/registration', [AdminAuthController::class, 'registration'])
        ->name('registration');

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

        // Category routes
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::post('/categorysave', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/deletecat/{id}', [CategoryController::class, 'destroy'])->name('delete.cat');

        Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('admin.subcategory');
        Route::post('/subcategorysave', [SubCategoryController::class, 'store'])->name('subcategories.store');
        Route::delete('/deletesubcat/{id}', [SubCategoryController::class, 'destroy'])->name('delete.subcat');

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // Points Package routes
        Route::resource('pointspackage', PackageController::class);
        Route::delete('delete-package/{id}', [PackageController::class, 'destroy'])->name('delete.package');


        // User management routes
        // User management routes
        // User management routes
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{userId}/profile', [UserController::class, 'show'])->name('users.profile');
        Route::get('/users/{userId}/profile/edit', [UserController::class, 'edit'])->name('users.profile.edit');
        Route::put('/users/{userId}/profile', [UserController::class, 'update'])->name('users.profile.update');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::put('/users/{id}/role', [UserController::class, 'updateRole'])->name('users.update.role');
        Route::put('/users/{id}/points', [UserController::class, 'updatePoints'])->name('users.update.points');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
