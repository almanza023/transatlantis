

<!-- LARGE MODAL -->
<div id="modalReversar" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">REVERSAR PEDIDO</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-20">
            <h5 class=" lh-3 mg-b-20"></h5>
           <form action="{{ route('reversar') }}" method="POST" id="form_reversar">
              <input type="hidden" id="id_order" name="id_order">
              <input type="hidden" id="id_admin" name="id_admin" value="{{ auth()->user()->usable_id }}">
              @csrf               
              <div class="row ">
               <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
                   <label for="time_payment">Fecha: </label>
               </div>
               <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
                   <div class="form-group">
                       <div class="form-line">
                           <input type="date" class="form-control" id="date" name="date"  >                   
                       </div>
                   </div>
               </div>
              </div>

              <div class="row ">
               <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
                   <label for="time_payment">Estado: </label>
               </div>
               <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
                   <div class="form-group">
                       <div class="form-line">
                        <select class="form-control show-tick" name="status" id="status">
                                                 
                            <option value="Pre-Orden">Pre Orden</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Rechazado">Rechazado</option>
                            <option value="Agendado">Agendado</option>
                            <option value="Compra">Compra</option>
                            <option value="Entregado (C)">Entregado (C)</option>
                           
                        </select>                 
                       </div>
                   </div>
               </div>
              </div>

              <div class="row ">
               <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
                   <label for="time_payment">Observaciones: </label>
               </div>
               <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
                   <div class="form-group">
                       <div class="form-line">
                          <textarea name="observation" id="observation" cols="2" rows="2" class="form-control">
                           </textarea>               
                       </div>
                   </div>
               </div>
              </div>
             
         <!-- modal-body -->
         <div class="modal-footer">
            <button type="button" id="btnreversar" class="btn btn-primary"> <i class="fa fa-save"> </i> GUARDAR</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
         </div>
      </form>
      </div>
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->
