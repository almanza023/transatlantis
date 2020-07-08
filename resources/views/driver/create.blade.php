@extends('theme.main')
@section('titulo', 'Registro de Conductores')
@section('extra-css')

@stop
@section('content')
<div class="section-wrapper">
	@if ($errors->any())
	<div class="row" >
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
		<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-teal">REGISTRO DE CONDUCTORES</h2>
					<a href="{{route('driver.index')}}"
						class="btn btn-oblong btn-danger btn-sm" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="fa fa-reply-all"> </i>
					</a>

				</div>
				<div class="card-body">
					<form id="form_create" method="POST" action="{{ route('driver.store') }}" autocomplete="off">

						@csrf

						<fieldset>

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
							</legend>
							<div class="row">							
							<div class="col-md-6">
								<label for="nid_driver" class="col-red"># NID</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('nid_driver') ? 'error focused' : 'success' }}">
										<input type="number" class="form-control" name="nid_driver" id="nid_driver"
											value="{{old('nid_driver')}}">
									</div>
								</div>
                            </div>
                            
                            <div class="col-md-6">
								<label for="first_name">Nombres</label>
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
								<label for="last_name">Apellidos</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('last_name') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" name="last_name" id="last_name"
											value="{{old('last_name')}}">
									</div>
								</div>
                            </div>
                            
                            <div class="col-md-6">
								<label for="address">Direccion</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('address') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" id="address" name="address" value="{{old('address')}}"
										>
									</div>
								</div>
                            </div>
						</div>
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
						<div class="row">			
                            <div class="col-md-6">
								<label for="contact_number_second"># de Contacto</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('contact_number_second') ? 'error focused' : 'success' }}">
										<input type="number" class="form-control" name="contact_number_second"
											id="contact_number_second" value="{{old('contact_number_second')}}">
									</div>
								</div>
							</div>


						</div>
						</fieldset>

						

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Detallada</h5>
                            </legend>
							<div class="row">			
                            <div class="col-md-6">
								<label for="blood_type">Tipo Sangre</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('blood_type') ? 'error focused' : 'success' }}">
										<select class="form-control show-tick" name="blood_type"
											id="blood_type" data-live-search="true">
											<option value="">Escoge una opcion</option>
											<option value="O+">O+</option>
                                            <option value="O-">O-</option>
										</select>
									</div>
								</div>
							</div>
						
                           							
								
							<div class="col-md-6">
								<label for="date_birth">Fecha de Nacimineto</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('date_birth') ? 'error focused' : 'success' }}">
										<input type="date" class="form-control" name="date_birth"
											id="date_birth" value="{{old('date_birth')}}">
									</div>
								</div>
							</div>
						</div>
						</fieldset>
						<div class="row">			
                            <div class="col-md-6">
								<label for="medical_observation">Observacion Medica</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('medical_observation') ? 'error focused' : 'success' }}">
										<textarea class="form-control" id="medical_observation" name="medical_observation"
											minlength="5">{{old('medical_observation')}}</textarea>
									</div>
								</div>
							</div>
					
			

                            <div class="col-md-6">
								<label for="place_care">Lugar de Atencion</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('place_care') ? 'error focused' : 'success' }}">
										<textarea class="form-control" id="place_care" name="place_care"
											minlength="5">{{old('place_care')}}</textarea>
									</div>
								</div>
							</div>
						</div>
							<div class="row">			

                            <div class="col-md-6">
								<label for="arl">ARL</label>
								<div class="form-group">
									<div class="form-line {{ $errors->has('arl') ? 'error focused' : 'success' }}">
										<input type="text" class="form-control" name="arl"
											id="arl" value="{{old('arl')}}">
									</div>
								</div>
							</div>   
						</div>          
						</fieldset>
						<div class="row">			
						<div class="col-md-6">
						<button type="button" id="btnsave" class="btn btn-primary">
							<i class="fa fa-save"> </i>
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



@stop



@section('extra-scripts')
<script src="{{asset('js/driver.js')}}"></script>
@if(old('type_blood'))
<script>
	$('#type_blood').val("{{old('type_blood')}}")
	$('#type_blood').selectpicker('render');
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