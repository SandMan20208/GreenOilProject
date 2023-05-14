<?php

namespace app\common\components\request;

use app\common\components\Utilyty;
use common\models\active_records\Request;
use common\models\active_records\RequestStatus;
use Yii;

class RequestCreator implements RequestCreatorInterface
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(): bool
    {
        $this->request->status_id = RequestStatus::STATUS_NEW_ID;
        $this->request->date_created = (new \DateTime())->format(Utilyty::DATE_FORMAT_MYSQL);
        $this->request->deleted = 0;

        if (!$this->request->save()) {
            return false;
        }

        return true;
    }
}