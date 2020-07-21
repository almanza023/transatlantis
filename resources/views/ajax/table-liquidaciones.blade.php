<div class="table-responsive">
<table class="table table-hover table-bordered">
    
<thead>
    <tr>
        <th>N°</th>
        <th>CONDUCTOR</th>
        <th>N° TICKET</th>
        <th>TOTAL TRANSPORTADO</th>
        <th>FECHA</th>
        <th>N° PEDIDO</th>
        <th>PORCENTAJE</th>
        <th>SUBTOTAL</th>
    </tr>
</thead>
    <tbody>
        @php
            $suma=0;
        @endphp
        @forelse ($liquidaciones as $item)
        @php $suma+=$item->flete  @endphp
        <tr>
            <td> {{ $loop->iteration }}</td>
            <td> {{ $item->driver }}</td>
            <td> {{ $item->ticket }}</td>
            <td> {{ $item->carried .' ('. $item->type_unit.')'}}</td>
            <td> {{ $item->updated_at }}</td>
            <td> {{ $item->id_order }}</td>
            <td> {{ $item->percentage }}%</td>
            <td> $ {{ number_format($item->flete) }}</td>
        </tr>
        @empty
            <tr><th colspan="8"> <center>No Existen Datos para la Consulta</center></th></tr>
        @endforelse
       
        <tr>
            <th colspan="7">TOTAL</th>
            <td>$ {{ number_format($suma) }}</td>
        </tr>
    </tbody>
</thead>
</table>

</div>
<script src="{{ asset('plugins/excel/Blob.min.js') }}"></script>
<script src="{{ asset('plugins/excel/FileSaver.min.js') }}"></script>
<script src="{{ asset('plugins/excel/xls.core.min.js') }}"></script>
<script src="{{ asset('plugins/excel/tableexport.js') }}"></script>
<script>
    $("table").tableExport({
        formats: ["xlsx","txt", "csv"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
        position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
        bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
        fileName: "Liquidación de Conductores",    //Nombre del archivo 
    });
    </script>
