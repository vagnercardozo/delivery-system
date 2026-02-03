<?php

namespace App\Http\Controllers;

use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Order::query()->paginate();
    }

    public function store(StoreRestaurantRequest $request): JsonResponse
    {
        $order = Order::query()->create($request->validated());

        return response()->json($order, 201);
    }

    public function show(Order $order): Order
    {
        return $order;
    }

    public function update(UpdateRestaurantRequest $request, Order $order): JsonResponse
    {
        $order->update($request->validated());

        return response()->json($order);
    }

    public function changeStatus(Order $order, Request $request): JsonResponse
    {
        return response()->json(['message' => 'TODO - mudar status']);
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json([], 204);
    }
}
