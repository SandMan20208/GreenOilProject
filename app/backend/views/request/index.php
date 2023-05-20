<?php

use common\components\request\RequestStatusHtmlGenerator;
use common\models\active_records\Request;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= HTML::encode($this->title)?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'status_id' => [
                'format' => 'raw',
                'label' => 'Статус',
                'value' => function ($request) {
                    /** @var Request $request */
                    $requestStatusHtmlGenerator = new RequestStatusHtmlGenerator($request);
                    return $requestStatusHtmlGenerator->generate();
                },
            ],
            'restaurant_id' => [
                'label' => 'Заведение',
                'value' => function ($request) {
                    /** @var Request $request */
                    return $request->restaurant->name;
                },
            ],
            'user_id' => [
                'label' => 'Исполнитель',
                'value' => function ($request) {
                    /** @var Request $request */
                    return $request->user->name;
                },
            ],
            'date_created',
            'planned_visit_date',
            //'close_date',
            //'deleted',
            //'comment',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Request $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>
