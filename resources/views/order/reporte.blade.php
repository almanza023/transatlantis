@extends('theme.main')
@section('titulo', 'REPORTE DE PEDIDOS')
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
					    REPORTE DE PEDIDOS
					</h2>					
				</div>
				<div class="card-body">
					<div class="table-wrapper">
						<form id="form_filter" method="post" action="{{route('orders.print')}}" target="_blank">
							 @csrf  
                            <div class="row">
                                    
                                        <div class="col-md-3">	
                                            <label  class="form-label font-bold col-cyan">Filtrar Por: Prioridad</label>
                                            <div class="form-group form-float form-float">
                                                <div class="form-line">
                                                    <select class="form-control show-tick" name="filter_priority">
                                                        <option value="">--Seleccionar--</option>
                                                        <option value="1">Alta</option>
                                                        <option value="5">Media</option>
                                                        <option value="10">Baja</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                        
                                        <div class="col-md-3">	
                                            <label  class="form-label font-bold col-cyan">Filtrar Por: Estado</label>
                                            <div class="form-group form-float form-float">
                                                <div class="form-line">
                                                    <select class="form-control show-tick" name="filter_status">
                                                        <option value="">--Seleccionar-- </option>
                                                        <option value="Pre-Orden">Pre Orden</option>
                                                        <option value="Aprobado">Aprobado</option>
                                                        <option value="Rechazado">Rechazado</option>
                                                        <option value="Agendado">Agendado</option>
                                                        <option value="Compra">Compra</option>
                                                        <option value="Entregado (C)">Entregado</option>
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
                                            <div class="col-md-3">
                                                <button type='submit' id="btn_print"  class='btn btn-primary'><li class="fa fa-print"></li> GENERAR PDF </button>
                                            </div>              
                                        </div>             
                            
                        </form>
                    </div>
                    
                    <div id="datos">

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


