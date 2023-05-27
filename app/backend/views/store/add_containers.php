<?php

use common\models\active_records\Store;
use common\models\active_records\StoreContainer;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var StoreContainer $storeContainer */
/** @var array $storeContainers */
/** @var array $containerIdsAndNames */
/** @var int $storeId */
/** @var Store $store */

$this->title = 'Добавление тары';
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="add-containers">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <h4><?= "Склад {$store->name} город {$store->city->name}" ?></h4>
    <?php Pjax::begin() ?>
    <?php foreach ($storeContainers as $storeContainer): ?>
        <?php $form = ActiveForm::begin() ?>
        <h6><?= $storeContainer->container->name ?></h6>
        <div>Пустая тара: <?= $storeContainer->count_of_empty ?></div>
        <div>Полная тара: <?= $storeContainer->count_of_full ?></div>
        <?= $form->field($storeContainer, 'id')->hiddenInput()->label(false) ?>
        <?= $form->field($storeContainer, 'countContainers')->input('string') ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end() ?>
        <br>
    <?php endforeach; ?>

    <?php Pjax::end() ?>


</div>