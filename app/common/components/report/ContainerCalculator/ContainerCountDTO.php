<?php

namespace common\components\report\ContainerCalculator;

class ContainerCountDTO
{
    public string $storeName = '';
    public string $cityName = '';
    public int $countEmptyContainers = 0;
    public int $countFullContainers = 0;
}