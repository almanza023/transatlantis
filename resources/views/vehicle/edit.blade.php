@extends('theme.main')


@section('titulo', 'Ediciíon de Vehiculos')

@section('extra-css')

@stop


@section('content')

<div class="section-wrapper">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE VEHICULOS
					</h2>
					<a href="{{route('vehicle.index')}}"
						class="btn btn-danger btn-oblong btn-sm" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="fa fa-reply-all"></i>
					</a>
				</div>
				<div class="card-body">
                    {!! Form::model($vehicle, ['route'=>['vehicle.update', $vehicle->placa], 'method'=>'PUT']) !!}
					
					   
						
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="type_payment">Placa: </label>
							</div>
							<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										{!! Form::text('placa', null, ['class'=>'form-control', 'id'=>'placa', 'required']) !!}       
									</div>
								</div>
							</div>
					
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="description">Modelo: </label>
							</div>
							<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
                                        {!! Form::text('model', null, ['class'=>'form-control', 'id'=>'model', 'required']) !!}       									
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="description">Tipo: </label>
							</div>
							<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										{!! Form::select('type_vehicle', ['0'=>'Seleccione', 'LIVIANO'=>'LIVIANO', 'PESADO'=>'PESADO'], NULL, ['class'=>'form-control', 'id'=>'model', 'required']) !!}
									</div>
								</div>
							</div>
						
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="description">Marca: </label>
							</div>
							<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
                                        {!! Form::text('brand', null, ['class'=>'form-control', 'id'=>'brand', 'required']) !!}       
              
										
									</div>
								</div>
							</div>
						</div>

						<div class="row ">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="description">Volumen: </label>
							</div>
							<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
                                        {!! Form::text('volume', null, ['class'=>'form-control', 'id'=>'volume', 'required']) !!}       
                   
										
									</div>
								</div>
							</div>
					

						
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="description">Capacidad: </label>
							</div>
							<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
                                        {!! Form::text('capacity', null, ['class'=>'form-control', 'id'=>'capacity', 'required']) !!}       
                 
										
									</div>
								</div>
							</div>
						</div>

                       
						<div class="row ">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-save"></i>
							<span> ACTUALIZAR</span>
						</button>
							</div>
						</div>

                        {!! Form::close() !!}     
	
	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@include('modals.modal-empty')


@stop



@section('extra-scripts')

<script src="{{asset('js/vehicle.js')}}"></script>


@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif

@stop