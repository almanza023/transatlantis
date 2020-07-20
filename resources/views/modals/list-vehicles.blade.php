
<!-- LARGE MODAL -->
<div id="modalVehicle" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">LISTADO DE VEHICULOS</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-20" >
            <h5 class=" lh-3 mg-b-20"></h5>
            <div class="card-body" style="width: 500px">
                <form id="form_items" style="width: 100%">  
                    <fieldset>
    
                        <div class="col-md-12">
    
                            <div class="well">
                               <label for="" id="lbl-date">Fecha</label>
                               <label for="" id="lbl-hour">Hora</label>
                               <input type="hidden" class="form-control" name="date-order" id="date-order">
                               <input type="hidden" class="form-control" name="date-time" id="date-time">
                            </div>

                         
                        </div>   
    
                        <div class="col-md-12">
                            <label for="placa-999">Vehiculos</label>
                            <div class="form-group">
                                <div class="">
                                    <select class="form-control " name="placa[]" onchange="findDriver(this);"
                                        id="placa-999" data-live-search="true">
                                        <option value="">Vehiculos (PLACA)</option>
                                        @foreach ($vehicles as $vehicle)
                                        <option value="{{$vehicle->placa.'-'.$vehicle->nid_driver}}">{{$vehicle->placa. '- '.$vehicle->first_name.' '.$vehicle->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-12">
                            <label for="nro_viaje-999">Nro Viajes</label>
                            <div class="form-group">
                                <div class="">
                                    <input type="number" name="nro_viaje[]" id="nro_viaje-999" class="form-control">
                                </div>
                            </div>
                        </div>
    
    
                        <div class="col-md-12">
                            <label for="time_stimated-999">Tiempo Estimado (Min?)</label>
                            <div class="form-group">
                                <div class="">
                                    <input type="number" name="time_stimated[]" id="time_stimated-999" class="form-control">
                                </div>
                            </div>
                        </div>
    
    
                        <div class="col-md-12">
                            <label for="description_carga-999">Descripción de Carga</label>
                            <div class="form-group">
                                <div class="">
                                    <textarea class="form-control" id="description_carga-999" name="description_carga[]"
                                        minlength="5"></textarea>
                                </div>
                            </div>
                        </div>
    
                        
                    </fieldset>
                    <div class="col-md-12">
                    <button id="btnAdd" type="button" class="btn btn-primary bg-oblong align-center">
                        <i class="fa fa-plus"></i>
                        <span> AÑADIR</span>
                    </button>
                    </div>
    
                </form>
            </div> 

         </div>
         <!-- modal-body -->
         <div class="modal-footer">           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
         </div>
      </form>
      </div>
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->
