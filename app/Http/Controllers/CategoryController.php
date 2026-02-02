<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Category::query()->paginate();
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $restaurant = Category::query()->create($request->validated());

        return response()->json($restaurant, 201);
    }

    public function show(Category $restaurant): Category
    {
        return $restaurant;
    }

    public function update(UpdateCategoryRequest $request, Category $restaurant): JsonResponse
    {
        $restaurant->update($request->validated());

        return response()->json($restaurant);
    }

    public function destroy(Category $restaurant): JsonResponse
    {
        $restaurant->delete();

        return response()->json([], 204);
    }
}
