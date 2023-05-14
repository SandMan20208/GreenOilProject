<?php

/** @var \yii\web\View $this */

/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
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
    <body class="flex-container h-100">
    <div class="nav-container">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 250px; height: 100%">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">GreenOil</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <?= Html::a('Главная', ['admin/index'], ['class' => 'nav-link text-white nav-hover']) ?>
                </li>
                <li>
                    <?= Html::a('Заявки', ['request/index'], ['class' => 'nav-link text-white nav-hover']) ?>
                </li>
                <li>
                    <?= Html::a('Склады', ['request/index'], ['class' => 'nav-link text-white nav-hover']) ?>
                </li>
                <li>
                    <?= Html::a('Тара', ['container/index'], ['class' => 'nav-link text-white nav-hover']) ?>
                </li>
                <li>
                    <?= Html::a('Заведения', ['restaurant/index'], ['class' => 'nav-link text-white nav-hover']) ?>
                </li>
                <li>
                    <?= Html::a('Города', ['cities/index'], ['class' => 'nav-link text-white nav-hover']) ?>
                </li>
                <li>
                    <?= Html::a('Пользователи', ['users/index'], ['class' => 'nav-link text-white nav-hover']) ?>
                </li>
                <li>
                    <?= Html::a('Отчеты', ['users/index'], ['class' => 'nav-link text-white nav-hover']) ?>
                </li>
            </ul>
        </div>
    </div>
    <?php $this->beginBody() ?>
    <div class="main-container">
        <?= $content ?>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
