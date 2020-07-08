<table class="table table-condensed table-bordered table-striped table-hover js-basic-example dataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Conductor</th>
            <th>Vehiculo</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Preguntar Por</th>									
            <th>Estado</th>									
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id_order}}</td>
            <td>
                {{$order->conductor}}
            </td>
            <td>
                {{$order->placa}}
            </td>
            <td>
                {{$order->date_departure}}
            </td>

            <td>
                {{$order->time_departure}}
            </td>
            <td>
                {{$order->description}}
            </td>
            <td>
                <span id="td-{{ $order->id_order }}">{{ $order->observation }}</span>
            </td>
            
            
            <td>
                <a href='#modalDetail' data-toggle='modal' type='button' data-id="{{ $order->id_order }}"  data-href=" {{  route('orders.detail', $order->id_order) }}" class='btn btn-info btn-sm btn-oblong'><i class='fa fa-eye'  data-toggle='tooltip' data-placement='top' data-original-title='Ver Detalles'></i> </a>
               @if ($order->id_order_status==8)
                <a id="btninicio-{{ $order->id_order }}" data-target="#modalInicio" data-toggle='modal' class='btn btn-primary btn-sm btn-oblong ' data-id="{{$order->id_order}}" data-status="{{$order->id_order_status}}"><i class='fa fa-car'  data-toggle='tooltip' data-placement='top' data-original-title='Inicio Entrega'></i> </a>
                <a  id="btnentrega-{{ $order->id_order }}" style="display: none" data-target="#modalEntrega" data-toggle='modal' class='btn btn-success btn-sm btn-oblong' data-id="{{$order->id_order}}" data-status="{{$order->id_order_status}}"><i class='fa fa-save'  data-toggle='tooltip' data-placement='top' data-original-title='Guardar Entrega'></i> </a>
               
                   
               @endif
               @if ($order->id_order_status==11)
               
                <a  id="btnentrega-{{ $order->id_order }}" data-target="#modalEntrega" data-toggle='modal' class='btn btn-success btn-sm btn-oblong' data-id="{{$order->id_order}}" data-status="{{$order->id_order_status}}"><i class='fa fa-save'  data-toggle='tooltip' data-placement='top' data-original-title='Guardar Entrega'></i> </a>
                   
               @endif
               
              

               
              
            </td>
        </tr>
        @endforeach
    </tbody>
</table>