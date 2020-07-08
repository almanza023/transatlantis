<form id="form_filter3" method="GET" action="{{route('orders.filter-agendados')}}">
							   
    <div class="row">
            
                <div class="col-md-3">	
                    <label  class="form-label font-bold col-cyan">Placa: </label>
                    <div class="form-group form-float form-float">
                        <div class="form-line">
                            <select class="form-control show-tick" name="placa">
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->placa }}">{{ $vehicle->placa.'-'.$vehicle->first_name.' '.$vehicle->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">	
                    <label  class="form-label font-bold col-cyan">Rango de Fechas: </label><br>
                    <div class="form-group form-float form-float">
                        <div class="form-line">
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; height: 42px">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>                                            
                </div>
                <input type="hidden" name="date1" id="date1">
                <input type="hidden" name="date2" id="date2"> 
               
                
              
    </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type='button' id="btn_filter3"  class='btn btn-info'><li class="fa fa-book"></li> FILTRAR </button>
                    </div>
                   
                    <div class="col-md-3">
                        <a href="{{ route('agendados')}}" class='btn btn-success'> <li class="fa fa-close"></li> RESETEAR</a>
                        
                    </div>
                                 
                    
    
                </div>
                
                


   
    
</form>