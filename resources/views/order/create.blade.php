@extends('theme.main')
@section('titulo', 'REGISTRAR PEDIDOS')
@section('content')
<div class="section-wrapper">	
	<form id="form" method="POST" action="{{ route('orders.store') }}" autocomplete="off">
		@csrf	   
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-header bg-warning">
						<h2 class="text-center font-bold " style="color:white"><b>REGISTRO DE PEDIDO</b></h2>
						
					</div>
					<div class="card-body">

						<fieldset>

						<div class="row">

							
							<div class="col-md-6">
								<label for="nid_customer">Cliente</label>
								<div class="form-group">
									<div class="form-line">
										<select style="margin-top:-10px;" class="form-control show-tick" name="nid" id="nid_customer" data-live-search="true">
											<option value="">--Seleccionar Cliente--</option>
											@foreach ($customers as $customer)
											<option value="{{$customer->nid}}">
												{{$customer->name_complete}}</option>
											@endforeach
										</select>
										
									</div>
								</div>
							</div>

							<div class="col-md-6" style="margin-top:27px;" >
							
								<a style="height: 40px;"  class="btn btn-success  btn-oblong" href="#createCustomer" data-toggle="modal"
								 >
								 <i class="fa fa-user-friends"></i> CREAR CLIENTE
							 </a>

							<a style="height: 40px;"  class="btn btn-info btn-oblong" role="button" data-toggle="collapse" href="#collapseDomicile" aria-expanded="true"
                               aria-controls="collapseDomicile" >
                                <i class="fa fa-info"></i> INFORMACION
							</a>
							<a  id="btnchagedomicile" style="display: none;" class="btn btn-warning btn-oblong" role="button" href="#modalDomicile" data-toggle="modal">
                                <i class="fa fa-home"></i> CAMBIAR DIRECCION
							</a>
							
							               
                        
                            <div class="collapse in" id="collapseDomicile">
                                <div class="card-body bg-white">
									<label># Orden: <span id="nro_order">2020</span></label><br>
									<label>Fecha: <span id="fecha_orden"> 14/07/2019</span></label><br>
									<label>Email: <span id="email_customer">xxxx@gmail.com</span></label> <br>
									<label>Direccion: <span id="direction">--------------------------</span> </label> <br>
                                </div>
                            </div>


							
						</div>

						
						</div>

						<div class="row">

							<div class="col-md-4">
								<label for="id_type_payment">Tipos de Pago</label>
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="id_type_payment" id="id_type_payment"
											data-live-search="true">
											<option value="">Tipo de Pago</option>
											@foreach ($typepayments as $typepayment)
											<option data-subtext="{{$typepayment->description}}"
												value="{{$typepayment->id_type_payment}}">
												{{$typepayment->type_payment}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
	
							<div class="col-md-4">
								<label for="id_time_payment">Tiempos de Pago</label>
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="id_time_payment" id="id_time_payment"
											data-live-search="true">
											<option value="">Tiempo de Pago</option>
											@foreach ($timepayments as $timepayment)
											<option data-subtext="{{$timepayment->description}}"
												value="{{$timepayment->id_time_payment}}">
												{{$timepayment->time_payment}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
	
							<div class="col-md-4">
								<label for="priority">Prioridad</label>
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="priority" id="priority">
											<option value="">--Seleccionar Prioridad--</option>
											<option value="1">ALTA</option>
											<option value="5">MEDIA</option>
											<option value="10">BAJA</option>
										</select>
									</div>
								</div>
							</div>
	

						</div>	

						

			
						<input type="hidden" id="id_customer_domicile" name="id_customer_domicile">

						<div id="clonar"></div>
	
						
						</fieldset>


						<fieldset>

							<a href="#modalProduct" data-opcion="2" data-toggle="modal" class="btn btn-primary waves-effect">AÑADIR PRODUCTO +</a>

							<div class="table-wrapper">
								<br>
								<table class="table table-hover table-condensed" id="table_items">
									<thead>
										<tr>
											<th>#</th>
											<th class="text-center">Producto</th>											
											<th class="text-center">Cantidad</th>
											<th class="text-center">Precio Unitario</th>
											<th class="text-center">Total</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							
							<div class="col-md-12 col-sm-3">
								<input id="total_items" type="text"  class="form-control" name="total_items" value="Total: $0.0" readonly>
							</div>				
	
							<br>
							<button id="btnguardar" type="button" class="btn btn-success">
								<i class="fa fa-save"></i>
								<span> GUARDAR</span>
							</button>
							<a href="{{ route('orders.create') }}" class="btn btn-primary">
								<i class="fa fa-pencil"></i>
								<span> NUEVA ORDEN</span>
							</a>
							

						</fieldset>	


					</div>
				</div>
			</div>
			
		</div>
		<input type="hidden" id="list_municipalities" value='@json($municipalities)'>
		
	</form>
	
	<input id="list_products" type="hidden" value='@json($products)'>

	<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" >
		<div class="modal-dialog modal-lg bg-warning" role="document">
			<div class="modal-header pd-x-20 bg-warning">
				<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">LISTADO DE PRODUCTOS</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			 </div>
			<div class="modal-content" >
				<div class="modal-body" >
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<form id="form_items"> 
						   
									<table class="table" style="width: 650px;">
										<tr>
											<th>PRODUCTO</th>
											<td>
											  <select class="form-control show-tick"
											  name="id_product[]" id="id_product-999"
											  data-live-search="true"
											  onchange="changePrice(this);">
											  <option value="">Productos</option>
											  @foreach ($products as $product)
											  <option value="{{$product->id_product}}">
												  {{$product->name_product.' - '.$product->typeUnit->type_unit}}</option>
											  @endforeach
										  </select>
											</td>
										</tr>
										<tr>
											<th>CANTIDAD</th>
			  
											<td>
											  <input type="number" class="form-control"
											  name="amount[]" id="amount-999">
											</td>
										</tr>
										<tr>
											<th>PORCENTAJE</th>
											<td>
												<select name="porcentage_id" id="porcentage_id" class="form-control">
													<option value="0">Seleccione</option>
													@foreach ($porcentages as $item)
													<option value="{{ $item->id }}">{{ $item->valor }}%</option>	
													@endforeach
												</select>
											</td>
										</tr>	
										</tr>
										<tr>
											<th>PRECIO PREDETERMINADO</th>
											<td>
												<select name="precio_db" id="precio_db" class="form-control">
													<option value="1">SI</option>
													<option value="2" selected>NO</option>
												</select>
											</td>
										</tr>
										<tr>
											<th>PRECIO</th>
											<td><input type="number" class="form-control"
											  name="unit_price[]" id="unit_price-999" ></td>
										</tr>
										<tr>
											<td colspan="2">
											  <button id="btnAdd" type="button" class="btn btn-success">
												  <i class="fa fa-save"></i>
												  <span> AÑADIR</span>
											  </button> 
											</td>
										</tr>
									  </table>                         
					 
								  </form> 
							</div>
							</div>
					</div>
				</div>
	
				   
	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> CERRAR</button>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	@include('modals.modal-domicile')
	
	@include('modals.modal-empty')
	
	

	
</div>



@stop



@section('extra-scripts')


<script>
	var x = 0;
	var total_factura = 0;
	let products = $('#list_products').val();
	products = JSON.parse(products);
	var tr = 0;
</script>
<script src="{{asset('js/order.js')}}"></script>
<script src="{{asset('js/customer.js')}}"></script>


<script>
	let municipalities = $('#list_municipalities').val();
	municipalities = JSON.parse(municipalities);
</script>

@stop