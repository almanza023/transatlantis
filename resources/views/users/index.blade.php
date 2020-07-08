@extends('theme.main')


@section('titulo', 'Usuarios')

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
						LISTADO DE USUARIOS
					</h2>
					
				</div>
				<div class="card-body">
					<hr>
					<a href="{{ route('user.create') }}"
					class="btn btn-primary btn-oblong"><i data-toggle="tooltip" data-placement="top" title=""
						data-original-title="Crear nuevo registro" class="fa fa-save"></i>
					 CREAR NUEVO</a>
					<hr>
					<div class="table-wrapper">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>NOMBRE</th>
									<th>DOCUMENTO</th>
									<th>DIRECCION</th>
									<TH>CORREO</TH>
									<TH>ROL</TH>
									<TH>ESTADO</TH>
									<th>ACCIONES</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>NOMBRE</th>
									<th>DOCUMENTO</th>
									<th>DIRECCION</th>
									<TH>CORREO</TH>
									<TH>ROL</TH>
									<TH>ESTADO</TH>
									<th>ACCIONES</th>
								</tr>
							</tfoot>
							<tbody>
								
							@foreach ($users as $user)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $user->first_name.' '.$user->last_name }}</td>
									<td>{{ $user->document }}</td>
									<td>{{ $user->address }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->rol }}</td>
									@if ($user->estado=1)
									<td style="background-color: green; color: white">
										ACTIVO
									</td>	
									@else
									<td style="background-color: red; color: white;">
										BLOQUEADO
									</td>	
									@endif
									<td class="text-center">
										
										<a href="{{ route('user.edit', $user->id_admin) }}" class="btn btn-warning btn-sm btn-oblong"><i
											class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar"></i></a>
										</a>
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

@include('modals.modal_create_user')
@include('modals.modal_edit_time_payment')


@stop



@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/datatable.js')}}"></script>



@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif


@stop