<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\active_records\Request $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $restaurantsIdsAndNames */
/** @var array $usersIdsAndNames */
/** @var array $requestStatusesIdsAndNames */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'restaurant_id')->dropDownList($restaurantsIdsAndNames)->label('Заведение') ?>

    <?= $form->field($model, 'user_id')->dropDownList($usersIdsAndNames)->label('Исполнитель') ?>

    <?= $form->field($model, 'status_id')->dropDownList($requestStatusesIdsAndNames)->label('Статус заявки') ?>

    <?= $form->field($model, 'date_created')->input('datetime-local') ?>

    <?= $form->field($model, 'planned_visit_date')->input('datetime-local') ?>

    <?= $form->field($model, 'close_date')->input('datetime-local') ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
