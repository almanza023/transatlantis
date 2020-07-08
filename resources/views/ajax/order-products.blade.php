<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <h2 class="tx-center font-bold col-teal">DETALLES</h2>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table">
                        <tr>
                            <th>
                                CLIENTE
                            </th>
                            <td>{{ $customer[0]->cliente }}</td>
                        </tr>
                        <tr>
                            <th>
                                CLIENTE
                            </th>
                            <td>{{ $customer[0]->nid }}</td>
                        </tr>
                        <tr>
                            <th>
                                DIRECCIÓN
                            </th>
                            <td>{{ $customer[0]->address. ' '.$customer[0]->municipio }}</td>
                        </tr>
                        
                    </table>
                    <table class="table table-hover dashboard-task-infos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Solicitado</th>
                                <th>Proveedor</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($order->orderDetails as $detail)
                        
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$detail->product->name_product}}</td>
                                <td>{{$detail->amount}} ({{$detail->product->typeUnit->type_unit}})</td>
                                <td>
                                    @foreach ($detail->providers as $provider)
                                        {{$provider->full_name}} ({{$provider->first_name}} {{$provider->last_name}})<br>
                                        {{$provider->address}}
                                    @endforeach
                                </td>
                            </tr>

                            @endforeach

                        </tbody>

                        <div>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
