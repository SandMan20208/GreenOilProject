<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionGetPasswordHash()
    {
        echo Yii::$app->security->generatePasswordHash('123456');
    }

}