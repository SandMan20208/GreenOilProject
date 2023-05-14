<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/** @var yii\web\View $this */
/** @var common\models\active_records\Request $model */
/** @var array $restaurantsIdsAndNames */
/** @var array $usersIdsAndNames */


$this->title = 'Создание заявки';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">

    <div class="request-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'restaurant_id')
            ->dropDownList($restaurantsIdsAndNames, ['prompt' => 'Выберите заведение...'])
            ->label('Заведение') ?>

        <?= $form->field($model, 'user_id')
            ->dropDownList($usersIdsAndNames, ['prompt' => 'Выберите исполнителя...'])
            ->label('Исполнитель') ?>

        <?= $form->field($model, 'planned_visit_date')
            ->textInput(['type' => 'datetime-local']) ?>

        <?= $form->field($model, 'comment')
            ->textarea(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
