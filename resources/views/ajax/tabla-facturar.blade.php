
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
            <td>{{$order->id_order}}</td>
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
                   <a data-toggle='tooltip' id="btndeny-{{$order->id_order}}" data-placement='top' style="display:none" data-original-title='Rechazado' class='dropdown-item' disabled='disabled'><i class='material-icons'>visibility_off</i></button>			
                    <a  target="_blank" href='{{ route("order.history", $order->id_order)  }}' class="dropdown-item" data-id="{{ $order->id_order }}"><i class='fa fa-paperclip'  data-toggle='tooltip' data-placement='top' data-original-title='Historial '></i> Historial</a>
                    <a target="_blank" href='{{ route("report.order", $order->id_order)  }}' class="dropdown-item"><i class='fa fa-print'  data-toggle='tooltip' data-placement='top' data-original-title='Imprimir '></i> Imprimir</a>
                  
                   

                    
                    
                     
                    </div><!-- dropdown-menu -->
                  </div><!-- dropdown -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>