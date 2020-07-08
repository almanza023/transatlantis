@extends('theme.main')
@section('titulo', 'Registro de Proveedores')

@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop



@section('content')
<div class="secion-wrapper">

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
					<h2 class="text-center font-bold col-teal">REGISTRO DE PROVEEDORES</h2>
					<a href="{{route('provider.index')}}"
					class="btn btn-oblong btn-danger btn-sm" data-toggle="tooltip"
					data-placement="right" title="" data-original-title="Regresar">
				 <i class="fa fa-reply-all"></i>
				 </a>

				</div>
				<div class="card-body">
					<form id="form_create" method="POST" action="{{ route('provider.store') }}" autocomplete="off">

						@csrf
						<fieldset>

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
							</legend>
							<div class="row">
							<div class="col-md-6">
								<label for="nit" class="col-red"># NIT</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('nit') ? 'error focused' : 'success' }}">
										<input type="number" class="form-control" name="nit" id="nit"
											value="{{old('nit')}}">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<label for="nit">Tipo Provedor</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('id_type_provider') ? 'error focused' : 'success' }}">
										<select class="form-control show-tick" name="id_type_provider"
											id="id_type_provider" data-live-search="true" data-show-subtext="true">
											<option value="">Tipo Proveedor</option>
											@foreach ($typeproviders as $typeprovider)
											<option data-subtext="{{$typeprovider->description}}"
												value="{{$typeprovider->id_type_provider}}">
												{{$typeprovider->type_provider}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="full_name">Razon Social</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control" name="full_name" id="full_name"
											value="{{old('full_name')}}">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<label for="first_name">Nombre Contacto Proveedor</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('first_name') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" name="first_name" id="first_name"
											value="{{old('first_name')}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="last_name">Apellido Contacto Proveedor</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('last_name') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" name="last_name" id="last_name"
											value="{{old('last_name')}}">
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
											value="{{old('email')}}">
									</div>
								</div>
							</div>

							<div class="col-md-6" data-toggle="modal" data-target="#listMunicipalities">
								<label for="municipality">Municipio</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('id_municipality') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" name="municipality" id="municipality"
											value="{{old('municipality')}}" readonly>
										<input type="hidden" name="id_municipality" id="id_municipality"
											value="{{old('id_municipality')}}">
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
											minlength="5">{{old('address')}}</textarea>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<label for="contact_number"># de Contacto</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('contact_number') ? 'error focused' : 'success' }}">
										<input type="number" class="form-control" name="contact_number"
											id="contact_number" value="{{old('contact_number')}}">
									</div>
								</div>
							</div>
							</div>
						</fieldset>

						<div class="row">
						<div class="col-md-12">
						<button type="button" class="btn btn-primary" id="btnsave">
							<i class="fa fa-save"></i>
							<span> GUARDAR</span>
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

@if(old('id_type_provider'))
<script>
	$('#id_type_provider').val("{{old('id_type_provider')}}")
	$('#id_type_provider').selectpicker('refresh');
</script>
@endif

@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif

@if (session()->has('warning'))
<script type="text/javascript">
	warning('{{ session('warning') }}');
</script>
@endif


@stop