<?php

/** @var yii\web\View $this */

/** @var LoginForm $loginForm */

use common\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],])
?>
<div class="site-index">
    <div class="form-auth_field-center">
        <img src="/image/greenOil.png" alt="Эмблема Green Oil" class="mt-2 mb-2">
        <?= $form->field($loginForm, 'username') ?>
        <?= $form->field($loginForm, 'password')->passwordInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Вход', ['class' => 'btn btn-primary w-100 mt-3']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
