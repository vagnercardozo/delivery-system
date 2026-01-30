<?php

namespace Main\Http\Controllers;

use Application\UseCases\Restaurant\CreateRestaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Main\Http\Requests\Restaurant\StoreRestaurantRequest;

class RestaurantController extends Controller
{
    public function store(StoreRestaurantRequest $request, CreateRestaurant $useCase): JsonResponse
    {
        $restaurant = $useCase->execute($request->validated());

        return response()->json($restaurant->toArray(), 201);
    }
}
