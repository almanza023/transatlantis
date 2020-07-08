@extends('theme.main')


@section('titulo', 'Listado de Tipos de Unidades')

@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop
@section('content')
<div class="section-wrapper">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE TIPOS DE UNIDADES
					</h2>
					
				</div>
				<div class="card-body">
					<hr>
					<a href="#modalCreateTypeUnit" data-toggle="modal"
					class="btn btn-primary btn-oblong"><i data-toggle="tooltip" data-placement="top" title=""
						data-original-title="Crear nuevo registro" class="fa fa-save"></i> CREAR NUEVO</a>
					<hr>
					<div class="table-wrapper">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Tipo Unidad</th>
									<th>Descripcion</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Tipo Unidad</th>
									<th>Descripcion</th>
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($typeunits as $typeunit)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$typeunit->type_unit}}</td>
									<td>{{$typeunit->description}}</td>
									<td class="text-center">
										<a href="#modalEditTypeUnit" data-toggle="modal" data-id="{{$typeunit->id_type_unit}}" data-typeunit="{{$typeunit->type_unit}}"
											data-description="{{$typeunit->description}}"
											class="btn btn-oblong btn-warning btn-sm"><i data-toggle="tooltip"
											data-placement="top" title="" data-original-title="Editar"
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

@include('modals.modal_create_type_unit')
@include('modals.modal_edit_type_unit')


@stop



@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>

<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>

<script src="{{asset('js/validacion.js')}}"></script>
<script src="{{asset('js/typeunit.js')}}"></script>

@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif


@stop