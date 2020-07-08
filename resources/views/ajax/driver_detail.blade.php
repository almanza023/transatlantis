<div class="table-responsive">

    <table class="table">
        <tr>
            <th class="text-center" colspan="2">DATOS DE CLIENTE</th>
        </tr>
            <tr>
                <th>NOMBRE</th>
                <td>{{ strtoupper($driver->first_name.' '.$driver->last_name) }}</td>
            </tr>
            <tr>
                <th>DIRECCIÓN</th>
                <td>{{ $driver->address }}</td>
            </tr>
            <tr>
                <th>CORREO</th>
                <td>{{ $driver->email }}</td>
            </tr>
            <tr>
                <th>N° 1 DE CONTACTO </th>
                <td>{{ $driver->contact_number }}</td>
            </tr>
            <tr>
                <th>N° 2 DE CONTACTO </th>
                <td>{{ $driver->contact_number_second }}</td>
            </tr>
            <tr>
                <th>TIPO SANGRE </th>
                <td>{{ $driver->blood_type }}</td>
            </tr>
            <tr>
                <th>FECHA NACIMIENTO </th>
                <td>{{ $driver->date_birth }}</td>
            </tr>
            <tr>
                <th>SITIO DE ATENCIÓN </th>
                <td>{{ $driver->place_care }}</td>
            </tr>
            <tr>
                <th>ARL </th>
                <td>{{ $driver->arl }}</td>
            </tr>
        
    </table>
</div>