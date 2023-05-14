<?php

namespace frontend\controllers;

use common\models\active_records\Request;
use common\models\active_records\Withdrawal;
use yii\base\Controller;

class RequestController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index',[]);
    }
}