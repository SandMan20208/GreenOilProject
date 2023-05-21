<?php

use common\models\active_records\Request;
use yii\helpers\Html;

/** @var Request $request */

$userId = Yii::$app->user->getId();
$requests = Request::getRequestsByUserId($userId);
?>

<div class="mobile-container">
    <h1>Заявки</h1>
    <?php foreach ($requests as $request):?>
    <div class="request_container">
        <div class="request_id">
            <h2>Заявка №<?= $request->id ?></h2>
        </div>
        <div class="request_info">
                <p><b>Заведение:</b> <?= $request->restaurant->name ?></p>
                <p><b>Адрес:</b> <?= $request->restaurant->address ?></p>
                <p><b>Телефон:</b> <a href="tel:"><?= $request->restaurant->contact_phone ?></a></p>
                <p><b>Дата забора:</b> <?= $request->planned_visit_date ?></p>
        </div>
        <div class="request-button-group">
            <?= Html::a('Закрыть', ['request/move-containers', 'id' => $request->id], ['class' => 'btn btn-success'])?>
            <?= Html::a('Информация', ['request/view', 'id' => $request->id], ['class' => 'btn button_close'])?>
        </div>
    </div>
    <?php endforeach; ?>


</div>
