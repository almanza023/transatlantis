@extends('theme.main')


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
						<i class="fa fa-reply-all"></i>
					</a>
				</div>
				<div class="body">
					<form id="form_validation" method="POST" action="{{ route('despacho.update', $schedule->id_order_schedule) }}" autocomplete="off">

                        @csrf
                        @method('PATCH')

						<fieldset>

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
                            </legend>

                            
                            <div class="col-md-6">
                                <label for="date_departure">Fecha de Salida</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="date" class="form-control" name="date_departure" id="date_departure" value="{{$schedule->date_departure}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="time_departure">Hora de Salida</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="time" class="form-control" name="time_departure" id="time_departure" value="{{$schedule->time_departure}}">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-md-12">
								<label for="description">Descripcion</label>
								<div class="form-group">
									<div
										class="form-line">
										<textarea class="form-control" id="description" name="description"
                                minlength="5">{{$schedule->description}}</textarea>
									</div>
								</div>
							</div>


                        </fieldset>
                        
                        <fieldset>


                            <legend>
                                <h5 class="font-bold col-light-green text-center">Asignar Vehiculo</h5>
                            </legend>

                            @foreach ($schedule->orderScheduleDetails as $detail)
                            <div class="col-md-12" id="clone-1">

                                

                            <div class="panel-group full-body" id="accordion_1{{$loop->iteration}}" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-deep-purple">
                                        <div class="panel-heading" role="tab" id="headingOne_1{{$loop->iteration}}">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_1{{$loop->iteration}}" aria-expanded="true" aria-controls="collapseOne_1{{$loop->iteration}}">
                                                    <i class="material-icons">perm_contact_calendar</i> {{$loop->iteration}}.) Vehiculo 
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_1{{$loop->iteration}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1{{$loop->iteration}}">
                                            <div class="panel-body">

                                                <div class="col-md-4">
                                                    <label for="placa-{{$loop->iteration}}">Vehiculos</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control show-tick" name="placa[]"
                                                                id="placa-{{$loop->iteration}}" data-live-search="true">
                                                                <option value="">Vehiculos</option>
                                                                @foreach ($vehicles as $vehicle)
                                                                @if($vehicle->placa == $detail->placa)
                                                                <option value="{{$vehicle->placa}}" selected>{{$vehicle->brand}} - {{$vehicle->placa}}</option>
                                                                @else
                                                                <option value="{{$vehicle->placa}}">{{$vehicle->brand}} - {{$vehicle->placa}}</option>
                                                   
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                
        
                                                <div class="col-md-4">
                                                    <label for="id_municipality_origin-{{$loop->iteration}}">Origen</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control show-tick" name="id_municipality_origin[]"
                                                                id="id_municipality_origin-{{$loop->iteration}}" data-live-search="true">
                                                                <option value="">Municipio</option>
                                                                @foreach ($municipalities as $municipality)
                                                                @if($municipality->id_municipality == $detail->id_municipality_origin)
                                                                <option value="{{$municipality->id_municipality}}" selected>{{$municipality->name_municipality}}</option>
                                                                @else
                                                                <option value="{{$municipality->id_municipality}}">{{$municipality->name_municipality}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="id_municipality_destination-{{$loop->iteration}}">Destino</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control show-tick" name="id_municipality_destination[]"
                                                                id="id_municipality_destination-{{$loop->iteration}}" data-live-search="true">
                                                                <option value="">Municipio</option>
                                                                @foreach ($municipalities as $municipality)
                                                                @if($municipality->id_municipality == $detail->id_municipality_destination)
                                                                <option value="{{$municipality->id_municipality}}" selected>{{$municipality->name_municipality}}</option>
                                                                @else 
                                                                <option value="{{$municipality->id_municipality}}">{{$municipality->name_municipality}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
        
        
                                                <div class="col-md-6">
                                                    <label for="address_destination-{{$loop->iteration}}">Direccion de Destino</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea class="form-control" id="address_destination-{{$loop->iteration}}" name="address_destination[]"
                                                            minlength="5">{{$detail->address_destination}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="description_carga-{{$loop->iteration}}">Descripcion de Carga</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea class="form-control" id="description_carga-{{$loop->iteration}}" name="description_carga[]"
                                                        minlength="5">{{$detail->description_carga}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="time_return-{{$loop->iteration}}">Hora de Retorno</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                        <input type="time" name="time_return[]" id="time_return-{{$loop->iteration}}" class="form-control" value="{{$detail->time_return}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="time_stimated-{{$loop->iteration}}">Tiempo Estimado (Min?)</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                        <input type="number" name="time_stimated[]" id="time_stimated-{{$loop->iteration}}" class="form-control" value="{{$detail->time_stimated}}">
                                                        </div>
                                                    </div>
                                                </div>

    
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div id="clonar"></div>

                                    
                                </div>

                                
                            </div>

                            @endforeach
                          

                            

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
var x = {{$schedule->orderScheduleDetails->count()}};
</script>

<script src="{{asset('js/schedule.js')}}"></script>


@stop