@extends('theme.main')


@section('titulo', 'Listado de Tipos de Pagos')

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
						LISTADO DE TIPOS DE PAGOS
					</h2>
					<a href="#modalCreateTypePayment" data-toggle="modal"
						class="btn btn-primary btn-oblong"><i data-toggle="tooltip" data-placement="top" title=""
							data-original-title="Crear nuevo registro" class="fa fa-save"></i>
						 CREAR NUEVO</a>
				</div>
				<div class="card-body">
					<div class="table-wrapper">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Tipo Pago</th>
									<th>Descripcion</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Tipo Pago</th>
									<th>Descripcion</th>
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($typepayments as $typepayment)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$typepayment->type_payment}}</td>
									<td>{{$typepayment->description}}</td>
									<td class="text-center">
										<a href="#modalEditTypePayment" data-toggle="modal" data-id="{{$typepayment->id_type_payment}}" data-typepayment="{{$typepayment->type_payment}}"
											data-description="{{$typepayment->description}}"
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

@include('modals.modal_create_type_payment')
@include('modals.modal_edit_type_payment')


@stop



@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>

<!-- Validation Plugin Js -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('js/validacion.js')}}"></script>
<script src="{{asset('js/typepayment.js')}}"></script>

@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif


@stop