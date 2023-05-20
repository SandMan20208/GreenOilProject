<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\active_records\Container $model */

$this->title = 'Добавить тару';
$this->params['breadcrumbs'][] = ['label' => 'Containers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
