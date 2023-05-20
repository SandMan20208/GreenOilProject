<?php

use common\models\active_records\Request;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Request $model */
/** @var Request $restaurantsIdsAndNames */
/** @var Request $usersIdsAndNames */
/** @var Request $requestStatusesIdsAndNames */

$this->title = 'Редактирование заявки №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Заявка №' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?= $this->render('_form', [
        'model' => $model,
        'restaurantsIdsAndNames' => $restaurantsIdsAndNames,
        'usersIdsAndNames' => $usersIdsAndNames,
        'requestStatusesIdsAndNames' => $requestStatusesIdsAndNames,
    ]) ?>

</div>
