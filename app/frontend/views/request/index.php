<?php

use common\models\active_records\Withdrawal;
use yii\widgets\ActiveForm;

/** @var Withdrawal $withdrawalForm */
?>
<h1>Здесь будет функционал курьера</h1>

<?php
$form = ActiveForm::begin([
    'id' => 'withdrawal-form',
    'options' => ['class' => 'form-horizontal'],])
?>

<?= $form->field($withdrawalForm, 'containers_given') ?>
<?= $form->field($withdrawalForm, 'containers_taken') ?>
<?= $form->field($withdrawalForm, 'weight_in_kg') ?>


<?php ActiveForm::end() ?>
