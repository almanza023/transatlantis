<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header bg-default">
                <h2>INFORMACION DETALLADA DEL PROVEEDOR</h2>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <table class="table table-hover dashboard-task-infos">
                        <tbody>
                            <tr>
                                <th>NIT</th>
                                <td>{{$provider->nit}}</td>
                            </tr>
                            <tr>
                                <th>Tipo</th>
                                <td>{{$provider->typeProvider->type_provider}}</td>
                            </tr>
                            <tr>
                                <th>Proveedor</th>
                                <td>{{$provider->present()->isTypeProvider()}}</td>
                            </tr>
                            <tr>
                                <th>Ubicacion</th>
                                <td>
                                    <li>Lugar: {{$provider->municipality->name_municipality}}
                                        ({{$provider->municipality->departament->name_departament}})</li>
                                    <li>Direccion: {{$provider->address}}</li>
                                </td>
                            </tr>
                            <tr>
                                <th>Informacion Contacto</th>
                                <td>
                                    <li>Email: {{$provider->email}})</li>
                                    <li># Contacto: {{$provider->contact_number}})</li>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{$provider->present()->textActiveProvider()}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>