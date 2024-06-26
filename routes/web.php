<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleWebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeadOfficeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWebController;
use App\Http\Controllers\SalesExecutiveController;
use App\Http\Controllers\SocialMediaController;
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
Route::resource('productweb', ProductWebController::class);
Route::resource('articleweb', ArticleWebController::class);
Route::resource('customer', CustomerController::class);

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('/company-profile', CompanyProfileController::class);
    Route::resource('/article', ArticleController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/head-office', HeadOfficeController::class);
    Route::resource('/sales-executive', SalesExecutiveController::class);
    Route::resource('/about', AboutController::class);
    Route::resource('/sosmed', SocialMediaController::class);
    Route::get('/categories/{brandId}', [ProductController::class, 'getCategoriesByBrand'])->name('categories.byBrand');
});

