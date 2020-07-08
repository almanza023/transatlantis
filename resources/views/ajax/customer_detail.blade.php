
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th class="text-center" colspan="4">
                            INFORMACION DE CLIENTE
                        </th>
                    </tr>
                    <tr>
                       
                        <th>
                            NID
                        </th>
                        <td>{{ $customer->nid }}</td>
                    </tr>
                  
                    <tr>
                        <th>
                            TIPO CLIENTE
                        </th>
                        @foreach ($typecustomers as $typecustomer)
                        @if ($customer->id_type_customer == $typecustomer->id_type_customer)
                        <td>{{$typecustomer->description}}</td>
                        @else                                       
                        @endif
                        @endforeach 
                        <th>
                            RAZON SOCIAL
                        </th>
                        <td>{{$customer->full_name}}</td>
                    </tr>
                   

                    <tr>
                        <th>
                            NOMBRES
                        </th>
                        <td>{{$customer->first_name}}</td>
                        <th>
                            APELLIDOS
                        </th>
                        <td>{{$customer->last_name}}</td>
                    </tr>
                       
                    </tr>
                    <tr>
                        <th>
                            CORREO ELECTRONICO
                        </th>
                        <td>{{$customer->email}}</td>
                    </tr>
                    <tr>
                        <th class="text-center" colspan="4">
                            INFORMACION DE CONTACTO
                        </th>
                    </tr>
                    <tr>
                        <th>
                            DEPARTAMENTO
                        </th>
                        
                        @foreach ($departaments as $departament)
                        @if($domicile->municipality->departament->id_departament ==
                        $departament->id_departament)
                        <td> {{$departament->name_departament}}</td>
                        @else
                        
                        @endif
                    @endforeach
                    <th>
                        MUNICIPIO
                    </th>
                    
                    @foreach ($municipalities as $municipality)
                                        @if($domicile->municipality->id_municipality ==
                                        $municipality->id_municipality)
                                        <td>{{$municipality->name_municipality}}</td>
                                        @else
                                      
                                        @endif
                    @endforeach
                    </tr>
                   
                    <tr>
                        <th>
                            DIRECCIÓN
                        </th>
                        <td>{{$domicile->address}}</td>
                        <th>
                            INFO ADICIONAL
                        </th>
                        <td> {{$domicile->additional}}</td>
                    </tr>
                    
                    <tr>
                        <th>
                            # CELULAR
                        </th>
                        <td>{{$domicile->contact_number}}</td>
                    </tr>
                </table>
            </div>                        
    </div>
</div>


