<?php

namespace common\components\report\ContainerCalculator;

use common\models\active_records\Store;

class ContainerCalculator
{
    public function calculate(): array
    {
        return $this->getCountContainersFromStore();
    }

    private function getCountContainersFromStore(): array
    {
        $stores = Store::find()->all();
        $containerCountDtos = [];
        foreach ($stores as $store) {
            $storeContainers = $store->storeContainers;
            $containerCountDto = new ContainerCountDTO();
            $containerCountDto->storeName = $store->name;
            $containerCountDto->cityName = $store->city->name ?? '';
            foreach ($storeContainers as $storeContainer)
            {
                $containerCountDto->countFullContainers += $storeContainer->count_of_full;
                $containerCountDto->countEmptyContainers += $storeContainer->count_of_empty;
            }
            $containerCountDtos[] = $containerCountDto;
        }
        return $containerCountDtos;
    }
}