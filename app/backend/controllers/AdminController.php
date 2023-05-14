<?php

namespace backend\controllers;

class AdminController extends \yii\base\Controller
{
    public function actionIndex() {
        return $this->render('index');
    }
}