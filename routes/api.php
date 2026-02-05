<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\WebhookOrderController;
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

Route::post('/webhooks/orders/new', [WebhookOrderController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('restaurants')->group(function () {
        Route::get('/', [RestaurantController::class, 'index']);
        Route::post('/', [RestaurantController::class, 'store']);
        Route::get('/{restaurant}', [RestaurantController::class, 'show'])->middleware('can:view,restaurant');
        Route::put('/{restaurant}', [RestaurantController::class, 'update'])->middleware('can:update,restaurant');
        Route::delete('/{restaurant}', [RestaurantController::class, 'destroy'])->middleware('can:delete,restaurant');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category}', [CategoryController::class, 'show'])->middleware('can:view,category');
        Route::put('/{category}', [CategoryController::class, 'update'])->middleware('can:update,category');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->middleware('can:delete,category');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/{product}', [ProductController::class, 'show'])->middleware('can:view,product');
        Route::put('/{product}', [ProductController::class, 'update'])->middleware('can:update,product');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->middleware('can:delete,product');
    });

    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/{order}', [OrderController::class, 'show'])->middleware('can:view,order');
        Route::patch('/{order}/status', [OrderController::class, 'changeStatus'])->middleware('can:update,order');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->middleware('can:delete,order');
    });
});
