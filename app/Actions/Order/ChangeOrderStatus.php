<?php

namespace App\Actions\Order;

use App\Models\Order;
use DomainException;

class ChangeOrderStatus
{
    private array $allowedTransitions = [
        'pending' => ['confirmed', 'canceled'],
        'confirmed' => ['preparing', 'canceled'],
        'preparing' => ['delivered'],
    ];

    public function handle(Order $order, string $newStatus): Order
    {
        $current = $order->status;

        if (!isset($this->allowedTransitions[$current]) || !in_array($newStatus, $this->allowedTransitions[$current])) {
            throw new DomainException(
                "Cannot change status from {$current} to {$newStatus}"
            );
        }

        $order->update(['status' => $newStatus]);

        return $order;
    }
}
