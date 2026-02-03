<?php

namespace App\Actions\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use DomainException;

class ChangeOrderStatus
{
    public function handle(Order $order, OrderStatus $newStatus): Order
    {
        if (!$order->status->canTransitionTo($newStatus)) {
            throw new DomainException(
                "Cannot change status from {$order->status->value} to {$newStatus->value}"
            );
        }

        $order->update(['status' => $newStatus]);

        return $order;
    }
}
