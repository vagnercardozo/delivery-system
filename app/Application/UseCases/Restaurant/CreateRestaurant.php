<?php

namespace Application\UseCases\Restaurant;

use Domain\Entities\Restaurant;
use Domain\Repositories\RestaurantRepository;

readonly class CreateRestaurant
{
    public function __construct(
        private RestaurantRepository $repository
    ) {}

    public function execute(array $data): Restaurant
    {
        $restaurant = new Restaurant(
            $data['name'],
            $data['slug'],
            $data['opening_time'],
            $data['closing_time']
        );

        return $this->repository->save($restaurant);
    }
}
