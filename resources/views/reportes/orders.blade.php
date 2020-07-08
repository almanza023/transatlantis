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
                <h4 class="text-center">REPORTE DE PEDIDO </h4><br>                           
                <p >Fecha De Elaboración: {{ $fecha }}</p>
    
    
        </div>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Fecha de Pedido</th>
                    <th>Prioridad</th>
                    <th>Estado</th>                  
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
                    <td class="text-center"><div id="td-{{$order->id_order}}">{{$order->present()->status()}}</div></td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>




</body>


</html>