<?php

namespace app\common\components\request;

use common\models\active_records\Request;

interface RequestCreatorInterface
{
    public function create(): bool;
}