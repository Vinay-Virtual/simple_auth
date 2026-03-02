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
Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [UserController::class, 'showEmailVerificationNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [UserController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [UserController::class, 'sendVerificationEmail'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('dashboard',[UserController::class,'dashboardPage'])->middleware('verified')->name('dashboard');
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change.update');
    Route::post('logout',[UserController::class,'logout'])->name('logout');
});
