<div class="row">
    <div class="col-md-12">
        <form id="form_schedule" method="POST" action="{{route('schedule.save')}}" autocomplete="off">
            @csrf
            <input type="hidden" class="form-control" name="date_departure" id="dateA"  value="<?php echo date('Y-m-d');?>" >
            <input type="hidden" name="id_order" id="id_order" value="{{$order->id_order}}">
            <div id="clonar"></div>
            <div class="table-responsive">
            <table class="table table-hover table-condensed" style="width: 500px;">
                <tr>
                    <th>FECHA DE SALIDA</th>
                    <th>HORA DE SALIDA</th>
                   
                </tr>

                <tr>
                    <td>
                        <input type="date" class="form-control" name="date_departure" id="date_departure"  value="<?php echo date('Y-m-d');?>" >
                    </td>

                    <td>
                        <input type="time" class="form-control" name="time_departure" id="time_departure" value="<?php echo date('TH-i');?>">
                    </td>
                </tr>
                <tr>
                    <th colspan="2">PREGUNTAR POR</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="form-control" id="description" name="description_schedule"  />
                    </td>
                </tr>
            </table >
        </div>
                <div class="row">

                    <div class="col-md-12">

                        <a class="btn btn-info btn-oblong" role="button" data-toggle="collapse" href="#collapseDomicile" aria-expanded="true" aria-controls="collapseDomicile">
                                INFORMACION
                            </a>
                        <a class="btn btn-warning btn-oblong" role="button" href="#modalProduct" data-toggle="modal" data-href="{{route('orders.detail', $order->id_order)}}">
                                MATERIALES
                            </a>

                        <a href="#modalVehicle" data-opcion="2" data-toggle="modal" class="btn btn-primary btn-oblong">AÑADIR VEHICULO +</a>
                        <a href="#listAgendados"  data-toggle="modal" class="btn btn-success btn-oblong">CRONOGRAMA </a>

                    </div>
    </div>
    <div class="row">

        <div class="col-md-12">

            <div class="collapse in" id="collapseDomicile">
                <div class="card-body">

                    @php $nro = $order->order_schedules_count + 1; $capacity = 0; $volume = 0; @endphp @foreach ($order->orderDetails as $detail) @php $capacity += $detail->product->weight; $volume += $detail->product->volume; @endphp @endforeach
                    <label># Agenda: <span id="nro_schedule">{{$nro}}</span></label>
                    <br>
                    <label># Orden: <span id="nro_order">{{$order->id_order}}</span></label>
                    <br>
                    <label>Cliente: <span id="email_customer">{{$order->first_name}} {{$order->last_name}}</span></label>
                    <br>
                    <label>Viaje Cliente: <span id="direction_origen">{{$order->address}}, {{$order->additional}}, ({{$order->name_municipality}} - {{$order->name_departament}})</span> </label>
                    <br>
                    <label>Peso Total de Pedido: <span id="peso_total">{{$capacity}} kg</span> </label>
                    <br>
                    <label>Espacio Total de Pedido: <span id="espacio_total">{{$volume}} m3</span> </label>
                    <br>
                </div>
            </div>
        </div>
    </div>

        <div class="row">

            <div class="col-md-12">
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed" id="table_items">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Vehiculo</th>
                                <th class="text-center">Carga</th>
                                <th class="text-center">Nro Viajes</th>
                                <th class="text-center">Tiempo Estimado</th>
                                <th class="text-center"></th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br>
                </div>

            </div>
        </div>
       
    <div class="row">
        
        <div class="col-md-12">
            <button id="btnsaveschedule" onclick="saveSchedule();" type="button" class="btn btn-success align-center">
                <i class="fa fa-save"></i>
                <span>GUARDAR</span>
            </button>

            {{--
            <button style="display:none;" id="btnprint" type="button" class="m-l-35 btn bg-indigo waves-effect">
                <i class="material-icons">print</i>
                <span>IMPRIMIR</span>
            </button>
            --}}

        </div>
    </div>
</form>
</div>