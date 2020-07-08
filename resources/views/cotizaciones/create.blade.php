@extends('theme.main')
@section('titulo', 'REGISTRAR COTIZACIONES')
@section('content')
<div class="section-wrapper">	
	<form id="form" method="POST" action="{{ route('quotation.store') }}" autocomplete="off">
		@csrf	   
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-header bg-warning">
						<h2 class="text-center font-bold " style="color:white"><b>REGISTRO DE COTIZACIONES</b></h2>
						
					</div>
					<div class="card-body">

						<fieldset>


						@if (auth()->user()->hasRole('cliente')==1)

						<input type="hidden" value="{{ $customers->pivot->nid }}" name="nid">
						<input type="hidden"  name="id_customer_domicile" value="{{ $customers->pivot->id_customer_domicile }}">
						<div class="row">	
							@else						
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
							<input type="hidden" id="id_customer_domicile" name="id_customer_domicile">
							@endif
							@if (auth()->user()->hasRole('super-admin')==1 || auth()->user()->hasRole('regular'))
							<div class="col-md-6" style="margin-top:27px;" >					
								

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
						@endif
						
						</div>
						<input type="hidden"name="id_type_payment" value="1">
						<input type="hidden" name="id_time_payment" value="1">
						<input type="hidden" name="priority" value="5">
			
						

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
							<a href="{{ route('quotation.create') }}" class="btn btn-primary">
								<i class="fa fa-pencil"></i>
								<span> NUEVA COTIZACION</span>
							</a>
							

						</fieldset>	


					</div>
				</div>
			</div>
			
		</div>
		<input type="hidden" id="list_municipalities" value='@json($municipalities)'>
		
	</form>

	<input id="list_products" type="hidden" value='@json($products)'>

	@include('modals.modal-domicile')
	@include('modals.modal_list-products-cotizacion')
	@include('modals.modal-empty')
	
	

	
</div>



@stop



@section('extra-scripts')
<script src="{{asset('js/cotizacion.js')}}"></script>

<script>
	var x = 0;
	var total_factura = 0;
	let products = $('#list_products').val();
	products = JSON.parse(products);
	var tr = 0;
</script>



<script>
	let municipalities = $('#list_municipalities').val();
	municipalities = JSON.parse(municipalities);
</script>

@stop