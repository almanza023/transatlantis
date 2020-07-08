@extends('theme.main')


@section('titulo', 'Actualizacion de Proveedores')


@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop



@section('content')
<div class="section-wrapper">

	@if ($errors->any())
	<div class="row">

		<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
					aria-hidden="true">×</span></button>
			@foreach ($errors->all() as $error)
			<li class="col-white">{{ $error }}</li>
			@endforeach
		</div>
	</div>

	@endif

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-teal">ACTUALIZACION DE PROVEEDORES</h2>
					<a href="{{route('provider.index')}}"
						class="btn btn-oblong btn-danger btn-sm" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="fa fa-reply-all"></i>
					</a>

				</div>
				<div class="card-body">
					<form id="form_update" method="POST" action="{{ route('provider.update', $provider->nit) }}">

						@csrf
						@method('PATCH')

						<fieldset>

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
							</legend>

							<div class="row">
							<div class="col-md-6">
								<label for="nit">Tipo Provedor</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('id_type_provider') ? 'error focused' : 'success' }}">
										<select class="form-control show-tick" name="id_type_provider"
											id="id_type_provider" data-live-search="true" data-show-subtext="true">
											<option value="">Tipo Proveedor</option>
											@foreach ($typeproviders as $typeprovider)
											@if($provider->id_type_provider == $typeprovider->id_type_provider)
											<option data-subtext="{{$typeprovider->description}}"
												value="{{$typeprovider->id_type_provider}}" selected>
												{{$typeprovider->type_provider}}</option>
											@else
											<option data-subtext="{{$typeprovider->description}}"
												value="{{$typeprovider->id_type_provider}}">
												{{$typeprovider->type_provider}}</option>
											@endif

											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<label for="full_name">Razon Social</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control" name="full_name" id="full_name"
											value="{{$provider->full_name}}">
									</div>
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">
								<label for="first_name">Nombre Contacto Proveedor</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('first_name') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" name="first_name" id="first_name"
											value="{{$provider->first_name}}">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<label for="last_name">Apellido Contacto Proveedor</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('last_name') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" name="last_name" id="last_name"
											value="{{$provider->last_name}}">
									</div>
								</div>
							</div>
							</div>


						</fieldset>

						<fieldset>


							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Contacto</h5>
							</legend>
							<div class="row">
							<div class="col-md-6">
								<label for="email">Correo Electronico</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('email') ? 'error focused' : 'success' }}">
										<input type="email" class="form-control" name="email" id="email"
											value="{{$provider->email}}">
									</div>
								</div>
							</div>

							<div class="col-md-6" data-toggle="modal" data-target="#listMunicipalities">
								<label for="municipality">Municipio</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('id_municipality') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" name="municipality" id="municipality"
											value="{{$provider->municipality->name_municipality}}" readonly>
										<input type="hidden" name="id_municipality" id="id_municipality"
											value="{{$provider->id_municipality}}">
									</div>
								</div>
							</div>
							</div>
							<div class="row">

							<div class="col-md-6">
								<label for="address">Direccion</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('address') ? 'error focused' : 'success' }}">
										<textarea class="form-control" id="address" name="address"
											minlength="5">{{$provider->address}}</textarea>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<label for="contact_number"># de Contacto</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('contact_number') ? 'error focused' : 'success' }}">
										<input type="number" class="form-control" name="contact_number"
											id="contact_number" value="{{$provider->contact_number}}">
									</div>
								</div>
							</div>
							</div>

						</fieldset>



						<input type="hidden" name="nit" id="nit" value="{{$provider->nit}}">
						<div class="row">
						<div class="col-md-12">
						<button type="button" id="btnUpdate" class="btn btn-primary">
							<i class="fa fa-save"></i>
							<span> ACTUALIZAR</span>
						</button>
						</div>
						</div>



					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@include('modals.modal_list_municipalities')


@stop



@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>

<script src="{{asset('js/provider.js')}}"></script>

@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif

@stop