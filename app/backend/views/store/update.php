<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\active_records\Store $model */
/** @var array $cityIdsAndNames */

$this->title = 'Редактировать склад: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cityIdsAndNames' => $cityIdsAndNames,
    ]) ?>

</div>
