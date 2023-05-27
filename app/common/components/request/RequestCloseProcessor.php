<?php

namespace common\components\request;

use common\models\active_records\Request;
use common\models\active_records\RequestContainer;
use common\models\active_records\Restaurant;
use common\models\active_records\RestaurantContainer;
use common\models\active_records\StoreContainer;

class RequestCloseProcessor
{
    private Request $request;
    private array $requestContainers;
    private Restaurant $restaurant;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->restaurant = $request->restaurant;
        $this->requestContainers = $request->requestContainers;
    }

    public function process(): void
    {
        foreach ($this->requestContainers as $requestContainer) {
            $storeContainer = $this->getStoreContainer($requestContainer);
            $storeContainer->count_of_empty -= $requestContainer->give;
            $storeContainer->count_of_full += $requestContainer->take;
            $storeContainer->save();

            $this->changeRestaurantContainers($requestContainer);
        }
    }

    private function getStoreContainer(RequestContainer $requestContainer): StoreContainer
    {
        return StoreContainer::findOne(['store_id' => $this->request->store_id, 'container_id' => $requestContainer->container_id]);
    }

    private function changeRestaurantContainers(RequestContainer $requestContainer): void
    {
        $restaurantContainer = $this->getOrCreateRestaurantContainers($requestContainer);
        $restaurantContainer->container_count += $requestContainer->give;
        $restaurantContainer->container_count -= $requestContainer->take;
        $restaurantContainer->save();
    }

    private function getOrCreateRestaurantContainers(RequestContainer $requestContainer): RestaurantContainer
    {
        $restaurantContainer = RestaurantContainer::findOne([
            'container_id' => $requestContainer->container_id,
            'restaurant_id' => $this->restaurant->id,
        ]);

        if (!$restaurantContainer) {
            $restaurantContainer = new RestaurantContainer();
            $restaurantContainer->container_id = $requestContainer->container_id;
            $restaurantContainer->restaurant_id = $this->request->restaurant_id;
            $restaurantContainer->container_count = 0;
        }

        return $restaurantContainer;
    }


}