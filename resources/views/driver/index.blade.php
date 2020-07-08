@extends('theme.main')

@section('titulo', 'Listado de Conductores')
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
						LISTADO DE CONDUCTORES
					</h2>
					
				</div>
				<div class="card-body">
				<hr>
				<a href="{{route('driver.create')}}"
						class="btn btn-primary btn-oblong" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Crear nuevo registro">
						<i class="fa fa-save"> </i>
						 CREAR NUEVO
					</a>
				<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Conductor</th>
                                    <th>Direccion</th>
                                    <th>Email</th>
                                    
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Conductor</th>
                                    <th>Direccion</th>
                                    <th>Email</th>
                                    
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($drivers as $driver)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$driver->name_complete}}</td>
                                    <td>{{$driver->address}}</td>
                                    <td>{{$driver->email}}
                                        <li>{{$driver->contact_number}}</li>
                                        <li>{{$driver->contact_number_second}}</li>
                                    </td>
                                    
									<td class="text-center">

										<a href="#modalDetail" data-toggle="modal"
											data-href="{{route('driver.show', $driver->nid_driver)}}"
											class="btn btn-oblong btn-info btn-sm"><i data-toggle="tooltip"
											data-placement="top" title="" data-original-title="Ver Detalle"
												class="fa fa-eye"></i></a>


										{{--$driver->present()->isActive()--}}


										<a href="{{route('driver.edit', $driver->nid_driver)}}"
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