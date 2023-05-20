<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\active_records\Restaurant $model */
/** @var array $cityIdsAndNames */

$this->title = 'Редактировать заведение: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="restaurant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?= $this->render('_form', [
        'model' => $model,
        'cityIdsAndNames' => $cityIdsAndNames,
    ]) ?>

</div>
