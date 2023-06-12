<?php

namespace console\controllers;

use common\components\report\RequestCalculator;
use common\models\active_records\Request;
use Yii;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionTest()
    {
        $requestCalculator = new RequestCalculator();
        $requestCountByMonth = $requestCalculator->calculate();
        var_dump($requestCountByMonth);
    }

}