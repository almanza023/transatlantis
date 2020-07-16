@extends('theme.main')


@section('titulo', 'Actualizacion de Ordenes')


@section('extra-css')

@stop



@section('content')
<div class="container-fluid">
    

	<div class="row ">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-teal">ACTUALIZACION FECHA DE ENTREGA</h2>
					<a href="{{route('orders.index')}}"
						class="btn btn-danger btn-circle btn-sm btn-oblong" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="fa fa-reply-all"></i> 
					</a>
				</div>
				<div class="card-body">
					<form id="form_validation" method="POST" action="{{ route('schedule.update', $schedule[0]->id_order) }}" autocomplete="off">

                        @csrf
                                                 
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-hover">
											<tr>
												<th>N°</th>
												<th>Vehiculo</th>
												<th>Conductor</th>
												<th>Cambiar Por</th>
											</tr>
											@foreach ($details as $item)
											@php
												$driver= DB::select('select first_name, last_name from drivers where nid_driver=?', [$item->nid_driver]);
											@endphp
											<input type="hidden" name="id_order_schedule_details[]" value="{{ $item->id_order_schedule_details }}">
												<tr>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $item->placa }}</td>
													<td>{{ $driver[0]->first_name.' '.$driver[0]->last_name }}</td>
													<td>
														<select name="driver[]" id="driver" class="form-control">
															<option value="0">Ninguno</option>
															@foreach ($vehicles as $item)
															<option value="{{ $item->placa }}-{{ $item->nid_driver }}">{{ $item->placa.' - '.$item->first_name.' '.$item->last_name }}</option>
															@endforeach
														</select>
													</td>
												</tr>
											@endforeach
										</table>
									</div>
								</div>
							</div>

							<input type="hidden" name="id_order" value="{{ $schedule[0]->id_order }}">
							<div class="row ">
							<div class="col-md-6">
								<label for="nid">Fecha</label>
								<div class="form-group">
									<div class="form-line">
										<input type="date" class="form-control" id="date_departure" name="date_departure" value="{{ $schedule[0]->date_departure }}" required>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<label for="id_municipality">Hora</label>
								<div class="form-group">
									<div
										class="form-line">
										<input type="time" class="form-control" id="time_departure" name="time_departure" value="{{ $schedule[0]->time_departure }}" required>
										
                                        

									
									</div>
								</div>
							</div>
							</div>

							
						<button id="btnguardar" type="submit" class="btn btn-primary">
							<i class="fa fa-save"></i>
							<span> GUARDAR</span>
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






@stop