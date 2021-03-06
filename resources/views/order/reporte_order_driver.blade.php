@extends('theme.main')
@section('titulo', 'REPORTE ENTREGAS CONDUCTOR')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@stop
@section('content')
<div class="section-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
					    REPORTE DE PEDIDOS ENTREGADOS POR CONDUCTOR
					</h2>					
				</div>
				<div class="card-body">
					<div class="table-wrapper">
						<form id="form_report" method="post" action="{{route('orders.driver')}}" target="_blank">
							 @csrf  
                            <div class="row">
                                    
                                        <div class="col-md-3">	
                                            <label  class="form-label font-bold col-cyan">Conductor: </label>
                                            <div class="form-group form-float form-float">
                                                <div class="form-line">
                                                    <select class="form-control selectpicker" name="nid_driver" id="nid_driver">
                                                        @foreach ($drivers as $driver)
                                                           <option value="{{ $driver->nid_driver }}" data-subtext="{{ $driver->nid_driver }}">{{ $driver->first_name.' '.$driver->last_name }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>                                            
                                        </div>

                                        <div class="col-md-6">	
                                            <label  class="form-label font-bold col-cyan">Rango de Fechas: </label>
                                            <div class="form-group form-float form-float">
                                                <div class="form-line">
                                                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                        <i class="fa fa-calendar"></i>&nbsp;
                                                        <span></span> <i class="fa fa-caret-down"></i>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <input type="hidden" name="date1" id="date1">
                                        <input type="hidden" name="date2" id="date2">
                                       
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type='submit' id="btn_print"  class='btn btn-primary'><li class="fa fa-print"></li> GENERAR PDF </button>
                                </div> 
                            </div>                 
                        </form>
                    </div>                    
                   
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('extra-scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript" src="{{ asset('js/fecha.js') }}">
   
</script>
@if (session()->has('warning'))
<script type="text/javascript">
	success('{{ session('warning') }}');
</script>
@endif


@stop


