@extends('layouts.main')


@section('titulo', 'Registro de Compras a Proveedores')


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
					<h2 class="text-center font-bold col-teal">REGISTRO DE COMPRAS A PROVEEDOR</h2>
					<a href="{{route('order.index')}}"
						class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="material-icons">reply_all</i>
					</a>
				</div>
				<div class="body">
					<form id="form_validation" method="POST" action="{{ route('purchase.store') }}" autocomplete="off">

						@csrf

						<fieldset>

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
                            </legend>
                            
                            <input type="hidden" name="id_order" id="id_order" value="{{$order->id_order}}">
                            
                            @foreach ($order->orderDetails as $detail)

                            <div class="col-md-4">
                                <label for="id_order_detail-{{$detail->id_order_detail}}">Producto</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" class="form-control" name="product[]" id="product-{{$detail->id_order_detail}}" value="{{$detail->product->name_product}}" readonly>
                                    <input type="hidden" name="id_order_detail[]" id="id_order_detail-{{$detail->id_order_detail}}" value="{{$detail->id_order_detail}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="amount-{{$loop->iteration}}">Cantidad</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" class="form-control" name="amount[]" id="amount-{{$loop->iteration}}" value="{{$detail->amount}}" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
								<label for="nit-{{$loop->iteration}}">Proveedor</label>
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="nit[]"
                                            id="nit-{{$loop->iteration}}" data-live-search="true" data-show-subtext="true">
                                            <option value="">Escoge una opcion</option>
                                            @foreach ($providers as $provider)
                                                <option  value="{{$provider->nit}}">{{$provider->full_name}}</option>
                                            @endforeach
										</select>
									</div>
								</div>
                            </div>
                                
                            @endforeach
                            
                           
							

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

<script src="{{asset('js/purchase.js')}}"></script>

@stop