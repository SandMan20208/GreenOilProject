<?php
/** @var yii\web\View $this */
/** @var common\models\active_records\City $model */
/** @var array $containerCountDtos */
/** @var string $requestCountByMonth */

?>
<h1>Поступление заявок</h1>
<?= $this->render('charts/request_charts', [
    'requestCountByMonth' => $requestCountByMonth,
]); ?>
<hr>
<h1>Сбор масла</h1>
<?= $this->render('charts/oil_charts'); ?>
<hr>
<h1>Тара</h1>
<?= $this->render('charts/store_charts',
    [
            'containerCountDtos' => $containerCountDtos,
    ]); ?>
