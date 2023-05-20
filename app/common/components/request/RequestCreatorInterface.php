<?php

namespace common\components\request;

interface RequestCreatorInterface
{
    public function create(): bool;
}