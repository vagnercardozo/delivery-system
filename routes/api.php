<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::apiResource('restaurants', RestaurantController::class);
Route::apiResource('categories', CategoryController::class);
