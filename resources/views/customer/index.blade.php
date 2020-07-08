@extends('theme.main')


@section('titulo', 'LISTADO DE CLIENTES')

@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">

@stop


@section('content')

<div class="section-wrapper">
	<div class="row">
		<div class="col-md">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE CLIENTES
					</h2>
					
				</div>
				<div class="card-body">
				<hr>
				<a href="#createCustomer" data-toggle="modal"  class="btn btn-oblong btn-primary ">
					<i class="fa fa-save"></i>
					<span>CREAR CLIENTE</span>
				</a>
				<hr>
						<div  id="id_table">
							@include('ajax.table-customers')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="list_municipalities" value='@json($municipalities)'>
<form id="form_hidden" style="display:none" action="{{route('customers.index')}}" method="GET"><input type="hidden" name="opcion" value="ok"></form>


@include('modals.create-customer')
@include('modals.modal-empty')
	
@stop



@section('extra-scripts')

<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>

<script src="{{asset('js/datatable.js')}}"></script>


<script>
	let municipalities = $('#list_municipalities').val();
	municipalities = JSON.parse(municipalities);
</script>
<script src="{{asset('js/customer.js')}}"></script>

@stop