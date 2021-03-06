@extends('theme.main')
@section('titulo', 'CLONACION DE PEDIDOS')
@section('content')
<div class="container-fluid">	
	<form id="form" method="POST" action="{{route('store.clonar')}}" autocomplete="off">

		@csrf
		
	   
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-header bg-warning">
						<h2 class="tx-center font-bold col-teal">NUEVO PEDIDO</h2>
						
					</div>
					<div class="card-body">

						<fieldset>
							
						<div class="row">

						
							<input type="hidden" value="{{ $order->id_order }}" name="id_old">
							<div class="col-md-6">
								<label for="nid_customer">Cliente</label>
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="nid" id="nid_customer" data-live-search="true">
											<option value="">--Seleccionar Cliente--</option>
                                            @foreach ($customers as $customer)
                                            @if($order->nid == $customer->nid)
											<option value="{{$customer->nid}}" selected>
												{{$customer->name_complete}}</option>
                                            @else 
                                            <option value="{{$customer->nid}}">
												{{$customer->name_complete}}</option>
                                            @endif
                                            @endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-6">

                                <a style="height: 40px; margin-top:27px;" class="btn btn-info btn-oblong" role="button" data-toggle="collapse" href="#collapseDomicile" aria-expanded="true"
                                aria-controls="collapseDomicile" >
                                 <i class="fa fa-info"></i> INFORMACION
                             </a>
                             <a  id="btnchagedomicile" style="margin-top:27px;" class="btn btn-warning btn-oblong" role="button" href="#modalDomicile" data-toggle="modal">
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
                                            @if ($order->id_type_payment == $typepayment->id_type_payment)
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
									<div class="form-line">
										<select class="form-control show-tick" name="id_time_payment" id="id_time_payment"
											data-live-search="true">
											<option value="">Tiempo de Pago</option>
                                            @foreach ($timepayments as $timepayment)
                                            @if ($order->id_time_payment == $timepayment->id_time_payment)
                                            <option data-subtext="{{$timepayment->description}}"
												value="{{$timepayment->id_time_payment}}" selected>
                                                {{$timepayment->time_payment}}</option>
                                                @else 
                                                <option data-subtext="{{$timepayment->description}}"
                                                    value="{{$timepayment->id_time_payment}}" >
                                                    {{$timepayment->time_payment}}</option>
                                            
                                            @endif
											
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
                                            @if($order->priority == 1)
                                            <option value="1" selected>ALTA</option>
                                            <option value="5">MEDIA</option>
											<option value="10">BAJA</option>
                                            @endif

                                            @if($order->priority >= 2 AND $order->priority <= 5)
                                            <option value="1">ALTA</option>
                                            <option value="5" selected>MEDIA</option>
											<option value="10">BAJA</option>
                                            @endif

                                            @if($order->priority > 5 AND $order->priority <= 10)
                                            <option value="1">ALTA</option>
                                            <option value="5">MEDIA</option>
											<option value="10" selected>BAJA</option>
                                            @endif
											
											
										</select>
									</div>
								</div>
							</div>
	

						</div>	


			
                        <input type="hidden" id="id_customer_domicile" name="id_customer_domicile" value="{{$order->id_customer_domicile}}">

						<div id="clonar">

                            @foreach ($order->orderDetails as $detail)
                                 @php $subtotal = ($detail->amount*$detail->unit_price) @endphp  
                                <div id="clone-{{$loop->iteration}}">

                                    <input type="hidden" name="id_product[]" id="id_product-{{$loop->iteration}}"  value="{{$detail->id_product}}">
                                    <input type="hidden" name="amount[]" id="amount-{{$loop->iteration}}" value="{{$detail->amount}}">
                                    <input type="hidden" name="unit_price[]" id="unit_price-{{$loop->iteration}}" value="{{$detail->unit_price}}">
                                    <input type="hidden" id="total_item-{{$loop->iteration}}"  value="{{$subtotal}}">
                            
                                </div>
                                
                            @endforeach
                        </div>
	
						
						</fieldset>


						<fieldset>

							<a href="#modalProduct" data-opcion="2" data-toggle="modal" class="btn btn-primary waves-effect">Añadir Producto +</a>

							<div class="card-body table-wrapper">
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
                                        @php $total_factura = 0 @endphp
                                        @foreach ($order->orderDetails as $detail)
                                        @php $total = ($detail->amount*$detail->unit_price) @endphp
                                        @php $total_factura += $total @endphp
                                         <tr id="item_{{$loop->iteration}}">
                                            <td>{{$loop->iteration}}</td>
                                         <td class="text-center">{{$detail->product->name_product}}</td>
                                         <td class="text-center">{{$detail->amount}}</td>
                                         <td class="text-center">${{number_format($detail->unit_price)}}</td> 
										 <td class="text-center">${{number_format($total)}}
											<i class="fa fa-close btn btn-sm btn-danger" onclick="deleteItem('{{$loop->iteration}} ','{{$total}}')"></i>
										 	<i class="fa fa-edit btn btn-warning btn-sm" href="#modalProduct" data-toggle="modal" data-tr="{{$loop->iteration}}"  data-opcion="1" data-product="{{$detail->id_product}}" data-amount="{{$detail->amount}}" data-price="{{$detail->unit_price}}"></i>
											
										</td>
                                        </tr>
                                            
                                        @endforeach
										
									</tbody>
								</table>
							</div>
							<div class="col-md-9 col-sm-9"></div>
							<div class="col-md-12 col-sm-3">
                            <input id="total_items" type="text"  class="form-control" name="total_items" value="Total: ${{number_format($total_factura)}}" readonly>
							</div>
							<br>
							<div class="row" id="divclonar">
								<div class="col-md-6">
									<label for="nid_customer">Clonar Hasta</label>
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="clonar" id="clonar" data-live-search="true">
											<option value="1">PRE-ORDEN</option>
                                            <option value="2">COMPRA</option>
										</select>
									</div>
								</div>
								</div>
							</div>
							
	
							<br>
							<button id="btnguardar" type="button" class="btn btn-success">
								<i class="fa fa-save"></i>
								<span> GUARDAR</span>
							</button>

							<a id="btn_new_order" style="display:none" href="{{route('orders.create')}}" class="btn btn-primary">
								<i class="fa fa-paperclip"> </i>
								<span>CREAR NUEVO PEDIDO</span>
							</a>
	



						</fieldset>	


					</div>
				</div>
			</div>
			
		</div>

		
	</form>

	<input id="list_products" type="hidden" value='@json($products)'>

	@include('modals.modal-domicile')
	@include('modals.modal_list-products')
	
</div>



@stop



@section('extra-scripts')

<script>
	var x = {{$order->orderDetails->count()}};
	var total_factura = {{$total_factura}};
	let products = $('#list_products').val();
	products = JSON.parse(products);
	var tr = 0;
</script>

<script src="{{asset('js/clonar.js')}}"></script>

<script>

    $(function () {
        changeDomiciles('{{$order->nid}}', '/change/domiciles/', 2);
    });
    
    </script>

@stop