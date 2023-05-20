<?php

use common\models\active_records\Request;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\active_records\Request $model */

$this->title = "Заявка №{$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "Удалить заявку №{$model->id}?",
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'restaurant_id' => [
                'label' => 'Заведение',
                'value' => function ($request) {
                    /** @var Request $request */
                    return $request->restaurant->name;
                }
            ],
            'user_id' => [
                    'label' => 'Исполнитель',
                    'value' => function ($request) {
                        /** @var Request $request */
                        return $request->user->name;
                    }
            ],
            'status_id' => function($request){
                /** @var Request $request */
                return $request->status->status_name;
            },
            'date_created',
            'planned_visit_date',
            'close_date',
            'comment',
        ],
    ]) ?>

</div>
