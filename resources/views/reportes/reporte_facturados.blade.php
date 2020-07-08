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
            <h3 class="text-center">REPORTE PEDIDOS FACTURADOS </h3>     
            <P>DESDE: <b>{{ $date1 }}</b> - HASTA: <b>{{ $date2 }}</b> </P> 
            <p >FECHA DE IMPRESION: {{ $fecha }} </p>
            </div>
      
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color" >
                    <th class="text-center" colspan="7">DATOS DE FACTURADOS</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>CLIENTE</th>
                    <th>IDENTIFICACION</th>
                    <th>N° ORDEN</th>
                    <th>FECHA</th>
                    <th>TOTAL</th>
                    <th>FACTURADO POR</th>


                </tr>
                
            </thead>           
            <tbody>
                @php
                $suma=0;
                @endphp
                @foreach ($orders as $order)
                @php
                   
                    $suma+=$order->total;
                @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->cliente }}</td>
                         <td>{{ $order->nid }}</td>
                         <td>{{ $order->id_order }}</td>
                         <td>{{ $order->date }}</td>
                         <td>{{ '$'. number_format($order->total) }}</td>
                         <td>{{ $order->realizado }}</td>
                    </tr>
                @endforeach
            </tbody> 
        </table>
        <table class="table">
            <tr>
                <th>TOTAL FACTURADO</th>
                <td>{{ '$'. number_format($suma) }}</td>
            </tr>
        </table>
       

    </div>




</body>


</html>