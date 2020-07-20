<!-- LARGE MODAL -->
<div id="listAgendados" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">LISTADO DE CONDUCTORES AGENDADOS</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <h5 class=" lh-3 mg-b-20"></h5>
           <div class="row">
			<div class="col-md-12">
				<div class="">
					
						<div class="card-body">
							<div class="table-responsive">
								<table
									class="table table-bordered table-striped table-hover"
									 style="width: 100%">
									<thead>
										<tr>
											
											<th class="text-center">Conductor</th>
											<th class="text-center">Placa</th>
                                            <th class="text-center">Fecha</th>
											<th class="text-center">Hora</th>                                        
											
										</tr>
									</thead>
									<tbody>
										@foreach($listvehicles as $item)
										<tr>
											<td class="text-center" >{{ $item->conductor }}</td>
											<td class="text-center">
												{{ $item->placa}}</td>
											<td class="text-center">{{ $item->date_departure }}</td>
											<td class="text-center">{{ $item->time_departure }}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					
				</div>
			</div>
		   </div>
           
         </div>
         <!-- modal-body -->
         <div class="modal-footer">           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
         </div>
      
      </div>
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->