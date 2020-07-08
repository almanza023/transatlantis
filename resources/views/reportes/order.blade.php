<!doctype html>
<html lang="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
    <title>Reporte Orden de Pedido</title>  
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
    <style>
        .page-break {
            page-break-after: always;}

    .tr-color{
        background-color: #ff8000;
        color: black;
        
    }
   </style>
</head>

<body>   
    <div class="container">      
            <div class="header">
            <img src="../public/images/logo.png" alt="" width="100px;" height="50px;">
            <h1 class="text-center font-bold"><b>ATLANTIS SOFT</b></h1>
            <h3 class="text-center">ORDEN DE PEDIDO</h3>      
            <p >FECHA DE IMPRESION: {{ $fecha }} </p>
            </div>
      
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th colspan="2" class="text-center">DATOS DE CLIENTE</th>
                </tr>
                
                <tr>
                    <th>NOMBRE</th>
                    <td>{{ $order->present()->customerJuridico() }}</td>
                </tr>
                <tr>
                    <th>DIRECCION ENTREGA</th>
                    <td>{{$order->address.' '.$order->additional .' '.$order->name_municipality
                        .' - '.$order->name_departament}}</td>
                </tr>

                          
                
            </thead>            
        </table>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th colspan="2" class="text-center">DATOS DE ORDEN</th>
                </tr>
                <tr>
                    <th>#</th>
                    <td>{{$order->id_order}}</td>
                </tr>
                <tr>
                    <th>TIPO PAGO</th>
                    <td>{{$order->type_payment}}</td>
                </tr>
                <tr>
                    <th>FECHA ORDEN</th>
                    <td>{{$order->date_format}}</td>
                </tr>
                <tr>
                    <th>TIEMPO PAGO</th>
                    <td>{{$order->time_payment}}</td>
                </tr>
                     
            </thead>
            <tbody>
               
            </tbody>
        </table>

        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th colspan="5" class="text-center">HISTORIAL DE ORDEN</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>ESTADO</th>
                    <th>FECHA</th>                   
                </tr>                
            </thead>
            <tbody>
               
                @foreach ($histories as $history)
               
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$history->observation}}</td>
                    <td>{{$history->date_format}}</td>
                 
                </tr>

                @endforeach
            </tbody>
        </table>

       
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th colspan="5" class="text-center">DESCRIPCION DE ORDEN</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO </th>
                    <th>SUBTOTAL</th>
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
        </table>
        <table class="table table-condensed table-bordered ">
                    
            <tr>
                <th>DESCUENTO</th>
                @if ($order->discount>0)
                $total_factura=$total_factura- ($total_factura*($order->discount/100))
                <td>$ {{number_format( ($total_factura*($order->discount/100)) )}}</td>
                @else

                <td>0</td>
                @endif
            </tr>
            <tr>
                <th>TOTAL</th>
                <td>$ {{ number_format($total_factura) }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ strtoupper(NumerosEnLetras::convertir($total_factura).' PESOS') }}</td>
            </tr>
        </table><br>

    @if(count($entregas)>0)
    <table class="table table-condensed table-bordered ">
        <thead>
            <tr class="tr-color">
                <th colspan="5" class="text-center">DETALLES DE ENTREGA</th>
            </tr>
            <tr>
                <th>#</th>
                <th>CONDUCTOR</th>
                <th>VEHICULO</th>                   
                <th>FECHA</th>                   
            </tr>                
        </thead>
        <tbody>
           
            @foreach ($entregas as $entrega)
           
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$entrega->conductor}}</td>
                <td>{{$entrega->placa}}</td>
                <td>{{$entrega->date.' '.$entrega->hour}}</td>
             
            </tr>

            @endforeach
        </tbody>
    </table>
    @endif
    
    @if(count($factura)>0)
    <table class="table table-condensed table-bordered ">
        <thead>
            <tr class="tr-color">
                <th colspan="5" class="text-center">DETALLES DE FACTURACION</th>
            </tr>
            <tr>
                
                <th>FECHA</th>
                <th>VALOR</th>                   
                                   
            </tr>    
            
            <tr>
                
                <th>{{$factura[0]->date}}</th>
                <td colspan="2">$ {{number_format($factura[0]->total ) }}</td>        
                                   
            </tr>   
        </thead>
       
    </table>
    @endif
    </div>




</body>


</html>