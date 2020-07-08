<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg bg-warning" role="document">
        <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">LISTADO DE PRODUCTOS</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <div class="modal-content" >
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-12">
                        <form id="form_items"> 
                       
                            <table class="table" style="width: 650px;">
                                <tr>
                                    <th>PRODUCTO</th>
                                    <td>
                                      <select class="form-control show-tick"
                                      name="id_product[]" id="id_product-999"
                                      data-live-search="true"
                                      onchange="changePrice(this);">
                                      <option value="">Productos</option>
                                      @foreach ($products as $product)
                                      <option value="{{$product->id_product}}">
                                          {{$product->name_product}}</option>
                                      @endforeach
                                  </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>CANTIDAD</th>
      
                                    <td>
                                      <input type="number" class="form-control"
                                      name="amount[]" id="amount-999">
                                    </td>
                                </tr>
                                @if (auth()->user()->hasRole('super-admin')==1 || auth()->user()->hasRole('regular') )
                                <tr>
                                    <th>PRECIO</th>
                                   
                                 
                                   
                                    <td><input type="number" class="form-control"
                                        name="unit_price[]" id="unit_price-999" ></td>
                                
                                  
                                </tr>
                                @else 
                                <td><input type="hidden" class="form-control"
                                    name="unit_price[]" id="unit_price-999" readonly></td>
                                @endif
                                <tr>
                                    <td colspan="2">
                                      <button id="btnAdd" type="button" class="btn btn-success">
                                          <i class="fa fa-save"></i>
                                          <span> AÑADIR</span>
                                      </button> 
                                    </td>
                                </tr>
                              </table>                         
             
                          </form> 
                    </div>
                </div>
            </div>

               

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> CERRAR</button>
            </div>
        </div>
    </div>
</div>



