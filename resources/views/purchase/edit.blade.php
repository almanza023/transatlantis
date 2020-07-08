@extends('layouts.main')


@section('titulo', 'Actualizacion de Compras a Proveedores')


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
					<h2 class="text-center font-bold col-teal">ACTUALIZACION DE COMPRAS A PROVEEDOR</h2>
					<a href="{{route('order.index')}}"
						class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="material-icons">reply_all</i>
					</a>
				</div>
				<div class="body">
					<form id="form_validation" method="POST" action="{{ route('purchase.update', $purchase->id_purchase) }}" autocomplete="off">

                        @csrf
                        @method('PATCH')

						<fieldset>

							<legend>
								<h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
                            </legend>
                            
                            
                            
                            <div class="col-md-4">
                                <label for="id_order_detail-1">Producto</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" class="form-control" name="product" id="product-1" value="{{$purchase->orderDetail->product->name_product}}" readonly>
                                    <input type="hidden" name="id_order_detail" id="id_order_detail-1" value="{{$purchase->id_order_detail}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="amount-1">Cantidad</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" class="form-control" name="amount" id="amount-1" value="{{$purchase->amount}}" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
								<label for="nit-1">Proveedor</label>
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="nit"
                                            id="nit-1" data-live-search="true" data-show-subtext="true">
                                            <option value="">Escoge una opcion</option>
                                            @foreach ($providers as $provider)
                                                @if($purchase->nit == $provider->nit)
                                                <option  value="{{$provider->nit}}" selected>{{$provider->full_name}}</option>
                                                @else 
                                                <option  value="{{$provider->nit}}">{{$provider->full_name}}</option>
                                                @endif
                                            @endforeach
										</select>
									</div>
								</div>
                            </div>
                                
                            
                           
                        </fieldset>
                        
                       
				
						<button id="btnguardar" type="submit" class="btn bg-teal waves-effect">
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


@stop