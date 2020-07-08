@extends('theme.main')


@section('titulo', 'Listado de Compras')

@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop


@section('content')

@include('layouts.success')

<div class="section-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-default">
					<h2 class="tx-center font-bold col-deep-purple font-42">
						LISTADO DE PEDIDOS CON ORDEN DE COMPRA
					</h2>
					
						<hr>
							
				</div>
					    
				<div class="card-body">
					<div class="table-wrapper">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Cliente</th>
									<th>Fecha de Compra</th>
									<th>Prioridad</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
								<tr>
									<td>{{$order->number_order}}</td>
									<td>
										{{$order->first_name}} {{$order->last_name}}
									</td>
									<td>{{$order->created_at}}</td>
									<td class="text-center">{{$order->present()->priority()}}</td>
									<td class="text-center">
										<a href='#modalDetail' data-toggle='modal' class='btn btn-info btn-oblong btn-sm'  data-href=" {{route('purchase.create', $order->id_order)}} "> <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" data-original-title="Ver detalle"></i></a>
										<a class='btn btn-success btn-oblong btn-sm'  href=" {{route('purchase.report', $order->id_order) }}"><i class='fa fa-print' data-toggle="tooltip" data-placement="top" data-original-title="Imprimir Orden"></i></a>
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



@include('modals.modal-empty')
	

@stop



@section('extra-scripts')
	<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
	<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('js/datatable.js')}}"></script>
    <script src="{{asset('js/purchase.js')}}"></script>
@stop