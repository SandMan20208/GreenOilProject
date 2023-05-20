<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\active_records\Container $model */

$this->title = 'Редактировать тару: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Тара', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="container-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
