<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\active_records\Container $model */

$this->title = 'Update Container: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Containers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
