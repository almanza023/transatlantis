< script type = "text/javascript" >
    google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['PROVEEDOR', 'CANTIDAD DE COMPRAS'],
        <?php foreach($providers as $p) { ?> ["<?php echo $p->full_name; ?> ", <?php echo $p->cantidad ?>],
        <?php } ?>
    ]);

    var options = {
        title: 'CANTIDAD DE COMPRAS POR PROVEEDOR',
        width: 380,
        height: 180,
        is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
} < / script>