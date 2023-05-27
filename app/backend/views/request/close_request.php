<?php

/** @var array $requestContainers */
/** @var RequestContainer $requestContainer */

/** @var Request $request */

use common\models\active_records\Request;
use common\models\active_records\RequestContainer;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

$this->title = 'Закрытие заявки';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

<h3><?= "Заявка {$request->id}" ?></h3>

<?= DetailView::widget([
    'model' => $request,
    'attributes' => [
        [
            'label' => 'Город',
            'value' => function($request) {
                /** @var Request $request */
                return $request->restaurant->city->name;
            }
        ],
        'restaurant_id' => [
            'label' => 'Заведение',
            'value' => function ($request) {
                /** @var Request $request */
                return $request->restaurant->name;
            }
        ],
        'user_id' => [
            'label' => 'Исполнитель',
            'value' => function ($request) {
                /** @var Request $request */
                return $request->user->name;
            }
        ],
        'status_id' => [
            'label' => 'Статус',
            'value' => function ($request) {
                /** @var Request $request */
                return $request->status->status_name;
            }
        ],
        'date_created',
        'planned_visit_date',
        'comment',
    ],
]) ?>

<h3>Движение тары:</h3>
<div class="text-muted">
    (Проверьте информацию по движению тары, при необходимости внесите изменения в поля и нажмите кнопку &laquo;Cохранить
    изменения&raquo;)
</div>

<?php Pjax::begin() ?>
<?php foreach ($requestContainers as $requestContainer): ?>
    <?php $form = ActiveForm::begin(['action' => 'save-request-container']) ?>
    <div class="card p-3 mb-3 mt-3">
        <h5><?= $requestContainer->container->name ?></h5>

        <?= $form->field($requestContainer, 'id')->hiddenInput()->label(false) ?>

        <?= $form->field($requestContainer, 'take')->input('string')->label('Забрано') ?>

        <?= $form->field($requestContainer, 'weight')->input('string')->label('Забрано в кг') ?>

        <?= $form->field($requestContainer, 'volume')->input('string')->label('Забрано в литрах') ?>

        <?= $form->field($requestContainer, 'give')->input('string')->label('Пустой тары оставлено') ?>

        <br>
        <div class="form-group">
            <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php $form::end() ?>
    </div>
<?php endforeach; ?>
<?php $closeForm = ActiveForm::begin(['id' => 'close-request-form']) ?>
<div class="form-group">
    <?= Html::submitButton('Закрыть заявку', ['class' => 'btn btn-success']) ?>
</div>
<?php $closeForm::end() ?>
<?php Pjax::end() ?>
