<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisbursementController;
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



Route::get('/', [DisbursementController::class, 'homePage'])->name('home');
Route::prefix('disbursement')->group(function () {
    Route::get('/check/{id}', [DisbursementController::class, 'checkDisbursement'])->name('check-disbursement');
    Route::get('', [DisbursementController::class, 'formDisbursement'])->name('form-disbursement');
    Route::post('', [DisbursementController::class, 'sendDisbursement'])->name('send-disbursement');
});
