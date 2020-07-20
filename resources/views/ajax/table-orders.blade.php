
<table class="table table-condensed table-bordered table-striped table-hover js-basic-example dataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Fecha de Pedido</th>
            <th>Prioridad</th>
            <th>Estado</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->number_order}}</td>
            <td>
                {{$order->present()->isTypeCustomer()}}
            </td>
           
            <td>{{$order->date_order}}</td>
            <td class="text-center">{{$order->present()->priority()}}</td>
            <td class="text-center" ><div id="td-{{$order->id_order}}">{{$order->present()->status()}}</div></td>
            <td class="text-center">
              
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Opciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        {{$order->present()->typeStatusAprobado()}}
                   
                   
                    @if($order->name=='Pre-Orden')
                    <a id="btn_compra-{{$order->id_order}}"  href='#modalDetail' data-toggle='modal' data-href=" {{ route('purchase.create', $order->id_order) }} " style="display:none" class='dropdown-item compra'> <i class='fa fa-shopping-cart' data-toggle='tooltip' data-placement='top' data-original-title='Orden Compra'></i> Orden de Compra</a>
                    @endif
                    <a id="btn_agenda-{{$order->id_order}}" style="display:none" href='#modalDetail' data-toggle='modal'  class='dropdown-item' data-href=" {{ route('despacho.create', $order->id_order) }}" class='dropdown-item'> <i class='fa fa-calendar' data-toggle='tooltip' data-placement='top' data-original-title='Agendar Vehiculo'></i> Agendar Vehiculo</a>
                    
                    <a id="btn_carga-{{$order->id_order}}"  style="display:none" href='#modalDetail' data-toggle='modal' data-href=" {{ route('create.carga', $order->id_order) }} "  class='dropdown-item'> <i class='fa fa-shopping-cart' data-toggle='tooltip' data-placement='top' data-original-title='Registro de Carga'></i>Registro de Carga</a>
                    <a data-toggle='tooltip' id="btndeny-{{$order->id_order}}" data-placement='top' style="display:none" data-original-title='Rechazado' class='dropdown-item' disabled='disabled'><i class='material-icons'>visibility_off</i></button>			
                    <a  target="_blank" href='{{ route("order.history", $order->id_order)  }}' class="dropdown-item" data-id="{{ $order->id_order }}"><i class='fa fa-paperclip'  data-toggle='tooltip' data-placement='top' data-original-title='Historial '></i> Historial</a>
                    <a target="_blank" href='{{ route("report.order", $order->id_order)  }}' class="dropdown-item"><i class='fa fa-print'  data-toggle='tooltip' data-placement='top' data-original-title='Imprimir '></i> Imprimir</a>
                    
                    @if ($order->name=='Entregado (C)' || $order->name=='Agendado')
                    <a href='{{ route("clonar", $order->id_order)  }}' class="dropdown-item"><i class='fa fa-copy'  data-toggle='tooltip' data-placement='top' data-original-title='Imprimir '></i> Clonar</a>
                        
                    @endif
                    @if($order->name=='Agendado')
                    <a id="btn_carga-{{$order->id_order}}"  href='#modalDetail' data-toggle='modal' data-href=" {{ route('create.carga', $order->id_order) }} "  class='dropdown-item'> <i class='fa fa-shopping-cart' data-toggle='tooltip' data-placement='top' data-original-title='Registro de Carga'></i>Registro de Carga</a>
                    <a id="btn-ea-{{ $order->id_order }}" href='{{ route("schedule.edit", $order->id_order) }}'   class='dropdown-item'  > <i class='fa fa-edit' data-toggle='tooltip' data-placement='top' data-original-title='Editar Agenda'></i> Editar Agenda</a>

                    @endif
                    
                    <a id="btn-ea-{{ $order->id_order }} " style="display:none" href='{{ route("schedule.edit", $order->id_order) }}'   class='dropdown-item btn-eda'  > <i class='fa fa-edit' data-toggle='tooltip' data-placement='top' data-original-title='Editar Agenda'></i> Editar Agenda</a>
                    <a id="btn-ea-{{ $order->id_order }} " style="display:none" href='{{ route("schedule.edit", $order->id_order) }}'   class='dropdown-item btn-eda'  > <i class='fa fa-edit' data-toggle='tooltip' data-placement='top' data-original-title='Registrar Carga'></i> Registrar Carga </a>
                   

                    
                    
                     
                    </div><!-- dropdown-menu -->
                  </div><!-- dropdown -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>