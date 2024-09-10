<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoryController;

Route::get('/', function (){
    return redirect()->route('dashboard.index');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('forgot-password', [LoginController::class, 'forgotPasswordPage'])->name('forgot-password');
Route::post('otp-send', [LoginController::class, 'forgotPassword'])->name('otp-send');

Route::get('otp', [LoginController::class, 'otpPage'])->name('otp');
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('verify-otp');

Route::get('/change-password', [LoginController::class, 'passwordChange'])->name('change-password');
Route::post('/password-change', [LoginController::class, 'changePassword'])->name('password-change');

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::resources([
        'dashboard' => DashboardController::class,
    ]);
});
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/main', [ProductController::class, 'main'])->name('main');
Route::get('/get-products', [ProductController::Class, 'getProducts']);
Route::get('/get-categories', [ProductController::class, 'getCategories']);
Route::get('/get-subcategories', [ProductController::class, 'getSubcategories']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/product-data', [MainController::class, 'index']);