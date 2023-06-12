<?php
?>
<script src="https://www.google.com/jsapi"></script>
<script>
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Месяц', 'Растительное масло'],
            ['Май', 60],
            ['Июнь', 120],
            ['Июль', 180],
            ['Август', 130],
            ['Сентябрь', 110],
            ['Октябрь', 205],
        ]);
        var options = {
            title: 'Сбор масла',
            hAxis: {title: 'Месяц'},
            vAxis: {title: 'Объем масла в литрах'}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('oil'));
        chart.draw(data, options);
    }
</script>
<div id="oil" style="width: 85%; height: 500px;"></div>
