<?php

namespace backend\controllers;

use common\components\report\ContainerCalculator\ContainerCalculator;
use common\components\report\RequestCalculator;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $containerCalculator = new ContainerCalculator();
        $containerCountDtos = $containerCalculator->calculate();
        $requestCalculator = new RequestCalculator();
        $requestCountByMonth = $requestCalculator->calculate();
        return $this->render('index',
        [
            'containerCountDtos' => $containerCountDtos,
            'requestCountByMonth' => $requestCountByMonth,
        ]);
    }
}