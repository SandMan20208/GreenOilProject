<?php
use common\components\report\ContainerCalculator\ContainerCountDTO;

/** @var array $containerCountDtos */
/** @var ContainerCountDTO $containerCountDto */

?>
<script src="https://www.google.com/jsapi"></script>
<script>
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Тара', 'Количество'],
            ['Заполненная тара',     78.09],
            ['Чистая тара', 20.95],
        ]);
        var options = {
            title: 'Заполненность складов',
            is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('air'));
        chart.draw(data, options);
    }
</script>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Город</th>
        <th scope="col">Склад</th>
        <th scope="col">Чистая тара</th>
        <th scope="col">Заполненная тара</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($containerCountDtos as $containerCountDto) : ?>
    <tr>
        <td><?= $containerCountDto->cityName?></td>
        <td><?= $containerCountDto->storeName?></td>
        <td><?= $containerCountDto->countEmptyContainers?></td>
        <td><?= $containerCountDto->countFullContainers?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div style="width: 85%;">
    <div id="air" style="width: 800px; height: 500px; margin: 0 auto;"></div>
</div>
