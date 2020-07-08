@extends('theme.main')

@section('titulo', 'Listado de Productos')

@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">

@stop
@section('content')
<div class="section-wrapper">
	<div class="row">
		<div class="col-lg">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE PRODUCTOS
					</h2>					
				</div>
				<div class="card-body">
					<hr>
					<a href="{{route('product.create')}}"
					class="btn btn-oblong btn-primary " data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Crear nuevo registro">
						<i class="fa fa-save"> </i> CREAR NUEVO
					</a>
					<hr>
					<div class="table-wrapper">
						<table class="table display responsive nowrap js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Producto</th>
                                    <th>Propiedades</th>
                                    <th>Precio</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Producto</th>
                                    <th>Propiedades</th>
                                    <th>Precio</th>
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($products as $product)
								<tr>
                                    <td>{{$loop->iteration}}
                                    </td>
                                    <td>{{$product->name_product}}
                                        <li>Categoria: 
                                            <span class='font-bold font-italic col-teal'>{{$product->category->name_category}}</span>
                                        </li>
                                    </td>
									<td>
										<li>T/U:
                                            <span class='font-bold font-italic col-purple'>{{$product->typeUnit->type_unit}}</span>
                                        </li>
                                        <li>Peso: 
                                            <span class='font-bold font-italic col-orange'>{{$product->weight}}</span>
                                        </li>
                                        <li>Volumen: 
                                            <span class='font-bold font-italic col-blue'>{{$product->volume}}</span>
                                        </li>
                                    </td>
                                    <td>{{$product->present()->typePrice()}}</td>
									<td class="text-center">

										<a href="#modalDetail" data-toggle="modal"
											data-href="{{route('product.show', $product->id_product)}}"
											class="btn btn-oblong btn-info btn-sm"><i data-toggle="tooltip"
											data-placement="top" title="" data-original-title="Ver Detalle"
												class="fa fa-eye"></i></a>


										{{$product->present()->isActive()}}


										<a href="{{route('product.edit', $product->id_product)}}"
											class="btn btn-oblong btn-warning btn-sm" data-toggle="tooltip"
											data-placement="top" title="" data-original-title="Editar"><i
												class="fa fa-edit"></i></a>


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


@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif

@stop