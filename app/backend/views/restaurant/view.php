<?php

use common\models\active_records\Restaurant;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var Restaurant $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заведение', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="restaurant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить заведение?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'city_id' => [
                    'label' => 'Город',
                    'value' => function($restaurant){
                        /** @var Restaurant $restaurant */
                        return $restaurant->city->name;
                    }
            ],
            'address',
            'contact_phone',
        ],
    ]) ?>

</div>
