<?php

namespace backend\controllers;

use common\models\active_records\City;
use common\models\active_records\Container;
use common\models\active_records\Store;
use common\models\active_records\StoreContainer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreController implements the CRUD actions for Store model.
 */
class StoreController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Store models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Store::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddContainers($storeId)
    {
        if ($this->request->isPost) {
            $storeContainer = StoreContainer::findOne($this->request->post('StoreContainer')['id']);
            if ($storeContainer) {
                $storeContainer->load($this->request->post());
                $storeContainer->addContainers();
                $storeContainer->save();
            }
        }
        $store = Store::findOne($storeId);

        if (!$store) {
            //TODO Сделать сообщение о том, что склад не найден
            return $this->redirect('index');
        }

        $storeContainers = $store->storeContainers;
        $containerIdsAndNames = Container::getContainersIdsAndNames();
        return $this->render('add_containers', [
            'storeContainers' => $storeContainers,
            'containerIdsAndNames' => $containerIdsAndNames,
            'store' => $store,
        ]);
    }

    /**
     * Displays a single Store model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Store model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Store();
        $cityIdsAndNames = City::getCityIdsAndNames();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'cityIdsAndNames' => $cityIdsAndNames,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cityIdsAndNames = City::getCityIdsAndNames();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cityIdsAndNames' => $cityIdsAndNames,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Store model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Store the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Store::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
