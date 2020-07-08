<form id="form_filter" method="GET" action="{{route('orders.filter')}}">
							   
    <div class="row">
            
                <div class="col-md-3">	
                    <label  class="form-label font-bold col-cyan">Filtrar Por: Prioridad</label>
                    <div class="form-group form-float form-float">
                        <div class="form-line">
                            <select class="form-control show-tick" name="filter_priority">
                                <option value="">--Seleccionar--</option>
                                <option value="1">Alta</option>
                                <option value="5">Media</option>
                                <option value="10">Baja</option>
                            </select>
                        </div>
                    </div>
                    
                </div>

                <div class="col-md-3">	
                    <label  class="form-label font-bold col-cyan">Filtrar Por: Estado</label>
                    <div class="form-group form-float form-float">
                        <div class="form-line">
                            <select class="form-control show-tick" name="filter_status">
                                <option value="">--Seleccionar-- </option>                            
                                <option value="Pre-Orden">Pre Orden</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Rechazado">Rechazado</option>
                                <option value="Agendado">Agendado</option>
                                <option value="Compra">Compra</option>
                                <option value="Entregado (C)">Entregado (C)</option>
                                 <option value="Facturado">Facturado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">	
                    <label  class="form-label font-bold col-cyan">Fecha Inicial</label>
                    <div class="form-group form-float form-float">
                        <div class="form-line">
                            <input type="date" class="form-control" name="date1">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">	
                    <label  class="form-label font-bold col-cyan"> Fecha Final Final</label>
                    <div class="form-group form-float form-float">
                        <div class="form-line">
                            <input type="date" class="form-control" name="date2">
                        </div>
                    </div>
                </div>
    </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type='button' id="btn_filter"  class='btn btn-info'><li class="fa fa-book"></li> FILTRAR </button>
                    </div>
                   
                    <div class="col-md-3">
                        <a href="{{ route('orders.index')}}" class='btn btn-success'> <li class="fa fa-close"></li> RESETEAR</a>
                        
                    </div>
                                 
                    
    
                </div>
                
                


   
    
</form>