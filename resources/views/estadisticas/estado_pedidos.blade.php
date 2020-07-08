@extends('theme.main')
@section('titulo', 'Estadisticas Por Estado de Pedidos')
@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@stop


@section('content')


<div class="csection-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						ESTADISTICA
					</h2>
					
				</div>
				<div class="card-body">
					<div class="table-wrapper">
						<form id="form" method="GET" action="{{route('estadistica.consultar')}}">
							   
							<div class="row">
									
								<div class="col-md-6">	
									<label  class="form-label font-bold col-cyan">Rango de Fechas: </label>
									<div class="form-group form-float form-float">
										<div class="form-line">
											<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
												<i class="fa fa-calendar"></i>&nbsp;
												<span></span> <i class="fa fa-caret-down"></i>
											</div>
										</div>
									</div>                                            
								</div>
								<input type="hidden" name="date1" id="date1">
								<input type="hidden" name="date2" id="date2"> 	
						
										
							</div>
										<div class="row">
											<div class="col-md-3">
												<button type='button' id="btn_filter"  class='btn btn-info'><li class="fa fa-book"></li> FILTRAR </button>
											</div>			   
														 
											
							
										</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>


	<div class="row" id="resultado">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">				
				<div class="card-body">

					<div id="datos">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop


@section('extra-scripts')
<script src="{{ asset('js/estadisticas.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript" src="{{ asset('js/fecha.js') }}">
</script>

@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif


@stop