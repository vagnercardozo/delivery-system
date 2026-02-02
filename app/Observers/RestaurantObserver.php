<?php

namespace App\Observers;

use App\Models\Restaurant;
use Illuminate\Support\Str;

class RestaurantObserver
{
    public function creating(Restaurant $restaurant): void
    {
        if (!empty($restaurant->slug)) return;

        $restaurant->slug = Str::uuid();

    }

    public function created(Restaurant $restaurant): void
    {
        $slug = Str::slug($restaurant->name).'-'.base_convert($restaurant->id, 10, 36);
        $restaurant->slug = $slug;
        $restaurant->saveQuietly();
    }
}
