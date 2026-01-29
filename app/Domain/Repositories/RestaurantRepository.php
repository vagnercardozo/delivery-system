<?php

namespace Domain\Repositories;

use Domain\Entities\Restaurant;

interface RestaurantRepository
{
    public function save(Restaurant $restaurant): Restaurant;
}
