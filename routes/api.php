<?php

use Main\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::prefix('restaurants')->group(function () {
    Route::post('/', [RestaurantController::class, 'store']);
});

