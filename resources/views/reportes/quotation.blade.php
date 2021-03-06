<!doctype html>
<html lang="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
    <title>Reporte de Cotización</title>  
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
            <h3 class="text-center">COTIZACIÓN</h3>      
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
                    <th>DIRECCION</th>
                    <td>{{$order->address.' '.$order->additional .' '.$order->name_municipality
                        .' - '.$order->name_departament}}</td>
                </tr>
                                    
                </tr>
            </thead>            
        </table>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th colspan="2" class="text-center">DATOS DE ORDEN</th>
                </tr>
                
                <tr>
                    <th>ESTADO</th>
                    <td>{{ $history->observation }}</td>
                </tr>           
            </thead>
            <tbody>
               
            </tbody>
        </table>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th colspan="5" class="text-center">DESCRIPCION DE COTIZACIÓN</th>
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
                <th>TOTAL</th>
                <td>$ {{ number_format($total_factura) }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ strtoupper(NumerosEnLetras::convertir($total_factura).' PESOS') }}</td>
            </tr>
        </table><br>

    </div>




</body>


</html>