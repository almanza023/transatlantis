<form id="form_filter2" method="GET" action="{{route('quotations.filter')}}">
							   
    <div class="row">
            
               
                

        <div class="col-md-6">	
            <label  class="form-label font-bold col-cyan">Rango de Fechas: </label>
            <div class="form-group form-float form-float">
                <div class="form-line">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
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
                        <button type='button' id="btn_filter2"  class='btn btn-info'><li class="fa fa-book"></li> FILTRAR </button>
                    </div>
                   
                    <div class="col-md-3">
                        <a href="{{ route('quotation.index')}}" class='btn btn-success'> <li class="fa fa-close"></li> RESETEAR</a>
                        
                    </div>
                                 
                    
    
                </div>
                
                


   
    
</form>