<?php

use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'store']);


Route::prefix('/stocks')->name('stocks.')->middleware(['auth:sanctum', 'abilities:fetch-stocks'])->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('index');
    Route::get('query', [StockController::class, 'query'])->name('query');
    Route::get('current', [StockController::class, 'current'])->name('current');
});
