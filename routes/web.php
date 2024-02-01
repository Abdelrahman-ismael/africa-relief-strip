<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\FormPaymentController;
use App\Http\Controllers\Payment\SessionPaymentController;

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


Route::group(['prefix' => 'payment'], function () {

    Route::group(['prefix' => 'form'], function () {
        Route::get('/', [FormPaymentController::class, 'showPaymentForm'])->name('payment.form');
        Route::post('/process', [FormPaymentController::class, 'processPayment'])->name('payment.process');
        Route::get('/success', [FormPaymentController::class, 'paymentSuccess'])->name('payment.success');
    });

    Route::group(['prefix' => 'session'], function () {
        Route::get('/', [SessionPaymentController::class, 'showSessionPaymentForm'])->name('session.payment.form');
        Route::post('/process', [SessionPaymentController::class, 'processSessionPayment'])->name('session.payment.process');
        Route::get('/success', [SessionPaymentController::class, 'sessionPaymentSuccess'])->name('session.payment.success');
        Route::get('/cancel', [SessionPaymentController::class, 'sessionPaymentCancel'])->name('session.payment.cancel');
    });

});
