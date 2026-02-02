<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Product::query()->paginate();
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $restaurant = Product::query()->create($request->validated());

        return response()->json($restaurant, 201);
    }

    public function show(Product $restaurant): Product
    {
        return $restaurant;
    }

    public function update(UpdateProductRequest $request, Product $restaurant): JsonResponse
    {
        $restaurant->update($request->validated());

        return response()->json($restaurant);
    }

    public function destroy(Product $restaurant): JsonResponse
    {
        $restaurant->delete();

        return response()->json([], 204);
    }
}
