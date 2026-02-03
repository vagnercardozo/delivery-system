<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CreateOrder
{
    public function handle(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $total = 0;

            /** @var Order $order */
            $order = Order::query()->create([
                'restaurant_id' => $data['restaurant_id'],
                'customer_id' => 1,
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($data['items'] as $item) {
                /** @var Product $product */
                $product = Product::query()->findOrFail($item['product_id']);

                $itemTotal = $product->price * $item['quantity'];
                $total += $itemTotal;

                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name_snapshot' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => $item['quantity'],
                    'total_price' => $itemTotal,
                ]);
            }

            $order->update(['total_amount' => $total]);

            return $order->load('items');
        });
    }
}
