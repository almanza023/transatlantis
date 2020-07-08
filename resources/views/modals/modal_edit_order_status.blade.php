

<!-- LARGE MODAL -->
<div id="modalEditOrderStatus" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ACTUALIZACIÓN</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-20">
            <h5 class=" lh-3 mg-b-20"></h5>
            
            <form class="form-horizontal" id="form_edit"  method="POST" action="{{ route('orderstatus.update', 'orderstatus') }}">

                @csrf
                @method('PATCH')

                <input type="hidden" name="id_order_status" id="id_order_status">
               
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="name_e">Estado: </label>
                    </div>
                    <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="name_e" name="name"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="description_e">Descripcion: </label>
                    </div>
                    <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea class="form-control" id="description_e" name="description"
                                    minlength="4" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="order_by_e">Orden: </label>
                    </div>
                    <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="input-group spinner" data-trigger="spinner">
                                <div class="form-line">
                                    <input type="text" class="form-control text-center" value="1"
                                        data-rule="quantity" name="order_by" id="order_by_e">
                                </div>
                                <span class="input-group-addon">
                                    <a href="javascript:;" class="spin-up" data-spin="up"><i
                                            class="glyphicon glyphicon-chevron-up"></i></a>
                                    <a href="javascript:;" class="spin-down" data-spin="down"><i
                                            class="glyphicon glyphicon-chevron-down"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


         </div>
         <!-- modal-body -->
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary"> <i class="fa fa-save"> </i> GUARDAR</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
         </div>
      </form>
      </div>
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->

