<?php

namespace App\Observers;

use App\Models\Restaurant;

class RestaurantObserver
{
    public function creating(Restaurant $restaurant): void
    {
        if (!auth()->check()) return;

        $restaurant->user()->associate(auth()->id());
    }
}
