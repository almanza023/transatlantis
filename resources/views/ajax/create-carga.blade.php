 
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				
				<div class="card-body">
					<form id="form_carga" method="POST" action="{{ route('save.carga') }}" autocomplete="off">

						@csrf
						<fieldset>
							<legend>
                            <h5 class="font-bold col-light-green text-center">REGISTRAR CARGA</h5>
                            </legend>                            
                            <input type="hidden" name="id_order" id="id_order" value="{{$order->id_order}}">
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <td colspan="3">
                                            <div class="demo-checkbox">
                                                <input type="checkbox" class="check_provider" id="basic_checkbox_1" checked="true">
                                                <label for="basic_checkbox_1" class="font-bold col-red">Seleccionar el mismo Vehiculo para todos</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>MATERIAL</th>
                                        <th>CANTIDAD</th>
                                        <th>VEHICULO</th>
                                    </tr>

                                    
                               
                            @foreach ($order->orderDetails as $detail)
                                    <tr>
                                        <th>
                                            <input type="hidden" class="form-control" name="product_id[]" id="idproduct-{{$detail->id_order_detail}}" value="{{$detail->product->id_product}}" >
                                            <input type="text" class="form-control" name="product[]" id="product-{{$detail->id_order_detail}}" value="{{$detail->product->name_product}} x({{$detail->amount}}) {{$detail->product->typeUnit->type_unit}}" readonly>
                                            <input type="hidden" name="id_order_detail[]" id="id_order_detail-{{$detail->id_order_detail}}" value="{{$detail->id_order_detail}}">
                                        </th>
                                        <td>
                                            <input type="text" class="form-control" name="amount[]" id="amount-{{$loop->iteration}}" value="{{$detail->amount}}" readonly>
                                        </td>
                                        <td>
                                            <select class="form-control show-tick" name="vehicle[]"
                                            id="nit-{{$loop->iteration}}" data-live-search="true" data-show-subtext="true" onchange="selectProvider(this)">
                                            <option value="">Escoge una opcion</option>
                                            @foreach ($vehicles as $item)
                                                <option  value="{{$item->placa.'-'.$item->nid_driver}}">{{$item->placa.'-'.$item->nid_driver}}</option>
                                            @endforeach
										</select>
                                        </td>
                                    </tr>
                                
                            @endforeach
                            <tr>
                                <th>
                                    <button id="btnsavecarga" onclick="saveCarga();" type="button" class="btn btn-success">
                                        <i class="fa fa-save"></i>
                                        <span> GUARDAR</span>
                                    </button>
                                </th>
                                <td>
                                    <a target="_blank" style="display:none;" id="btnprint" class='btn btn-primary btn-sm'  href=" {{route('purchase.report', $order->id_order) }}"><i class='fa fa-print' data-toggle="tooltip" data-placement="top" data-original-title="Imprimir Orden"></i> <span>IMPRIMIR</span></a>
                                </td>
                            </tr>
                        </table>
                    </div>          

                        </fieldset>
                        
                       
                     
				
						

                        
					</form>
				</div>
			</div>
		</div>
	</div>





