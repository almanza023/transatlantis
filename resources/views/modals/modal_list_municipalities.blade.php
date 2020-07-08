<!-- LARGE MODAL -->
<div id="listMunicipalities" class="modal fade">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20 bg-warning">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">LISTADO DE MUNICIPIOS</h6>
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
							<div class="table-wrapper">
								<table
									class="table table-bordered table-striped table-hover js-basic-example dataTable"
									id="table_munipalities" style="width: 100%">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Departamentos</th>
											<th class="text-center">Municipios</th>
											<th class="text-center">Escoger</th>
										</tr>
									</thead>
									<tbody>
										@foreach($municipalities as $municipality)
										<tr>
											<td class="text-center" data-municipality="{{ $municipality->name_municipality }}">{{ $municipality->id_municipality }}</td>
											<td class="text-center">
												{{ $municipality->departament->name_departament }}</td>
											<td class="text-center">{{ $municipality->name_municipality }}</td>
											<td class="text-center">
												<a href="#" data-dismiss="modal"
													class="btn btn-success btn-sm"><li class="fa fa-plus"></li></a>
											</td>
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