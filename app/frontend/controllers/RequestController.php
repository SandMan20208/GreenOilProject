<?php

namespace frontend\controllers;

use common\models\active_records\Container;
use common\models\active_records\Request;
use common\models\active_records\RequestContainer;
use Yii;
use yii\web\Controller;

class RequestController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index', []);
    }

    public function actionView(int $id)
    {
        $request = Request::findOne($id);

        return $this->render('view', [
            'request' => $request,
        ]);
    }

    public function actionMoveContainers(int $id)
    {
        $requestContainer = new RequestContainer();
        if ($this->request->isPost && $requestContainer->load(Yii::$app->request->post())) {
            $requestContainer->request_id = $id;
            if ($requestContainer->save()) {
                $request = $requestContainer->request;
                $request->executed();
                return $this->redirect('index');
            }
        }

        $containerIdsAndNames = Container::getContainersIdsAndNames();

        return $this->render('close_request', [
            'requestId' => $id,
            'containerIdsAndNames' => $containerIdsAndNames,
            'requestContainer' => $requestContainer,
        ]);
    }
}