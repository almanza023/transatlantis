<div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h4 class="modal-title" id="smallModalLabel">Asignar Prioridad</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal"  id="form_priority" method="POST" action="{{ route('order.priority') }}">

					@csrf
				   
					<input type="hidden" name="id_order" id="id_order">
					
					<div class="row clearfix">
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="priority">Prioridad: </label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
							<div class="form-group">
								<div class="form-line">
									<input type="number" class="form-control" id="priority" name="priority"  required>                   
								</div>
							</div>
						</div>
					</div>


				</form>

				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link waves-effect" onclick="savePriority()">GUARDAR CAMBIOS</button>
			</div>
		</div>
	</div>
</div>
