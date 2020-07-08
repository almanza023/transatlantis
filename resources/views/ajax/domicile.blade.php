<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center font-bold col-teal">DOMICILIO ACTUAL DEL CLIENTE</h2>
            </div>
            <div class="body">

                <ul class="list-group">
                    <li class="list-group-item"><div id="customer_domicile">{{$domicile->address}}, {{$domicile->additional}},
                        {{$domicile->municipality->name_municipality}} - {{$domicile->municipality->departament->name_departament}}</div>
                        <span class="badge bg-pink">
                            <a style="color:aliceblue" role="button" data-toggle="collapse"
                                href="#collapseExample" aria-expanded="false"
                                aria-controls="collapseExample">Añadir nuevo domicilio
                            </a>
                        </span>
                </ul>

              
            </div>
        </div>
    </div>
</div>

<div class="collapse" id="collapseExample">
    <form id="form_domicile" method="POST" action="{{route('domicile.save')}}" autocomplete="off">


        <fieldset>

        <input type="hidden" id="id_customer" name="id_customer" value="{{$customer->nid}}">

            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-line">
                        <select class="form-control show-tick"
                            name="id_departamento" id="departamento_customer_new"
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
                            name="id_municipality" id="municipality_customer_new"
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
                        <textarea class="form-control" id="address_customer_new"
                            name="address"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label for="additional">Info Adicional</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea class="form-control" id="additional_customer_new"
                            name="additional"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label for="contact_number"># Celular</label>
                <div class="form-group">
                    <div class="form-line">
                        <input class="form-control" id="contact_number_customer_new"
                            name="contact_number">
                    </div>
                </div>
            </div>

        </fieldset>

        <button id="btnsavedomicile" type="button" class="btn bg-indigo waves-effect align-center">
            <i class="material-icons">save</i>
            <span>AÑADIR</span>
        </button>

    </form>

</div>
