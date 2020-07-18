<div class="modal fade" id="modalInicio" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">	

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h2 class="text-center font-bold col-teal">INICIO DE ENTREGA DE PEDIDO</h2>            
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" id="form_create"  method="POST" action="{{ route('save.entregas') }}">

                                    @csrf                                   

                                    <input type="hidden" name="id_order" id="id_order">
                                    <input type="hidden" name="id_order_status" id="id_order_status">
                                    <input type="hidden" id="dateA" value="<?php echo date('Y-m-d');?>">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name_category_e">Estado: </label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="status" class="form-control" id="status" >
                                                      <div id="opcion1" >
                                                          <option value="3">Inicio Entrega</option>
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
                                                    <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d');?>">
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
                                                    <input type="time" class="form-control" id="hour" name="hour">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name_category_e">Peso Final: </label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" class="form-control" id="weight" name="weight" step="0.1" min="0">
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
                                                    <textarea class="form-control" id="observation" name="observation" minlength="4" required></textarea>                   
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
            <button type="submit" class="btn btn-primary" id="btnsave"> <i class="fa fa-save"> </i> GUARDAR</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
         </div>
      </form>
      </div>
		</div>
	</div>
</div>
