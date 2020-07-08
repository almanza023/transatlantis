<!doctype html>
<html lang="en">

<head>
    <title>Reporte</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <style>
        
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
            <h2 class="text-center font-bold"><b>ATLANTIS SOFT</b></h2>
            <h4 class="text-center">REPORTE DE PEDIDOS POR CONDUCTOR</h4><br>     
            
            <p >Fecha De Elaboración: {{ $fecha }}</p>


        </div>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th># ORDEN</th>
                    <th>CONDUCTOR</th>
                    <th>VEHICULO</th>
                    <th>FECHA AGENDA</th>
                    <th>FECHA ENTREGA</th>
                    <th>OBSERVACIONES</th>                                      
                </tr>
            </thead>
            <tbody>
                @php
                $min=0;
                $sumd=0;
                @endphp
                @foreach($orders as $order)
               
                <tr>
                    <td class="tx-center">{{$order->id_order}}</td>
                    <td class="tx-center">{{$order->conductor}}</td>   
                    <td class="tx-center">{{$order->placa}}</td>                   
                    <td>
                        {{$order->date_departure.' '.$order->time_departure}}
                    </td>  
                    <td>
                        {{$order->date.' '.$order->hour}}
                    </td>                     
                                                       
                    <td>{{$order->observation}} Min</td>                   
                </tr>
                @endforeach
                
            </tbody>
            
        </table>
               

    </div>




</body>
@if (session()->has('warning'))
<script type="text/javascript">
	success('{{ session('warning') }}');
</script>
@endif

</html>