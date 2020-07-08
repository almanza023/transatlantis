
<!-- LARGE MODAL -->
<div id="modalEditTypeProvider" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ACTUALIZACION</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-20">
            <h5 class=" lh-3 mg-b-20"></h5>
            
            <form class="form-horizontal" id="form_edit"  method="POST" action="{{ route('typeprovider.update', 'typeprovier') }}">

                @csrf
                @method('PATCH')

                <input type="hidden" name="id_type_provider" id="id_type_provider">
               
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="type_provider_e">Tipo de Proveedor: </label>
                    </div>
                    <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="type_provider_e" name="type_provider"  required>                   
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
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
