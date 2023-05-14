<?php

use common\models\active_records\Request;
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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
            'status_id' => [
                'label' => 'Статус',
                'value' => function ($request) {
                    /** @var Request $request */
                    return $request->status->status_name;
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
