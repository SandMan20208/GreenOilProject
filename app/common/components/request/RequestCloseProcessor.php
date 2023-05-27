<?php

namespace common\components\request;

use common\models\active_records\Request;
use common\models\active_records\RequestContainer;
use common\models\active_records\StoreContainer;

class RequestCloseProcessor
{
    private Request $request;
    private array $requestContainers;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->requestContainers = $request->requestContainers;
    }

    public function process(): void
    {
        foreach ($this->requestContainers as $requestContainer) {
            $storeContainer = $this->getStoreContainer($requestContainer);
            $storeContainer->count_of_empty -= $requestContainer->take;
            $storeContainer->count_of_full += $requestContainer->give;
            $storeContainer->save();
        }
    }

    private function getStoreContainer(RequestContainer $requestContainer): StoreContainer
    {
        return StoreContainer::findOne(['store_id' => $this->request->store_id, 'container_id' => $requestContainer->container_id]);
    }


}