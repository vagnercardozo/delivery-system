<?php

namespace App\Http\Controllers;

use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class RestaurantController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Restaurant::query()->paginate();
    }

    public function store(StoreRestaurantRequest $request): JsonResponse
    {
        $restaurant = Restaurant::query()->create($request->validated());

        return response()->json($restaurant, 201);
    }

    public function show(Restaurant $restaurant): Restaurant
    {
        return $restaurant;
    }

    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): JsonResponse
    {
        $restaurant->update($request->validated());

        return response()->json($restaurant);
    }

    public function destroy(Restaurant $restaurant): JsonResponse
    {
        $restaurant->delete();

        return response()->json([], 204);
    }
}
