<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\Investor\HomeInvestorController;
use App\Http\Controllers\Frontend\Merchant\HomeMerchantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'my', 'as' => 'front.investor.', 'middleware' => ['auth', 'role:investor']], function () {
    Route::get('/home', [HomeInvestorController::class, 'index'])->name('home');
});

Route::group(['prefix' => 'merchant', 'as' => 'front.merchant.', 'middleware' => ['auth', 'role:merchant']], function () {
    Route::get('/home', [HomeMerchantController::class, 'index'])->name('home');
});

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'role:bod|webmaster|admin']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'profiles', 'as' => 'users.profiles.'], function () {
        Route::put('/{id}/email', [UserController::class, 'updateEmail'])->name('update_email');
        Route::put('/{id}/password', [UserController::class, 'updatePassword'])->name('update_password');
        Route::put('/{id}/profile', [UserController::class, 'updateProfile'])->name('update_profile');
    });
    Route::resource('users', UserController::class)->parameters(['users' => 'id']);
});

