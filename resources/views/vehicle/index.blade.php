@extends('theme.main')


@section('titulo', 'Listado de Vehiculos')

@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop


@section('content')

<div class="section-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE VEHICULOS
					</h2>					
				</div>
				<div class="card-body">
					<hr>
					<a href="{{route('vehicle.create')}}"
						class="btn btn-primary btn-oblong" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Crear nuevo registro">
						<i class="fa fa-save"></i>
						 CREAR NUEVO
					</a>
					<hr>
					<div class="table-wrapper">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
                                    <th>Vehicle</th>
                                    <th>Tipo Vehiculo</th>
                                    <th>Caracteristica</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
                                    <th>Vehicle</th>
                                    <th>Tipo Vehiculo</th>
                                    <th>Caracteristica</th>
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($vehicles as $vehicle)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$vehicle->placa}}</td>
                                    <td>{{$vehicle->type_vehicle}}</td>
                                    <td>
                                        <li>Marca: {{$vehicle->brand}}</li>
                                        <li>Modelo: {{$vehicle->model}}</li>
                                        <li>Capacidad: {{$vehicle->capacity}}</li>
                                        <li>Volumen: {{$vehicle->volume}}</li>
                                    </td>
                                    
									<td class="text-center">

										

										<a href="{{route('vehicle.edit', $vehicle->placa)}}"
											class="btn btn-oblong btn-warning btn-sm" data-toggle="tooltip"
											data-placement="top" title="" data-original-title="Editar"><i
												class="fa fa-edit"></i></a>


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

@include('modals.modal-empty')


@stop



@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/datatable.js')}}"></script>
<script src="{{asset('js/vehicle.js')}}"></script>




@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif

@stop