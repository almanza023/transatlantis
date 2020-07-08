@extends('theme.main')


@section('titulo', 'Listado de Estado de Pedidos')

@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
<link href="{{asset('plugins/jquery-spinner/css/bootstrap-spinner.min.css')}}" rel="stylesheet">

@stop


@section('content')


<div class="section-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE ESTADOS DE PEDIDOS
					</h2>
					
				</div>
				<div class="card-body">
					<hr>
					<a href="#modalCreateOrderStatus" data-toggle="modal"
						class="btn btn-primary btn-oblong"><i data-toggle="tooltip" data-placement="top" title=""
							data-original-title="Crear nuevo registro" class="fa fa-save">
						</i>
						 CREAR NUEVO
					</a>
					<hr>
					<div class="table-wrapper">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Estado</th>
                                    <th>Descripcion</th>
                                    <th>Orden</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
                                    <th>Estado</th>
                                    <th>Descripcion</th>
									<th>Orden</th>
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($orderstatus as $status)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$status->name}}</td>
                                    <td>{{$status->description}}</td>
                                    <td class="text-center">{{$status->order_by}}</td>
									<td class="text-center">
										<a href="#modalEditOrderStatus" data-toggle="modal" data-id="{{$status->id_order_status}}" data-name="{{$status->name}}"
											data-description="{{$status->description}}" data-orderby="{{$status->order_by}}"
											class="btn btn-warning btn-oblong btn-sm"><i data-toggle="tooltip"
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

@include('modals.modal_create_order_status')
@include('modals.modal_edit_order_status')


@stop



@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>

<!-- Validation Plugin Js -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
<!-- Jquery Spinner Plugin Js -->
<script src="{{asset('plugins/jquery-spinner/js/jquery.spinner.min.js')}}"></script>

<script src="{{asset('js/validacion.js')}}"></script>
<script src="{{asset('js/orderstatus.js')}}"></script>

@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif


@stop