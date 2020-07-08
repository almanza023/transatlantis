@extends('theme.main')


@section('titulo', 'Listado de Agendas')



@section('extra-css')
<link href="{{asset('plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
@stop

@section('content')

@include('layouts.success')

<div class="section-wrapper">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						LISTADO DE AGENDAS DE PEDIDOS
					</h2>

				
				</div>

				<div class="card-body">

					<div id="calendar">

					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>



@include('modals.modal-datelles')


@stop



@section('extra-scripts')
<script src="{{asset('plugins/fullcalendar/lib/moment.min.js')}}"></script>

<script src="{{asset('plugins/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('plugins/fullcalendar/locale/es.js')}}"></script>
<script>
	$(function() {
		var date = new Date();
		var yyyy = date.getFullYear().toString();
		var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
		var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
		// page is now ready, initialize the calendar...
	  
		$('#calendar').fullCalendar({
			
			header: {
				language: 'es',
			   left: 'prev,next today',
			   center: 'title',
			   right: 'month,basicWeek,basicDay',

		   },
		   defaultDate: yyyy+"-"+mm+"-"+dd,
		  eventRender: function(event, element) {
			element.bind('click', function() {
				$('#ModalEdit #id').val(event.id);
				$('#ModalEdit #title').val(event.title);
				$('#ModalEdit #start').val(event.start);
				$('#ModalEdit').modal('show');
			});
		},

			events: [
			@foreach($orders as $order)	
			
			
				{
					id: '{{ $order->id_order }}',
					title: '{{ $order->conductor.' '.$order->placa }}',
					start: '{{ $order->date_departure }}',
					end: '{{ $order->date_departure }}',
					color: 'cyan',
				},
			@endforeach

			], 

			color: 'yellow',   // an option!
			textColor: '#000000' // an option!
			
		})
	  
	  });
</script>
@stop