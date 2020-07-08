@extends('theme.main')
@section('titulo', 'COMPRA DE PRODUCTOS')
@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop
@section('content')
<div class="section-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						PRODUCTOS SOLICITADOS
					</h2>
					
				</div>
				<div class="card-body">
					
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Producto</th>
									<th>Total</th>
									<th>Accion</th>
								</tr>
							</thead>
							
							<tbody>
								@foreach($products as $product)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$product->name_product}}</td>
									<td>{{$product->total}}</td>
									<td>
                                        <a target="_blank" href="{{ route('purchase.report', $product->id_order) }}" class="btn btn-warning btn-sm btn-oblong"> <i class="fa fa-eye"> </i>Ver </a>
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
<script src="{{asset('js/index.js')}}"></script>


@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif

@stop