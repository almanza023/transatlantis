@extends('theme.main')


@section('titulo', 'Bienvenidos')


@section('content')
<div class="slim-mainpanel">
    <div class="container">

     @php
     $rol = auth()->user()->hasRole('super-admin');
     if($rol==1){

     @endphp
      
      <div class="row row-xs">

        <div class="col-sm-2 col-lg-2">
          <div class="card card-status">
            <div class="media">
              <i class="icon ion-ios-paper tx-purple"></i>
              <div class="media-body">
                <a href="">
                <h1>{{ $num_cot }}</h1>
                <a href="{{ route('quotation.index') }}">Cotizaciones Pendientes</a>
                </a>
              </div><!-- media-body -->
            </div><!-- media -->
          </div><!-- card -->
        </div><!-- col-3 -->

        <div class="col-sm-2 col-lg-2">
          <div class="card card-status">
            <div class="media">
              <i class="icon ion-ios-paperplane tx-purple"></i>
              <div class="media-body">
                <a href="">
                <h1>{{ $num_pre }}</h1>
                <p>Pedidos Pre Orden</p>
                </a>
              </div><!-- media-body -->
            </div><!-- media -->
          </div><!-- card -->
        </div><!-- col-3 -->
        <div class="col-sm-6 col-lg-2 mg-t-10 mg-sm-t-0">
          <div class="card card-status">
            <div class="media">
              <i class="icon ion-ios-cart-outline  tx-teal"></i>
              <div class="media-body">
                <a href="">
                <h1>{{ $num_com }}</h1>
                <p>Pedidos Compra</p>
                </a>
              </div><!-- media-body -->
            </div><!-- media -->
          </div><!-- card -->
        </div><!-- col-3 -->
        <div class="col-sm-6 col-lg-2 mg-t-10 mg-lg-t-0">
          <div class="card card-status">
            <div class="media">
              <i class="icon ion-ios-calendar tx-primary"></i>
              <div class="media-body">
                <a href="{{ route('agendados') }}">
                <h1>{{ $num_agen }}</h1>
                <p>Pedidos Agendados</p>
              </a>
              </div><!-- media-body -->
            </div><!-- media -->
          </div><!-- card -->
        </div><!-- col-3 -->
       
        <div class="col-sm-6 col-lg-2 mg-t-10 mg-lg-t-0">
          <div class="card card-status">
            <div class="media">
             
              <i class="icon ion-ios-alarm tx-pink"></i>
              <div class="media-body">
                <a href="">
                <h1>{{ $num_ent}}</h1>
                <p>Pedidos Entregados</p>
              </div><!-- media-body -->
            </a>
            </div><!-- media -->
          </div><!-- card -->
        </div><!-- col-3 -->
      

      <div class="col-sm-6 col-lg-2 mg-t-10 mg-lg-t-0">
        <div class="card card-status">
          <div class="media">
           
            <i class="icon ion-ios-paperplane-outline tx-pink"></i>
            <div class="media-body">
              <a href="">
              <h1>{{ $num_fact}}</h1>
              <p>Pedidos Facturados</p>
            </div><!-- media-body -->
          </a>
          </div><!-- media -->
        </div><!-- card -->
      </div><!-- col-3 -->
    </div><!-- row -->
 

    


      <div class="row row-xs mg-t-10">
        <div class="col-lg-6">
          <div class="card card-table">
            <div class="card-header">
              <h6 class="slim-card-title">ESTADISTICAS</h6>
            </div><!-- card-header -->
           <div class="col-md-6" id="estado_pedidos">
            <div  style="width: 400px; height: 200px;"></div>
           </div>
           
          </div><!-- card -->
        </div><!-- col-6 -->
     


        <div class="col-lg-6 mg-t-10 mg-lg-t-0">
          <div class="card card-table">
            <div class="card-header">
              <h6 class="slim-card-title">ESTADISTICAS</h6>
            </div> 
            <div class="col-md-6">
              <div id="piechart_3d" style="width: 400px; height: 200px;"></div>
            </div>
          
          </div><!-- card -->
        </div><!-- col-6 -->

        @php
       }
        @endphp

       

       

        

       
      </div><!-- row -->
    </div><!-- container -->
  </div>

@stop
@section('extra-scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ["ESTADO", "CANTIDAD", { role: "style" } ],
      ["COTIZADOS", <?php echo $num_cot;?>, "##E74C3C"],
      ["PRE-ORDEN", <?php echo $num_pre;?>, "#b87333"],
      ["COMPRA", <?php echo $num_com;?>, "silver"],
      ["AGENDADOS", <?php echo $num_agen;?>, "gold"],
      ["ENTREGADOS", <?php echo $num_ent;?>, "#2ECC71"],
      ["FACTURADOS", <?php echo $num_fact;?>, "blue: #e5e4e2"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      title: "CANTIDAD DE PEDIDOS POR CANTIDAD",
      width: 380,
      height: 200,
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
      ['PROVEEDOR', 'CANTIDAD DE COMPRAS'],
      <?php foreach($providers as $p) { ?>
       ["<?php echo $p->full_name; ?> ",     <?php echo $p->cantidad ?>],
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
  }
</script>
@if (session()->has('success'))
<script type="text/javascript">
	success1('{{ session('success') }}');
</script>
@endif
@if (session()->has('warning'))
<script type="text/javascript">
	warning1('{{ session('warning') }}');
</script>
@endif
@endsection