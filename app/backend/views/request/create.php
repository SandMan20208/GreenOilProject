<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\active_records\Request $model */
/** @var array $restaurantsIdsAndNames */
/** @var array $usersIdsAndNames */


$this->title = 'Создание заявки';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= HTML::encode($this->title)?></h1>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

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
