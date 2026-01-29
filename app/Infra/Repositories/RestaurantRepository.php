<?php

namespace Infra\Repositories;

use Domain\Entities\Restaurant as DomainRestaurant;
use Domain\Repositories\RestaurantRepository as InterfaceRestaurantRepository;
use Infra\Models\Restaurant;

class RestaurantRepository implements InterfaceRestaurantRepository
{
    public function save(DomainRestaurant $restaurant): DomainRestaurant
    {
        $model = new Restaurant($restaurant->toArray());
        $model->save();

        return $restaurant;
    }
}
