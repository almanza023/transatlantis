<!doctype html>
<html lang="en">

<head>
    <title>Reporte</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</head>

<body>

    <div class="container">
        <div class="jumbotron">
            <p>Esquema v1: Pendiente</p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th># Orden</th>
                        <th># Agenda</th>
                        <th>Fecha</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">{{$order->id_order}}</td>
                        <td>{{$order->id_order_schedule}}</td>
                        <td>{{$order->date_departure}} {{$order->time_departure}}</td>
                        <td>{{$order->description}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Listado de Vehiculos</div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Vehiculos</th>
                            <th>Chofer</th>
                            <th>Descripcion Carga</th>
                            <th>Tiempo de Retorno</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->vehicles as $vehicle)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><li>{{$vehicle->placa}}</li></td>
                            <td>
                                @foreach ($vehicle->currentDriver as $driver)
                                <li>{{$driver->first_name}} {{$driver->last_name}}</li>
                                @endforeach
                            </td>
                            <td>
                                <li>{{$vehicle->pivot->description_carga}}</li>
                            </td>
                            <td>
                                <li>{{$vehicle->pivot->time_stimated}}</li>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Detalle de Carga</div>
            <div class="panel-body">
                <table class="table table-hover dashboard-task-infos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order->orderDetails as $detail)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$detail->product->name_product}} </td>
                            <td>{{$detail->amount}}</td>
                            <td>
                                @foreach($detail->providers as $provider)   
                                <li>
                                    {{ $provider->full_name }} {{$provider->address}} {{$provider->municipality->name_municipality}} 
                                </li>
                                @endforeach
                            </td>       
                        </tr>
                        @endforeach

                    </tbody>

                    <div>
                </table>
                
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Detalle del Cliente</div>
            <div class="panel-body">
                <table class="table table-hover dashboard-task-infos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Direccion</th>
                            <th>Municipio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order->nid}}</td>
                            <td>{{$order->first_name}} {{$order->last_name}} </td>
                            <td>{{$order->address}}, {{$order->additional}} </td>
                            <td>{{$order->name_municipality}} ({{$order->name_departament}})</td>           
                        </tr>
                       
                    </tbody>

                    <div>
                </table>
                <div class="col-md-8 col-sm-8"></div>
                
            </div>
            <div class="panel-footer">Atlantis &copy; 2020</div>
        </div>




    </div>

</body>


</html>