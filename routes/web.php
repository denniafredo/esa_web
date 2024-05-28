<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleWebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('language/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
Route::get('/', [DashboardController::class, 'index']);
Route::resource('dashboard', DashboardController::class);
Route::resource('product', ProductController::class);
Route::resource('articleweb', ArticleWebController::class);
Route::resource('customer', CustomerController::class);

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('/company-profile', CompanyProfileController::class);
    Route::resource('/article', ArticleController::class);
});

