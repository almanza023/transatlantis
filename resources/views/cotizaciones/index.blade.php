@extends('theme.main')


@section('titulo', 'LISTADO DE COTIZACIONES')
@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@stop


@section('content')

@include('layouts.success')

<div class="section-wrapper">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE COTIZACIONES
					</h2>
				</div>
					    
				<div class="card-body">
					<hr>
					<a  class="btn btn-primary" role="button" href="{{route('quotation.create')}}">
						<li class="fa fa-paperclip"></li> CREAR COTIZACION
					</a>
				
					<a class="btn btn-purple" role="button" data-toggle="collapse" href="#collapseFiltros" aria-expanded="true"
						   aria-controls="collapseFiltros" ><li class="fa fa-list"></li>
							FILTROS
					</a>
					
					
					<div class="collapse" id="collapseFiltros">
						@include('cotizaciones.form-filters')
					</div>
				
					
					<hr><br>
					<div id="datos">					
					<div class="table-responsive" id="id_table">
						@include('ajax.table-quotations')
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="{{asset('js/datatable.js')}}"></script>


<script src="{{asset('js/index-order.js')}}"></script>
<script src="{{asset('js/fecha.js')}}"></script>

@stop