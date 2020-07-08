<!-- LARGE MODAL -->
<div id="modalEditTypeUnit" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">REGISTRO DE TIPO DE UNIDAD</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-20">
            <h5 class=" lh-3 mg-b-20"></h5>
            <form class="form-horizontal" id="form_edit"  method="POST" action="{{ route('typeunit.update', 'typeunit') }}">

                @csrf
                @method('PATCH')

                <input type="hidden" name="id_type_unit" id="id_type_unit">
               
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="type_unit_e">Tipo de Unidad: </label>
                    </div>
                    <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="type_unit_e" name="type_unit"  required>                   
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
                                <textarea class="form-control" id="description_e" name="description" minlength="4" required></textarea>                   
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