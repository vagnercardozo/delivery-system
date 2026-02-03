<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    $user = User::query()->where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }
    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'token' => $token,
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->middleware('can:view,restaurant');
    Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])->middleware('can:update,restaurant');
    Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->middleware('can:delete,restaurant');

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->middleware('can:view,category');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->middleware('can:update,category');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware('can:delete,category');

    Route::get('/products', [CategoryController::class, 'index']);
    Route::post('/products', [CategoryController::class, 'store']);
    Route::get('/products/{product}', [CategoryController::class, 'show'])->middleware('can:view,product');
    Route::put('/products/{product}', [CategoryController::class, 'update'])->middleware('can:update,product');
    Route::delete('/products/{product}', [CategoryController::class, 'destroy'])->middleware('can:delete,product');
});
