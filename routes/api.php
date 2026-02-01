<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

Route::apiResource('restaurants', RestaurantController::class);
