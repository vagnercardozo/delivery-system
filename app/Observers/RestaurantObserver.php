<?php

namespace App\Observers;

use App\Models\Restaurant;
use Illuminate\Support\Str;

class RestaurantObserver
{
    public function created(Restaurant $restaurant): void
    {
        $slug = Str::slug($restaurant->name).'-'.base_convert($restaurant->id, 10, 36);
        $restaurant->update(['slug' => $slug]);
    }
}
