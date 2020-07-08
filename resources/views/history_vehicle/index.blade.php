@extends('theme.main')
@section('titulo', 'Listado de Categorias de Productos')
@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop


@section('content')


<div class="csection-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						HISTORIAL DE VEHICULOS
					</h2>
					
				</div>
				<div class="card-body">
					
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Placa</th>
									<th>Conductor</th>
									<th>Fecha</th>
									<th>Estado</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Placa</th>
									<th>Conductor</th>
									<th>Fecha</th>
									<th>Estado</th>
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($vehicles as $item)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$item->vehicle->placa}}</td>
									<td>{{$item->driver->first_name.' '.$item->driver->last_name}}</td>
									<td>{{$item->date_assigment}}</td>
									<td>{{$item->status}}</td>

									<td class="text-center">
										
									</td>

								</tr>
								@endforeach
							</tbody>
						</table>
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

<script src="{{asset('js/datatable.js')}}"></script>
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>

<script src="{{asset('js/validacion.js')}}"></script>


@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif


@stop