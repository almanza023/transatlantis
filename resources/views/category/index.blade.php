@extends('theme.main')


@section('titulo', 'Listado de Categorias de Productos')

@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">

@stop


@section('content')


<div class="section-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-default">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE CATEGORIAS DE PRODUCTOS
					</h2>
					<a href="#modalCreateCategory" data-toggle="modal"
						class="btn btn-primary"><i data-toggle="tooltip" data-placement="top" title=""
							data-original-title="Crear nuevo registro" class="fa fa-save"></i> CREAR NUEVO</a>
				</div>
				<div class="card-body">
					<div class="table-wrapper">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Categoria</th>
									<th>Descripcion</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Categoria</th>
									<th>Descripcion</th>
									<th>Accion</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$category->name_category}}</td>
									<td>{{$category->description}}</td>
									<td class="text-center">
										<a href="#modalEditCategory" data-toggle="modal" data-id="{{$category->id_category}}" data-name="{{$category->name_category}}"
											data-description="{{$category->description}}"
											class="btn btn-oblong btn-info btn-sm"><i data-toggle="tooltip"
											data-placement="top" title="" data-original-title="Editar"
											class="fa fa-eye"></i>
										</a>
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

@include('modals.modal_create_category')
@include('modals.modal_edit_category')


@stop



@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>

<!-- Validation Plugin Js -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>

<script src="{{asset('js/validacion.js')}}"></script>
<script src="{{asset('js/category.js')}}"></script>

@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif


@stop