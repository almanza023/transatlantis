<div class="modal fade" id="modalEntrega" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">	

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h2 class="text-center font-bold col-teal">ENTREGA DE PEDIDO</h2>            
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" id="form_create1"  method="POST" action="{{ route('save.entregas') }}">

                                    @csrf                                   

                                    <input type="hidden" name="order_id" id="order_id">
                                    <input type="hidden" name="id_order_status" id="id_order_status1">
                                    <input type="hidden" id="dateAA" value="<?php echo date('Y-m-d');?>">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name_category_e">Estado: </label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="status1" class="form-control" id="status1" >
                                                      <div id="opcion2" >
                                                        <option value="1">Entrega Completada</option>
                                                        <option value="2">Entrega Incompleta</option>
                                                    </div>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name_category_e">Fecha: </label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="date" class="form-control" id="date3" name="date3" value="<?php echo date('Y-m-d');?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name_category_e">Hora: </label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="time" class="form-control" id="hour1" name="hour1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="description_e">Observaciones: </label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="observation1" name="observation1" minlength="4" required></textarea>                   
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
            <button type="button" class="btn btn-primary" id="btnsave1"> <i class="fa fa-save"> </i> GUARDAR</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
         </div>
      </form>
      </div>
		</div>
	</div>
</div>