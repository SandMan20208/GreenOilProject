<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\active_records\Request $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $restaurantsIdsAndNames */
/** @var array $usersIdsAndNames */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'restaurant_id')->dropDownList($restaurantsIdsAndNames) ?>

    <?= $form->field($model, 'user_id')->dropDownList($usersIdsAndNames) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'planned_visit_date')->textInput() ?>

    <?= $form->field($model, 'close_date')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
