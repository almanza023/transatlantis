<div class="row ">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos table-condensed">
                                                <tbody>
                                                    <tr>
                                                        <th>Cliente</th>
                                                        <td>
                                                        <li>{{$order->present()->customerJuridico()}}</li>
                                                            <li>Lugar de Solicitud: {{$order->name_municipality}} {{$order->name_departament}}</li>
                                                            <li>Direccion: {{$order->address}}, {{$order->additional}}</li>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Orden</th>
                                                        <td>
                                                           <li> # Orden: {{$order->id_order}}</li> 
                                                           <li> Fecha de Orden: {{$order->date_format}}</li>
                                                           <li> Tipo de Pago: {{$order->type_payment}}</li>
                                                           <li> Tiempo de Pago: {{$order->time_payment}} Dia/Dias</li>
                                                           <li class="font-bold" id="text_descuento"> Descuento: {{$order->present()->hasDiscount()}}</li>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                 
                            
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $total_factura = 0; $discount = 0; $total_descuento; @endphp
                                                    @foreach ($order->orderDetails as $detail)
                                                   
                                                    @php $total = ($detail->amount*$detail->unit_price) @endphp
                                                    @php $total_factura += $total @endphp
                                        
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$detail->product->name_product}}</td>
                                                        <td>{{$detail->amount}} ({{$detail->product->typeUnit->type_unit}})</td>
                                                        <td>$ {{number_format($detail->unit_price, 0)}}</td>
                                                        <td>$ {{number_format($total, 0)}}</td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>

                                                <div>
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <form id = "form_discount" action="{{route('orders.discount')}}" method="POST">
                                                @csrf
                                            <table class="table ">
                                                <tr>
                                                    <th>
                                                        DESCUENTO
                                                    </th>
                                                    <td>
                                                        <input type="hidden" name="id_order" value="{{$order->id_order}}">
                                                        @if ($order->discount)
                                                        <input type="hidden" value="{{ $total_factura }}" id="total">
                                                          <input type="number" class="form-control" placeholder="Descuento" value="{{$order->discount}}" name="discount" id="input_discount">
                                                        @else
                                                        <input type="hidden" value="{{ $total_factura }}" id="total">
                                                          <input type="number" class="form-control" placeholder="Descuento" name="discount" id="input_discount"  value="0">
                                                        @endif
                                                    </td>
                                                </tr>
                                                    <tr>
                                                        <td>
                                                            <button type="button" id="btn_discount" onclick="saveDiscount(this);" class="btn btn-info btn-sm">APLICAR</button>
                                                        </td>
                                                   
                                                    </tr>
                                            <tr>
                                                <th>
                                                    SUBTOTAL
                                                </th>
                                            <td>
                                                <div  class="col-md-12 col-sm-12">
                                                      <input id="sub_total" type="text"  class="form-control" name="sub_total" value="Sub-Total: $ {{number_format($total_factura, 0)}}" readonly>
                                                        <input type="hidden" id="sub_total_update" value="{{$total_factura}}">
                                                </div>
                                               

                                            </td>

                                            </tr>
                                            
                                            <tr>
                                                <th>
                                                    DESCUENTO
                                                </th>
                                                <td>
                                                    <div class="col-md-12 col-sm-12" style="display:none;" id="col_descuento">
                                                        <input id="descuento_total_update" type="text"  class="form-control" value="" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>TOTAL</th>
                                                <td>
                                                    <div class="col-md-12 col-sm-12" style="display:none;" id="col_items">
                                                        <input id="total_items_update" type="text"  class="form-control" value="" readonly>
                                                    </div>
        
                                                </td>
                                            </tr>
                                            </table>
                                        </form> 
                                        </div>
                                       
                                      
                                        
                                    <div class="row">
                                        <div class="col-md-12 col-sm-4">
                                            <button type='button' class='btn btn-success  btn-lg' id='btn_approve-{{$order->id_order}}' onclick="saveApprove(this);" data-href="{{route('orders.approve', $order->id_order)}}"><i class="fa fa-check"></i> APROBAR</button>
                                            <button type='button' class='btn btn-danger btn-lg' id='btn_deny-{{$order->id_order}}' onclick="saveDeny(this);" data-href=" {{route('orders.deny', $order->id_order)}}"><i class="fa fa-close"></i> RECHAZAR</button>
                                        </div>  
                                        </div>  
                               
                             
                            
                        </div>
                    </div>
                </div>
            </div>
       