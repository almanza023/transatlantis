 
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2 class="text-center font-bold col-teal">SELECCIONE UN PEDIDO</h2>
				</div>
				<div class="body">
					<form id="form_change" method="POST" action="{{ route('order.create') }}" autocomplete="off">

						@csrf

						<fieldset>

                            
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <label for="id_order_change">Pedidos</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick"
                                            name="id_order_change"
                                            id="id_order_change"
                                            data-live-search="true"
                                            data-show-subtext="true">

                                            <option value="">-- Seleccionar Pedido --</option>
                                            @foreach ($orders as $order)
                                            <option
                                                data-subtext="Hola"
                                                value="{{$order->id_order}}">
                                                {{$order->customerDomicile->nid}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>



                        </fieldset>
                        
                       

				
						<button id="btnchangeorders" type="button" class="btn bg-teal waves-effect">
							<i class="material-icons">save</i>
							<span>CARGAR</span>
                        </button>
 
					</form>
				</div>
			</div>
		</div>
	</div>





