<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BankController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\StatusController;
use App\Http\Controllers\Backend\FundTypeController;
use App\Http\Controllers\Backend\MerchantController;
use App\Http\Controllers\Backend\FundStatusController;
use App\Http\Controllers\Backend\BusinessTypeController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\BusinessCategoryController;
use App\Http\Controllers\Backend\VerificationStatusController;
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

Auth::routes(['register' => 0]);

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

    Route::group(['prefix' => 'services'], function () {
        Route::group(['prefix' => 'businesses', 'as' => 'businesses.'], function () {
            Route::resource('types', BusinessTypeController::class)->except(['show'])->parameters(['types' => 'id']);
            Route::resource('categories', BusinessCategoryController::class)->except(['show'])->parameters(['categories' => 'id']);
        });

        Route::resource('statuses', StatusController::class)->except(['show'])->parameters(['statuses' => 'id']);

        Route::group(['prefix' => 'verification', 'as' => 'verification.'], function () {
            Route::resource('statuses', VerificationStatusController::class)->except(['show'])->parameters(['statuses' => 'id']);
        });
    });

    Route::get('merchants/{id}/verifications', [MerchantController::class, 'showVerificationStatusView'])->name('merchants.verifications.edit');
    Route::put('merchants/{id}/verifications', [MerchantController::class, 'updateVerificationStatus'])->name('merchants.verifications.update');
    Route::resource('merchants', MerchantController::class)->parameters(['merchants' => 'id']);

    Route::resource('banks', BankController::class)->except(['show'])->parameters(['banks' => 'id']);
    
    Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {
        Route::resource('methods', PaymentMethodController::class)->except(['show'])->parameters(['methods' => 'id']);
    });

    Route::group(['prefix' => 'funds', 'as' => 'funds.'], function () {
        Route::resource('types', FundTypeController::class)->except(['show'])->parameters(['types' => 'id']);
        Route::resource('statuses', FundStatusController::class)->except(['show'])->parameters(['statuses' => 'id']);
        Route::group(['prefix' => 'purchases', 'as' => 'purchases.'], function () {
            Route::resource('statuses', FundStatusController::class)->except(['show'])->parameters(['statuses' => 'id']);
        });
    });  
});

