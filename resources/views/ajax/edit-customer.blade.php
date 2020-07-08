<div class="card">
  
    <div class="card-body">

        <form id="form_edit" method="POST" action="{{ route('customers.update', $customer->nid) }}" autocomplete="off">

            @csrf
            @method('PATCH')
        
            <fieldset>
        
                <legend>
                    <h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
                </legend>
<div class="row">  
                <div class="col-md-4">
                    <label for="nid" class="col-red"># NID</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" class="form-control" name="nid_customer" id="nid" value="{{$customer->nid}}" readonly disabled>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="nid" value="{{$customer->nid}}">
        
                <div class="col-md-8">
                    <label for="id_type_customer">Tipo Cliente</label>
                    <div class="form-group">
                        <div class="form-line">
                            <select class="form-control show-tick" name="id_type_customer" id="id_type_customer"
                                data-live-search="true" data-show-subtext="true">
                                <option value="">-- Seleccionar Tipo Cliente --</option>
                                @foreach ($typecustomers as $typecustomer)
                                @if ($customer->id_type_customer == $typecustomer->id_type_customer)
                                <option selected data-subtext="{{$typecustomer->description}}"
                                    value="{{$typecustomer->id_type_customer}}">
                                    {{$typecustomer->type_customer}}
                                </option>
                                @else
                                <option data-subtext="{{$typecustomer->description}}"
                                    value="{{$typecustomer->id_type_customer}}">
                                    {{$typecustomer->type_customer}}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
</div>
        
<div class="row">
                <div class="col-md-4">
                    <label for="full_name">Razon Social (Opcional)</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                value="{{$customer->full_name}}">
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <label for="first_name">Nombres</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                value="{{$customer->first_name}}">
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <label for="last_name">Apellidos</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                value="{{$customer->last_name}}">
                        </div>
                    </div>
                </div>
</div>
<div class="row">
                <div class="col-md-12">
                    <label for="email">Correo Electronico</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" id="email" value="{{$customer->email}}">
                        </div>
                    </div>
                </div>
</div>
        
            </fieldset>
        
            <fieldset>
        
        
                <legend>
                    <h5 class="font-bold col-light-green text-center">Informacion Contacto</h5>
                </legend>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <select class="form-control show-tick" name="id_departamento" onchange="changeDepartaments(this.value,2)"
                                data-live-search="true">
                                <option value="">--Escoger Departamento--
                                </option>
                                @foreach ($departaments as $departament)
                                    @if($domicile->municipality->departament->id_departament ==
                                    $departament->id_departament)
                                    <option value="{{$departament->id_departament}}" selected>
                                        {{$departament->name_departament}}
                                    </option>
                                    @else
                                    <option value="{{$departament->id_departament}}">
                                        {{$departament->name_departament}}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <select class="form-control show-tick" name="id_municipality" id="municipality-2"
                                data-live-search="true">
                                <option value="">--Escoger Municipio--</option>
                                @foreach ($municipalities as $municipality)
                                    @if($domicile->municipality->id_municipality ==
                                    $municipality->id_municipality)
                                    <option value="{{$municipality->id_municipality}}" selected>
                                        {{$municipality->name_municipality}}
                                    </option>
                                    @else
                                    <option value="{{$municipality->id_municipality}}">
                                        {{$municipality->name_municipality}}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <label for="address">Dirección Entrega</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control" id="address_customer"
                                name="address">{{$domicile->address}}</textarea>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-6">
                    <label for="additional">Info Adicional</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control" id="additional_customer"
                                name="additional">{{$domicile->additional}}</textarea>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    
                <div class="col-md-6">
                    <label for="contact_number"># Celular</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input class="form-control" id="contact_number_customer" name="contact_number"
                                value="{{$domicile->contact_number}}">
                        </div>
                    </div>
                </div>
        
                <input type="hidden" value="{{$domicile->id_domicile}}" name="id_domicile" required>
        
        
            </fieldset>
        </form>
        
        
        
            <button type="button" onclick="updateCustomer();" class="btn btn-success">
                <i class="fa fa-save"></i>
                <span> ACTUALIZAR</span>
            </button>
        
        
        
        </form>
       
    </div>
</div>

