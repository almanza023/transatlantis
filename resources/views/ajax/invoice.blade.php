<form action="{{ route('save.invoice') }}" method="POST" id="form_invoice">
    <input type="hidden" id="id_order" name="id_order" value="{{ $total[0]->id_order }}">
    <input type="hidden" id="id_admin" name="id_admin" value="{{ auth()->user()->usable_id }}">
    <input type="hidden" value="<?php echo date('Y-m-d');?>" id="dateA">
    @csrf              
    <div class="row ">
        <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="time_payment">PEDIDO N° {{ $total[0]->id_order}}</label>
        </div>
    </div>
    <div class="row ">
     <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
         <label for="time_payment">Fecha Facturación: </label>
     </div>
     <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
         <div class="form-group">
             <div class="form-line">
                 <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d');?>" >                   
             </div>
         </div>
     </div>
    </div>
    <div class="row ">
      <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
          <label for="time_payment">Valor de Factura: </label>
      </div>
      <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
          <div class="form-group">
              <div class="form-line">
                  <input type="number" value="{{ $total[0]->total }}" class="form-control" id="total_fact" name="total_fact" readonly >                   
              </div>
          </div>
      </div>
      
     </div>
     <div class="row ">
        <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="time_payment">Valor de Descuento: </label>
        </div>
        <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">

                   @if($total[0]->total==null)
                   <input type="number" value="0" class="form-control" id="discount" name="discount" readonly >                   
                  @else
                  <input type="number" value="{{ $total[0]->descuento }}" class="form-control" id="discount" name="discount" readonly >                   

                   @endempty

                </div>
            </div>
        </div>
        
       </div>
    <div class="row ">
     <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5 form-control-label">
         <label for="time_payment">Valor a Facturar: </label>
     </div>
     <div class="col-lg-12 col-md-10 col-sm-8 col-xs-7">
         <div class="form-group">
             <div class="form-line">
                 @php
                     $total=$total[0]->total -$total[0]->descuento;
                 @endphp
                 <input type="number" class="form-control" id="total" name="total" value="{{ $total }}" >                   
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
   <div class="row">
    <div class="col-lg-12">
        <button type="button" id="btn_save-invoice" onclick="saveInvoice();" class="btn btn-primary"> <i class="fa fa-save"> </i> GUARDAR</button>
    </div>
   </div>
  </form>