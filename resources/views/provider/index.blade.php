@extends('theme.main')
@section('titulo', 'Listado de Proveedores')
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
						LISTADO DE PROVEEDORES
					</h2>
					
				</div>
				<div class="card-body">
					<hr>
					<a href="{{route('provider.create')}}"
						class="btn btn-primary btn-oblong" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Crear nuevo registro">
						<i class="fa fa-save"></i>
						 CREAR NUEVO
					</a>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Tipo Proveedor</th>
									<th>Proveedor</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Tipo Proveedor</th>
									<th>Proveedor</th>
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($providers as $provider)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$provider->typeProvider->type_provider}}</td>
									<td>
										{{$provider->present()->isTypeProvider()}}
									</td>
									<td class="text-center">

										<a href="#modalDetail" data-toggle="modal"
											data-href="{{route('provider.show', $provider->nit)}}"
											class="btn btn-oblong btn-info btn-sm"><i data-toggle="tooltip"
											data-placement="top" title="" data-original-title="Ver Detalle"
												class="fa fa-paperclip"></i></a>


										{{$provider->present()->isActive()}}


										<a href="{{route('provider.edit', $provider->nit)}}"
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
<script src="{{asset('js/index.js')}}"></script>


@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif

@stop