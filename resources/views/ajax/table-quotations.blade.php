
<table class="table table-condensed table-bordered table-striped table-hover js-basic-example dataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Fecha de Cotización</th>            
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
            <td class="text-center"><div id="td-{{$order->id_order}}">{{$order->present()->status()}}</div></td>
            <td class="text-center">              
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Opciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        {{$order->present()->typeStatusAprobado()}}                   
                        @if (auth()->user()->hasRole('cliente') and $order->id_order_status==12 and $order->status==1)
                        <a href="{{ route('quotation.show', $order) }}" class="dropdown-item"><i class='fa fa-check'  data-toggle='tooltip' data-placement='top' data-original-title='Aprobar '></i> Aprobar</a>
                         
                        @endif
                        @if (auth()->user()->hasRole('super-admin'))
                        <a  href='{{ route("quotation.edit", $order->id_order)  }}' class="dropdown-item"><i class='fa fa-edit'  data-toggle='tooltip' data-placement='top' data-original-title='Aprobar Cotización '></i> Aprobar Cotización</a>
                        <a target="_blank" href='{{ route("report.quotation", $order->id_order)  }}' class="dropdown-item"><i class='fa fa-print'  data-toggle='tooltip' data-placement='top' data-original-title='Imprimir '></i> Imprimir</a>    
                        @endif
                        <a target="_blank" href='{{ route("detalles.quotation", $order->id_order)  }}' class="dropdown-item"><i class='fa fa-clipboard'  data-toggle='tooltip' data-placement='top' data-original-title='Detalles '></i> Detalles</a>
                    
                     
                    </div><!-- dropdown-menu -->
                  </div><!-- dropdown -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>