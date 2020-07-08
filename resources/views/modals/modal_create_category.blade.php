<div class="modal fade" id="modalCreateCategory" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
        <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
		<div class="modal-content">
			<div class="modal-body">	
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-default">
                                <h2 class="text-center font-bold col-teal">REGISTRO DE CATEGORIAS DE PRODUCTO</h2>            
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal"  id="form_validation" method="POST" action="{{ route('category.store') }}">
                                    @csrf                 
                                    
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name_category">Nombre de Categoria: </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="name_category" name="name_category"  required>                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="description">Descripcion: </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="description" name="description" minlength="4" required></textarea>                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>                       
                
                                
                            </div>
                        </div>
                    </div>
                </div>
                
			</div>
			<div class="modal-footer">
                <button type="submit" class="btn btn-primary"> <i class="fa fa-save"> </i> GUARDAR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
             </div>
          </form>
		</div>
	</div>
</div>
