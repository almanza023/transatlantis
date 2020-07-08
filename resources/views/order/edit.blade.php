@extends('theme.main')


@section('titulo', 'Actualizacion de Ordenes')


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
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-teal">ACTUALIZACION DE ORDENES</h2>
					<a href="{{route('order.index')}}"
						class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="material-icons">reply_all</i>
					</a>
				</div>
				<div class="card-body">
					<form id="form_validation" method="POST" action="{{ route('orders.update', $order->id_order) }}" autocomplete="off">

                        @csrf
                        @method('PATCH')

						<fieldset>

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
							</legend>

							<div class="col-md-8">
								<label for="nid">Cliente</label>
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="nid" id="nid"
											data-live-search="true">
											<option value="">Clientes</option>
											@foreach ($customers as $customer)
                                            @if($order->nid == $customer->nid)
                                            <option value="{{$customer->nid}}" selected>{{$customer->name_complete}}</option>
                                            @else
                                            <option value="{{$customer->nid}}">{{$customer->name_complete}}</option>
                                            @endif
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<label for="id_municipality">Municipio</label>
								<div class="form-group">
									<div
										class="form-line">
										<select class="form-control show-tick" name="id_municipality"
											id="id_municipality" data-live-search="true">
											<option value="">Municipio</option>
											@foreach ($departaments as $departament)
											<optgroup label="{{$departament->name_departament}}">

                                                @foreach($departament->municipalities as $municipality)
                                                @if($order->id_municipality == $municipality->id_municipality)
												<option value="{{$municipality->id_municipality}}" selected>
                                                    {{$municipality->name_municipality}}</option>
                                                @else 
                                                <option value="{{$municipality->id_municipality}}">
                                                    {{$municipality->name_municipality}}</option>         
                                                @endif    
												@endforeach

											</optgroup>

											@endforeach


										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<label for="id_type_payment">Tipos de Pago</label>
								<div class="form-group">
									<div
										class="form-line">
										<select class="form-control show-tick" name="id_type_payment"
											id="id_type_payment" data-live-search="true">
											<option value="">Tipo de Pago</option>
                                            @foreach ($typepayments as $typepayment)
                                            @if ($order->id_type_payment ==  $typepayment->id_type_payment)
											<option data-subtext="{{$typepayment->description}}"
												value="{{$typepayment->id_type_payment}}" selected>
                                                {{$typepayment->type_payment}}</option>
                                              @else 
                                              <option data-subtext="{{$typepayment->description}}"
												value="{{$typepayment->id_type_payment}}">
                                                {{$typepayment->type_payment}}</option>    
                                              @endif
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<label for="id_time_payment">Tiempos de Pago</label>
								<div class="form-group">
									<div
										class="form-line">
										<select class="form-control show-tick" name="id_time_payment"
											id="id_time_payment" data-live-search="true">
											<option value="">Tiempo de Pago</option>
                                            @foreach ($timepayments as $timepayment)
                                            @if($order->id_time_payment == $timepayment->id_time_payment)
											<option data-subtext="{{$timepayment->description}}"
												value="{{$timepayment->id_time_payment}}" selected>
                                                {{$timepayment->time_payment}}</option>
                                                @else 
                                                <option data-subtext="{{$timepayment->description}}"
                                                    value="{{$timepayment->id_time_payment}}">
                                                    {{$timepayment->time_payment}}</option>
                                                @endif
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<label for="delivery_request">Lugar de Entrega</label>
								<div class="form-group">
									<div
										class="form-line">
										<textarea class="form-control" id="delivery_request" name="delivery_request"
                                            minlength="5">{{$order->delivery_request}}</textarea>
									</div>
								</div>
							</div>




						</fieldset>

						<fieldset>


							<legend>
								<h5 class="font-bold col-light-green text-center">Productos</h5>
							</legend>
                            
                            @foreach ($order->orderDetails as $detail)
                        <div class="col-md-12" id="clone-{{$loop->iteration}}">
								
								<div class="col-md-4">
									<label for="id_product-{{$loop->iteration}}">Productos</label>
									<div class="form-group">
										<div
											class="form-line">
											<select class="form-control show-tick" name="id_product[]"
												id="id_product-{{$loop->iteration}}" data-live-search="true" onchange="changePrice(this);">
												<option value="">Productos</option>
                                                @foreach ($products as $product)
                                                @if ($product->id_product == $detail->id_product)
                                                <option value="{{$product->id_product}}" selected>{{$product->name_product}}</option>
                                                @else
                                                <option value="{{$product->id_product}}">{{$product->name_product}}</option>
                                                @endif
                                                @endforeach
											</select>
										</div>
									</div>
									
								</div>

								<div class="col-md-4">
									<label for="amount-{{$loop->iteration}}">Cantidad</label>
									<div class="form-group">
										<div class="form-line">
                                        <input type="number" class="form-control" name="amount[]" id="amount-{{$loop->iteration}}" value="{{$detail->amount}}">
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<label for="unit_price-{{$loop->iteration}}">Precio</label>
									<div class="form-group">
										<div class="form-line">
                                        <input type="number" class="form-control" name="unit_price[]" id="unit_price-{{$loop->iteration}}" value="{{$detail->unit_price}}" readonly>
										</div>
									</div>
								</div>

								
                            </div>
                            @endforeach


							<div id="clonar"></div>


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

<script>
const products = @json($products);
var x = {{$order->orderDetails->count()}};
</script>

<script src="{{asset('js/edit-order.js')}}"></script>



@stop