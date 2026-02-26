<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::post('registerSave',[UserController::class,'register'])->name('registerSave');
Route::post('loginMatch',[UserController::class,'login'])->name('loginMatch');

Route::middleware('auth')->group(function () {
    Route::get('dashboard',[UserController::class,'dashboardPage'])->name('dashboard');
    Route::post('logout',[UserController::class,'logout'])->name('logout');
});
