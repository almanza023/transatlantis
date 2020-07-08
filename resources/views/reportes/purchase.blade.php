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
            <h4 class="text-center">REPORTE DE COMPRA </h4><br>                           
            <p >Fecha De Elaboración: {{ $date }}</p>


    </div>
    <div class="container">
        <div class="jumbotron">            
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th># Orden</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">{{$order->id_order}}</td>
                        <td>{{$order->fecha}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        
                <table class="table">
                    <thead>
                        <tr class="tr-color">
                            <th>#</th>
                            <th>Productos</th>
                            <th>Cantidad</th>
                            <th>Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{$detail->product->name_product}}</td>
                            <td>{{$detail->amount}}</td>
                            <td>
                                @foreach ($detail->providers as $provider)
                                  {{$provider->full_name}}
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
           


    </div>




</body>


</html>