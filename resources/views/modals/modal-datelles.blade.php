<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-header bg-warning">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
      </div>
      <div class="modal-body">
        
       <table class="table table-hover table-responsive">
       
            <tr>
                <th>ORDEN</th>
                <td>
                    <input type="text" id="id" class="form-control" readonly>
                </td>
            </tr>
            <tr>
                <th>DESCRIPCION</th>
               <td>
                <textarea class="form-control" id="title" cols="5" rows="5"></textarea>
               </td>
            </tr>
            <tr>
               <th>FECHA</th>
               <td>
                <input type="text" id="start" class="form-control" readonly>
               </td>
            </tr>
        
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        
      </div>
   
    </div>
  </div>
</div>