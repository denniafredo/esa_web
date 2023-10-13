<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;

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
    Route::get('/', function () {
        return view('dashboard');
    });
//    Route::get('/employee', function () {
//        return view('employee/view');
//    });
//
//    Route::get('/employee/detail/{id}', function () {
//        return view('employee/detail');
//    });
//
//    Route::get('/employee/add', function () {
//        return view('employee/add');
//    });
//
//    Route::get('/employee/{id}', function () {
//        return view('employee/edit');
//    });
    Route::resource('employee', EmployeeController::class);

    Route::get('/absence', function () {
        return view('absence/view');
    });

    Route::get('/benefit', function () {
        return view('benefit/view');
    });

    Route::get('/benefit/detail/{id}', function () {
        return view('benefit/detail');
    });
});

