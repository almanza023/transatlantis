<div class="row">
  <div class="col-md-12">
   <center> <h3>REPORTE DE ESTADISTICAS</h3>
    <h4>DESDE: <b>{{ $date1 }}</b> - HASTA <b>{{ $date2 }}</b></h4></center>
  </div>
</div>
<div class="row">
<div class="col-md-6">
    <div  id="estado_pedidos"></div>
</div>
<div class="col-md-6">
    <div id="piechart_3d" style="width: 400px; height: 200px;"></div>
    
</div>

</div>
<div class="row">
    <div class="col-md-6">
        <div id="barchart_values" style="width: 900px; height: 300px;"></div>
    </div>
    <div class="col-md-6">
        <div id="top_x_div" style="width: 800px; height: 600px;"></div>
    </div>
</div>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["ESTADO", "CANTIDAD", { role: "style" } ],
        ["COTIZACIONES", <?php echo $num_cot;?>, "#red"],
        ["PRE-ORDEN", <?php echo $num_pre;?>, "#b87333"],
        ["COMPRA", <?php echo $num_com;?>, "silver"],
        ["AGENDADOS", <?php echo $num_agen;?>, "gold"],
        ["ENTREGADOS", <?php echo $num_ent;?>, "blue: #e5e4e2"],
        ["FACTURADOS", <?php echo $num_fact;?>, "#green"],
      ]);
  
      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
  
      var options = {
        title: "CANTIDAD DE PEDIDOS POR ESTADO",
        width: 380,
        height: 230,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("estado_pedidos"));
      chart.draw(view, options);
  }
  
  
  </script>
  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['PRIORIDAD', 'CANTIDAD'],
        
         ["ALTA",     <?php echo $alta ?>],
         ["MEDIA",     <?php echo $media ?>],
         ["BAJA",     <?php echo $baja ?>],
      
      ]);
  
      var options = {
        title: 'CANTIDAD DE PEDIDOS POR PRIORIDAD',
        width: 380,
        height: 230,
        is3D: true,
      };
  
      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  </script>  

  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        @if (count($clientes)>0)
        ["CLIENTE", "CANTIDAD", { role: "style" } ],
        ["<?php echo $clientes[0]->first_name; ?>", <?php echo $clientes[0]->cantidad; ?>, "#F1C40F" ],
        ["<?php echo $clientes[1]->first_name; ?>", <?php echo $clientes[1]->cantidad; ?>, "#5DADE2"],
        ["<?php echo $clientes[2]->first_name; ?>", <?php echo $clientes[2]->cantidad; ?>, "#52BE80"],
        ["<?php echo $clientes[3]->first_name; ?>", <?php echo $clientes[3]->cantidad; ?>, "#E74C3C"],
        ["<?php echo $clientes[4]->first_name; ?>", <?php echo $clientes[4]->cantidad; ?>, "#76448A"],  
        @endif
       
        
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "MEJORES CLIENTES",
        width: 400,
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>

  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
      var data = new google.visualization.arrayToDataTable([
        @if (count($providers)>0)
        ['PROVEEDOR', 'CANTIDAD'],
        @foreach ($providers as $p)
        ["{{ $p->full_name }}", {{ $p->cantidad }}],
        @endforeach
        
        @endif
        
      ]);

      var options = {
        width: 400,
        height: 300,
        legend: { position: 'none' },
        chart: {
          title: 'COMPRAS A PROVEEDORES',
          subtitle: '' },
        axes: {
          x: {
            0: { side: 'top', label: ''} // Top x-axis.
          }
        },
        bar: { groupWidth: "90%" }
      };

      var chart = new google.charts.Bar(document.getElementById('top_x_div'));
      // Convert the Classic options to Material options.
      chart.draw(data, google.charts.Bar.convertOptions(options));
    };
  </script>