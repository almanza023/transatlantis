@extends('theme.main')

@section('titulo', 'Listado de Vehiculos')

@section('extra-css')

@stop


@section('content')

<div class="section-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						ASIGNACION VEHICULO CONDUCTOR
					</h2>
					<a href="{{route('driver_vehicle.index')}}"
						class="btn btn-oblong btn-danger btn-sm" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="fa fa-reply-all"> </i>
					</a>
				</div>
				<div class="card-body">
					<form class="form-horizontal"  id="form_validation" method="POST" action="{{ route('driver_vehicle.store') }}">

						@csrf
					   
						
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="type_payment">Vehiculo: </label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<select name="placa" id="placa" class="form-control">
										<option value="0">Seleccione</option>
										@foreach ($vehicles as $item)
											<option value="{{ $item->placa }}"> {{ $item->placa }}</option>
										@endforeach
										</select>                  
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="type_payment">Conductor: </label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<select name="nid_driver" id="nid_driver" class="form-control">
										<option value="0">Seleccione</option>
										@foreach ($drivers as $item)
											<option value="{{ $item->nid_driver }}"> {{ $item->first_name.' '.$item->last_name }}</option>
										@endforeach
										</select>                  
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="description">Fecha: </label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="datetime-local" class="form-control" id="date_assigment" name="date_assigment"  required >                   
										
									</div>
								</div>
							</div>
						</div>	
						
						
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-save"></i>
							<span> GUARDAR</span>
						</button>
						
	
	
	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@include('modals.modal-empty')


@stop
<script>
	
	const success = (mensaje) => {
		return swal("Exito!", `${mensaje}`, "success");
	}
	
	const warning = (mensaje) => {
		return swal("Error!", `${mensaje}`, "warning");
	}
</script>

@section('extra-scripts')
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