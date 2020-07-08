

<!-- LARGE MODAL -->
<div id="modalDomicile" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">DETALLES</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-20">
           
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header bg-default">
                            <h2 class="tx-center font-bold col-teal">DOMICILIO ACTUAL DEL CLIENTE</h2>
                        </div>
                        <div class="card-body">

                            <ul class="list-group">
                                <li class="list-group-item"><div id="customer_domicile">Calle 42 I # 17 - 71 Barrio La esmeralda
                                    Sincelejo-Sucre</div>
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
                <div class="card">
                    <div class="card-header bg-default">
                        <h2 class="tx-center font-bold col-teal">DATOS DE DOMICILIO</h2>
                    </div>
                <div class="card-body">
                <form id="form_domicile" method="POST" action="{{route('domicile.save')}}" autocomplete="off">
                    
                    @csrf

                    <fieldset>

                        <input type="hidden" id="id_customer" name="id_customer">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick"
                                        name="id_departamento" id="departamento_customer_new" onchange="changeDepartaments(this.value)"
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
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <label for="address">Direccion</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control" id="address_customer_new"
                                        name="address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="additional">Info Adicional</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control" id="additional_customer_new"
                                        name="additional"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="contact_number"># Celular</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input class="form-control" id="contact_number_customer_new"
                                        name="contact_number">
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <div class="col-md-12">
                    <button id="btnsavedomicile" type="button" class="btn btn-success btn-circle-lg align-center">
                        <i class="fa fa-save"></i>
                        <span> AÑADIR</span>
                    </button>
                    </div>

                </form>

            </div>
            </div>
            </div>


         </div>
         <!-- modal-body -->
         <div class="modal-footer">
           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
         </div>

      </div>
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->