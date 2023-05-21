<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\UserWidget;
use common\models\active_records\User;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;

AppAsset::register($this);
$user = User::findOne(Yii::$app->user->getId());
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<nav class="navbar navbar-dark bg-dark">
    <div class="navbar-brand brand-name">GreenOil</div>
    <?= UserWidget::widget(['user' => $user]) ?>
</nav>
<main role="main" class="flex-shrink-0">

        <?= $content ?>

</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; GreenOil</p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
