<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Preparing = 'preparing';
    case Delivered = 'delivered';
    case Canceled = 'canceled';

    public function canTransitionTo(self $next): bool
    {
        return match ($this) {
            self::Pending => in_array($next, [self::Confirmed, self::Canceled]),
            self::Confirmed => in_array($next, [self::Preparing, self::Canceled]),
            self::Preparing => $next === self::Delivered,
            default => false,
        };
    }
}
