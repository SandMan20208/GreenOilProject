<?php

namespace backend\controllers;

use common\components\request\RequestCloseProcessor;
use common\components\request\RequestCreator;
use common\models\active_records\Request;
use common\models\active_records\RequestContainer;
use common\models\active_records\RequestStatus;
use common\models\active_records\Restaurant;
use common\models\active_records\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all Request models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Request::find(),
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

    /**
     * Displays a single Request model.
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
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Request();
        $restaurantsIdsAndNames = Restaurant::getRestaurantsIdsAndNames();
        $usersIdsAndNames = User::getUsersIdsAndNames();

        if ($this->request->isPost && $model->load(Yii::$app->request->post())) {
            $requestCreator = new RequestCreator($model);
            if ($requestCreator->create()) {
                Yii::$app->session->setFlash('success', 'Заявка создана успешно.');
            } else {
                Yii::$app->session->setFlash('success', 'Ошибка создания заявки.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'restaurantsIdsAndNames' => $restaurantsIdsAndNames,
            'usersIdsAndNames' => $usersIdsAndNames,
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Заявка создана успешно.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('success', 'Ошибка создания заявки.');
            }
        }

        $restaurantsIdsAndNames = Restaurant::getRestaurantsIdsAndNames();
        $usersIdsAndNames = User::getUsersIdsAndNames();
        $requestStatusesIdsAndNames = RequestStatus::getRequestStatusesIdsAndNames();

        return $this->render('update', [
            'model' => $model,
            'restaurantsIdsAndNames' => $restaurantsIdsAndNames,
            'usersIdsAndNames' => $usersIdsAndNames,
            'requestStatusesIdsAndNames' => $requestStatusesIdsAndNames,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCloseRequest(int $id)
    {
        $request = Request::findOne($id);

        if (!$request) {
            throw new NotFoundHttpException('Заявка не найдена.');
        }

        $requestContainers = $request->requestContainers;

        if ($this->request->isPost) {
            $requestCloseProcessor = new RequestCloseProcessor($request);
            $requestCloseProcessor->process();
            $request->close();
        }


        return $this->render('close_request', [
            'request' => $request,
            'requestContainers' => $requestContainers,
        ]);
    }

    public function actionSaveRequestContainer()
    {
        if ($this->request->isPost) {
            $requestContainer = RequestContainer::findOne($this->request->post('RequestContainer')['id']);
            $requestContainer->load($this->request->post());
            $requestContainer->save();
        }

        return $this->redirect('close-request?id=' . $requestContainer->request_id);
    }

    protected
    function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
