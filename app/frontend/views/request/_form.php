<?php

use common\models\active_records\Request;
use common\models\active_records\RequestContainer;
use yii\bootstrap5\ActiveForm;

/**@var Request $request */
/**@var  RequestContainer $requestContainer*/
/**@var  array $containerIdsAndNames*/
?>

<div class="request_close_form_container">

    <?php $form = ActiveForm::begin(['id' => 'close-form']); ?>

    <?= $form->field($requestContainer, 'container_id')->dropDownList($containerIdsAndNames)->label('Тара') ?>

    <?= $form->field($requestContainer, 'take')->input('text') ?>

    <?= $form->field($requestContainer, 'weight')->input('text') ?>

    <?= $form->field($requestContainer, 'volume')->input('text') ?>

    <?= $form->field($requestContainer, 'give')->input('text') ?>

    <?php ActiveForm::end(); ?>
</div>
