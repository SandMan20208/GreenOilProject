<?php
/** @var string $requestCountByMonth */
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Месяц', 'Кол-во'],
            <?=$requestCountByMonth?>
        ]);

        var options = {
            title: 'Заявки на сбор масла',
            hAxis: {title: 'Месяц',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div id="chart_div" style="width: 85%; height: 500px;"></div>
