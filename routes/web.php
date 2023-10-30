<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\HistoryLeaveController;
use App\Http\Controllers\DashboardController;

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

//Route::get('admin-page', function() {
//    return 'Halaman untuk Admin';
//})->middleware('role:admin')->name('admin.page');
//
//Route::get('user-page', function() {
//    return 'Halaman untuk User';
//})->middleware('role:user')->name('user.page');

Auth::routes();

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Rute untuk menangani login dan registrasi
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rute logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/',[DashboardController::class, 'index']);

    Route::resource('employee', EmployeeController::class);
    Route::resource('absence', AbsenceController::class);
    Route::resource('historyLeave', HistoryLeaveController::class);

    Route::get('/benefit', function () {
        return view('benefit/view');
    });

    Route::get('/benefit/detail/{id}', function () {
        return view('benefit/detail');
    });
});

