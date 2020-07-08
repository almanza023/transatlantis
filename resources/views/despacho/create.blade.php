@extends('layouts.main')


@section('titulo', 'Registro de Entregas')


@section('extra-css')
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet">
<!-- Sweetalert Css -->
<link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

@stop



@section('content')
<div class="container-fluid">
    

	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2 class="text-center font-bold col-teal">REGISTRO DE ENTREGAS DE ORDEN</h2>
					<a href="{{route('order.index')}}"
						class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="material-icons">reply_all</i>
					</a>
				</div>
				<div class="body">
					<form id="form_validation" method="POST" action="{{ route('despacho.store') }}" autocomplete="off">

						@csrf

						<fieldset>

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
                            </legend>

                            <input type="hidden" name="id_order" id="id_order" value="{{$id}}">
                            
                            <div class="col-md-6">
                                <label for="date_departure">Fecha de Salida</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="date_departure" id="date_departure">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="time_departure">Hora de Salida</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="time" class="form-control" name="time_departure" id="time_departure">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-md-12">
								<label for="description">Descripcion</label>
								<div class="form-group">
									<div
										class="form-line">
										<textarea class="form-control" id="description" name="description"
											minlength="5"></textarea>
									</div>
								</div>
							</div>


                        </fieldset>
                        
                        <fieldset>


                            <legend>
                                <h5 class="font-bold col-light-green text-center">Asignar Vehiculo</h5>
                            </legend>

                            <div class="col-md-12" id="clone-1">

                                

                                <div class="panel-group full-body" id="accordion_19" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-deep-purple">
                                        <div class="panel-heading" role="tab" id="headingOne_19">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                                                    <i class="material-icons">perm_contact_calendar</i> 1.) Vehiculo 
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                            <div class="panel-body">

                                                <div class="col-md-4">
                                                    <label for="placa-1">Vehiculos</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control show-tick" name="placa[]"
                                                                id="placa-1" data-live-search="true">
                                                                <option value="">Vehiculos</option>
                                                                @foreach ($vehicles as $vehicle)
                                                                <option value="{{$vehicle->placa}}">{{$vehicle->brand}} - {{$vehicle->placa}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                
        
                                                <div class="col-md-4">
                                                    <label for="id_municipality_origin-1">Origen</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control show-tick" name="id_municipality_origin[]"
                                                                id="id_municipality_origin-1" data-live-search="true">
                                                                <option value="">Municipio</option>
                                                                @foreach ($municipalities as $municipality)
                                                                <option value="{{$municipality->id_municipality}}">{{$municipality->name_municipality}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="id_municipality_destination-1">Destino</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control show-tick" name="id_municipality_destination[]"
                                                                id="id_municipality_destination-1" data-live-search="true">
                                                                <option value="">Municipio</option>
                                                                @foreach ($municipalities as $municipality)
                                                                <option value="{{$municipality->id_municipality}}">{{$municipality->name_municipality}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
        
        
                                                <div class="col-md-6">
                                                    <label for="address_destination-1">Direccion de Destino</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea class="form-control" id="address_destination-1" name="address_destination[]"
                                                                minlength="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="description_carga-1">Descripcion de Carga</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea class="form-control" id="description_carga-1" name="description_carga[]"
                                                                minlength="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="time_return-1">Hora de Retorno</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="time" name="time_return[]" id="time_return-1" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="time_stimated-1">Tiempo Estimado (Min?)</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="number" name="time_stimated[]" id="time_stimated-1" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

    
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div id="clonar"></div>

                                    
                                </div>

                                
                            </div>


                            

                            <div class="col-md-12 text-center">

                                <input type="button" class="btn btn-success waves-effect" id="btnAdd" value="+" />
                                <input type="button" class="btn btn-warning waves-effect" id="btnDel" value="-" />
              
                            </div>


                        </fieldset>


				
						<button id="btnguardar" type="button" class="btn bg-teal waves-effect">
							<i class="material-icons">save</i>
							<span>GUARDAR</span>
						</button>



					</form>
				</div>
			</div>
		</div>
	</div>

</div>



@stop



@section('extra-scripts')
<!-- SweetAlert Plugin Js -->
<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>


<script type="text/javascript">
const vehicles =  @json($vehicles);
const municipalities =  @json($municipalities);
var x = 1;
</script>

<script src="{{asset('js/schedule.js')}}"></script>


@stop