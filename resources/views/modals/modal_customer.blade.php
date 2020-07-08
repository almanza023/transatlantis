<div class="modal fade" id="modalCreateCustomer" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="text-center font-bold col-teal">REGISTRO DE CLIENTE</h2>
                            </div>
                            <div class="body">
                            <form id="form_customer" method="POST" action="{{route('customer.save')}}" autocomplete="off">

                                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                        <div class="panel-group" id="accordion_17" role="tablist"
                                            aria-multiselectable="true">

                                            <div class="panel panel-col-indigo">
                                                <div class="panel-heading" role="tab" id="headingFive_17">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            data-parent="#accordion_17" href="#collapseFive_17"
                                                            aria-expanded="false" aria-controls="collapseFive_17">
                                                            <i class="material-icons">contact_phone</i> INFORMACION DEL
                                                            CLIENTE
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFive_17" class="panel-collapse collapse in"
                                                    role="tabpanel" aria-labelledby="headingFive_17">
                                                    <div class="panel-body">
                                                        <fieldset>


                                                            <div class="col-md-4">
                                                                <label for="nid" class="col-red"># NID</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="number" class="form-control"
                                                                            name="nid" id="nid">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="id_type_customer">Tipo Cliente</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <select class="form-control show-tick"
                                                                            name="id_type_customer"
                                                                            id="id_type_customer"
                                                                            data-live-search="true"
                                                                            data-show-subtext="true">
                                                                            <option value="">-- Seleccionar Tipo Cliente --</option>
                                                                            @foreach ($typecustomers as $typecustomer)
                                                                            <option
                                                                                data-subtext="{{$typecustomer->description}}"
                                                                                value="{{$typecustomer->id_type_customer}}">
                                                                                {{$typecustomer->type_customer}}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="id_type_customer">Tipo Documento</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <select class="form-control show-tick"
                                                                            name="type_identification"
                                                                            id="type_identification">
                                                                            <option value="">-- Seleccionar Tipo Documento --</option>
                                                                            <option value="C.C">Cedula Ciudadania</option>
                                                                            <option value="C.E">Cedula Extranjeria</option> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <label for="full_name">Razon Social (Opcional)</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control"
                                                                            name="full_name" id="full_name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="first_name">Nombres</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control"
                                                                            name="first_name" id="first_name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="last_name">Apellidos</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control"
                                                                            name="last_name" id="last_name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="email">Correo Electronico</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="email" class="form-control"
                                                                            name="email" id="email">
                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </fieldset>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-col-cyan">
                                                <div class="panel-heading" role="tab" id="headingTwo_17">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            data-parent="#accordion_17" href="#collapseTwo_17"
                                                            aria-expanded="false" aria-controls="collapseTwo_17">
                                                            <i class="material-icons">cloud_download</i> DOMICILIO
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_17" class="panel-collapse collapse" role="tabpanel"
                                                    aria-labelledby="headingTwo_17">
                                                    <div class="panel-body">

                                                        <fieldset>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <select class="form-control show-tick"
                                                                            name="id_departamento" id="departamento_customer"
                                                                            data-live-search="true">
                                                                            <option value="">--Escoger Departamento--
                                                                            </option>
                                                                            @foreach ($departaments as $departament)
                                                                            <option
                                                                                value="{{$departament->id_departament}}">
                                                                                {{$departament->name_departament}}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <select class="form-control show-tick"
                                                                            name="id_municipality" id="municipality_customer"
                                                                            data-live-search="true">
                                                                            <option value="">--Escoger Municipio--
                                                                            </option>
                                                                    
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="address">Direccion</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <textarea class="form-control" id="address_customer"
                                                                            name="address"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="additional">Info Adicional</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <textarea class="form-control" id="additional_customer"
                                                                            name="additional"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="contact_number"># Celular</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input class="form-control" id="contact_number_customer"
                                                                            name="contact_number">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </fieldset>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    <button type="button" id="btnsavecustomer" class="btn bg-teal waves-effect">
                                        <i class="material-icons">save</i>
                                        <span>GUARDAR</span>
                                    </button>



                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

{{--PENDIENTE POR ELIMINAR--}}