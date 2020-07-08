@extends('theme.main')
@section('titulo', 'Actualizacion de Ordenes')
@section('content')
<div class="container-fluid">	
	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-header bg-warning">
						<h2 class="tx-center font-bold col-teal">APROBACION DE PEDIDO</h2>
						
					</div>
					<div class="card-body">
								
						

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
										
											
										</td>
                                        </tr>
                                            
                                        @endforeach
										
									</tbody>
								</table>
							</div>
							<div class="col-md-9 col-sm-9"></div>
							<div class="col-md-12 col-sm-3">
                            <input id="" type="text"  class="form-control" name="" value="Total: ${{number_format($total_factura)}}" readonly>
							</div>

							
	
                            <br>
                            <form id="form" action="{{ route('aprobar.quotation', $order->id_order) }}" method="get">
                                <input type="hidden" name="id_order" value="{{ $order->id_order }}">
                                <button id="btnAprobar" type="button" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                    <span> APROBAR</span>
                                </button>
                            </form>
						

							



						</fieldset>	


					</div>
				</div>
			</div>
			
		</div>

		
	</form>
</div>

@endsection


@section('extra-scripts')
<script src="{{asset('js/order.js')}}"></script>





@stop