@if (auth()->check())
<form action="{{ route('update.password') }}" method="post">
    @csrf
    <input type="hidden" value="{{ $user[0]->id }}" name="id">
    <table class="table table-hover table-responsive">
     
        @if ($tipo==5)
        <tr>
            <th>NOMBRE EMPRESA</th>
            <td>
               {{ $user[0]->full_name }}
            </td>
        </tr>
        @endif
         <tr>
             <th>NOMBRE</th>
             <td>
                {{ $user[0]->first_name }}
             </td>
         </tr>
         <tr>
            <th>APELLIDOS</th>
            <td>
               {{ $user[0]->last_name }}
            </td>
        </tr>
        @if ($tipo==1)
        <tr>
            <th>DOCUMENTO</th>
            <td>
               {{ $user[0]->document }}
            </td>
        </tr>
        @endif

        @if ($tipo==3)
        <tr>
            <th>TELÉFONO</th>
            <td>
               {{ $user[0]->contact_number }}
            </td>
        </tr>
        @endif
       
        @if ($tipo==3 || $tipo==1)
        <tr>
            <th>DIRECCIÓN</th>
            <td>
               {{ $user[0]->address }}
            </td>
        </tr>
        @endif
        <tr>
            <th>CORREO</th>
            <td>
               {{ $user[0]->email }}
            </td>
        </tr>
        <tr>
            <th>ROL</th>
            <td>
               {{ $user[0]->name }}
            </td>
        </tr>
         

     <tr>
         <th colspan="2">CAMBIO DE CLAVE</th>
     </tr>
     <tr>
         <th>NUEVA CLAVE</th>
         <td><input type="password" class="form-control" name="password" required></td>
     </tr>
     
    <tr>
        <td>
            <button type="submit" class="btn btn-primary"><i  class="fa fa-save"></i> GUARDAR</button>
        </td>
    </tr>
    </table>
</form>
@endif
    