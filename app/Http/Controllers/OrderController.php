<?php

namespace App\Http\Controllers;

use App\Actions\Order\ChangeOrderStatus;
use App\Actions\Order\CreateOrder;
use App\Enums\OrderStatus;
use App\Http\Requests\Order\ChangeOrderStatusRequest;
use App\Http\Requests\Order\StoreOrderRequest;
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

    public function store(StoreOrderRequest $request, CreateOrder $action): JsonResponse
    {
        $order = $action->handle($request->validated());

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

    public function changeStatus(Order $order, ChangeOrderStatusRequest $request, ChangeOrderStatus $action): JsonResponse
    {
        $order = $action->handle($order, OrderStatus::from($request->status));

        return response()->json($order);
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json([], 204);
    }
}
