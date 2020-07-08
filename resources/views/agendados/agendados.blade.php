@extends('theme.main')


@section('titulo', 'LISTADO DE PEDIDOS')
@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop


@section('content')

@include('layouts.success')

<div class="section-wrapper">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE PEDIDOS AGENDADOS
					</h2>

							
				</div>
					    
				<div class="card-body">
					<div id="datos">					
					<div class="table-wrapper" id="id_table">
						<table class="table table-condensed table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Cliente</th>
									<th>Fecha de Pedido</th>
									<th>Prioridad</th>
									<th>Estado</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
								<tr>
									<td>{{$order->number_order}}</td>
									<td>
										{{$order->present()->isTypeCustomer()}}
									</td>
									<td>{{$order->date_order}}</td>
									<td class="text-center">{{$order->present()->priority()}}</td>
									<td class="text-center"><div id="td-{{$order->id_order}}">{{$order->present()->status()}}</div></td>
									<td>
										<a data-target="#modalEntrega" data-toggle='modal' class='btn btn-oblong btn-warning btn-sm' data-id="{{$order->id_order}}"></i>GUARDAR ENTREGA</a>
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
</div>




@include('modals.modal-entrega')

	

@stop



@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>

<script src="{{asset('js/datatable.js')}}"></script>

<script>
   
   
	$('#modalEntrega').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #id_order').val(id); 
	});
	

</script>
@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif

@stop