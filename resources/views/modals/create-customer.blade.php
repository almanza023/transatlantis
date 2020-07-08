<!-- LARGE MODAL -->
<div id="createCustomer" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning" >
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">REGISTRO DE CLIENTES</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-20">
            <h5 class=" lh-3 mg-b-20"></h5>
            <form id="form_create" method="POST" action="{{ route('customers.store') }}"
               autocomplete="off">
               @csrf
               
             <div class="table-responsive">
               <table class="table ">
                  <tr>
                     <td colspan="3">
                        <legend>
                            <h5 class="font-bold col-light-green text-center">Información Básica</h5>
                         </legend>
                       </td>
                  </tr>
                  <tr>
                      <td>
                       <div class="form-group">
                           <label for="nid" class="col-red"># NID</label>
                           <div class="form-group">
                              <div class="form-line">
                                 <input type="number" class="form-control" name="nid">
                              </div>
                           </div>
                        </div>
                      </td>
                      <td>
                       <div class="form-group">
                           <label for="id_type_customer">Tipo Cliente</label>
                           <div class="form-group">
                              <div class="form-line">
                                 <select class="form-control show-tick" name="id_type_customer"
                                    data-live-search="true"
                                    data-show-subtext="true">
                                    <option value="">-- Seleccionar Tipo Cliente --</option>
                                    @foreach ($typecustomers as $typecustomer)
                                    <option data-subtext="{{$typecustomer->description}}"
                                       value="{{$typecustomer->id_type_customer}}">
                                       {{$typecustomer->type_customer}}
                                    </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>   
                      </td>
                      <td>
                       <div class="form-group">
                           <label for="full_name">Razon Social (Opcional)</label>
                           <div class="form-group">
                              <div class="form-line">
                                 <input type="text" class="form-control" name="full_name">
                              </div>
                           </div>
                        </div>
                      </td>
                      
                  </tr>
                  <tr>
                     <td>
                       <div class="form-group">
                           <label for="first_name">Nombres</label>
                           <div class="form-group">
                              <div class="form-line">
                                 <input type="text" class="form-control" name="first_name">
                              </div>
                           </div>
                        </div>
                       </td> 
                       <td>
                           <div class="form-group">
                               <label for="last_name">Apellidos</label>
                               <div class="form-group">
                                  <div class="form-line">
                                     <input type="text" class="form-control" name="last_name">
                                  </div>
                               </div>
                            </div>
                       </td>

                       <td>
                           <div class="col-md-12">
                               <label for="email">Correo Electronico</label>
                               <div class="form-group">
                                  <div class="form-line">
                                     <input type="email" class="form-control" name="email">
                                  </div>
                               </div>
                            </div>
                       </td>
                  </tr>
                  <tr>
                      <td colspan="3">
                       <legend>
                           <h5 class="font-bold col-light-green text-center">Información Contacto</h5>
                        </legend>
                      </td>
                  </tr>
                  <tr>
                   
                   <td>
                       <div class="form-group">
                           <div class="form-group">
                             <label for="address">Departamento</label>
                              <div class="form-line">
                                 <select class="form-control departaments" name="id_departamento"
                                    data-live-search="true" onchange="changeDepartaments(this.value,1)">
                                    <option value="">--Escoger Departamento--
                                    </option>
                                    @foreach ($departaments as $departament)
                                    <option value="{{$departament->id_departament}}">
                                       {{$departament->name_departament}}
                                    </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                   </td>
                   <td>
                       <div class="form-group">
                           <div class="form-group">
                             <label for="address">Municipio</label>
                              <div class="form-line">
                                 <select class="form-control show-tick" name="id_municipality" id="municipality"
                                    data-live-search="true">
                                    <option value="">--Escoger Municipio--
                                    </option>
                                 </select>
                              </div>
                           </div>
                        </div>
                   </td>
                   <td>
                       <div class="form-group">
                           <label for="address">Dirección de Entrega</label>
                           <div class="form-group">
                              <div class="form-line">
                                 <input class="form-control"
                                    name="address" />
                              </div>
                           </div>
                        </div>
                   </td>
                   
                  </tr>
                  <tr>
                      <td>
                       <div class="form-group">
                           <label for="additional">Info Adicional</label>
                           <div class="form-group">
                              <div class="form-line">
                                 <input class="form-control"
                                    name="additional" />
                              </div>
                           </div>
                        </div>
                      </td>
                     
                      <td>
                       <div class="form-group">
                           <label for="contact_number"># Celular</label>
                           <div class="form-group">
                              <div class="form-line">
                                 <input class="form-control"
                                    name="contact_number">
                              </div>
                           </div>
                        </div>
                      </td>
                  </tr>
              </table>  
            </div>     
           
         </div>
         <!-- modal-body -->
         <div class="modal-footer">
            <button type="button"  id="btnsave" class="btn btn-primary"> <i class="fa fa-save"> </i> GUARDAR</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
         </div>
      </form>
      </div>
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->