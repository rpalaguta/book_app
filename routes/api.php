<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuctionController;
use App\Http\Controllers\API\TokenController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/auctions', [AuctionController::class, 'index'])->name('api.auctions.index');
    Route::get('/auctions/{id}', [AuctionController::class, 'show'])->name('api.auctions.show');
    Route::post('/auctions', [AuctionController::class, 'store'])->name('api.seller.auctions.create');
    Route::put('/seller/{sellerId}/auctions/{auctionId}', [AuctionController::class, 'update'])->name('api.seller.auctions.update');
});

Route::post('/token', [TokenController::class, 'getToken'])->name('api.auth.token');
