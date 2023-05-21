<?php
/** @var yii\web\View $this */
/**@var int $requestId */
/**@var  RequestContainer $requestContainer*/
/**@var  array $containerIdsAndNames*/

use common\models\active_records\RequestContainer;
use yii\bootstrap5\Html;

?>

<div class="mobile-container">
    <div class="request_container">
        <div class="request_id">
            <h2>Заявка №<?= $requestId ?></h2>
        </div>
        <div class="request_close_form_container">
            <?= $this->render('_form', [
                'requestContainer' => $requestContainer,
                'containerIdsAndNames' => $containerIdsAndNames,
                'requestId' => $requestId,
            ]) ?>
        </div>
        <div class="request-button-group">
            <?= Html::a('Добавить тару', ['request/view', 'id' => $requestId], ['class' => 'btn btn-secondary'])?>
            <?= Html::a('Назад', ['request/view', 'id' => $requestId], ['class' => 'btn button_close'])?>
        </div>
    </div>

</div>
<div class="request-button-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success request-close-button', 'form' => 'close-form']) ?>
</div>

