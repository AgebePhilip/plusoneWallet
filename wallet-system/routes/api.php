<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes (Require authentication via Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Wallet-related routes
    Route::post('wallet/create', [WalletController::class, 'createWallet']);
    Route::post('wallet/credit', [WalletController::class, 'creditWallet']);
    Route::post('wallet/transfer', [TransactionController::class, 'transfer']);
    Route::post('wallet/transfer/{transaction}/approve', [TransactionController::class, 'approveTransfer']);

    // Admin summary route
    Route::get('admin/summary', [AdminController::class, 'monthlySummary']);
});
