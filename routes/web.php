<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/employee', function () {
    return view('employee/view');
});
Route::get('/employee/detail/{id}', function () {
    return view('employee/detail');
});
Route::get('/employee/add', function () {
    return view('employee/add');
});
Route::get('/employee/{id}', function () {
    return view('employee/edit');
});

Route::get('/absence', function () {
    return view('absence/view');
});
Route::get('/benefit', function () {
    return view('benefit/view');
});
Route::get('/benefit/detail/{id}', function () {
    return view('benefit/detail');
});
