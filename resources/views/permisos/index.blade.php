@extends('theme.main')
@section('titulo', 'PERMISOS')
@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning">
                    Permisos                
                </div>

                <div class="card-body">

                    <a href="{{route('permisos.create')}}" class="btn btn-lg btn-primary "><i class="fa fa-save"></i> Crear</a>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover js-basic-example" >
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th >ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->descripcion}}</td>
                                    <td width="10px">

                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Opciones
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{route('permisos.show', $permission->id)}}" class="dropdown-item">
                                                    <i class="fa fa-eye"> </i> Ver
                                                </a>
                                                
                                                <a href="{{route('permisos.edit', $permission)}}" class="dropdown-item">
                                                    <i class="fa fa-edit"> </i> Editar
                                                </a>                                         
                                             
                                                {!! Form::open(['route' => ['permisos.destroy', $permission], 'method' =>'DELETE']) !!}
                                                    <button type="" class="dropdown-item">
                                                        <i class="fa fa-close"> </i> Eliminar
                                                    </button>
                                                {!! Form::close() !!}                                   
                                            </div>
                                          </div>                        
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
@stop
@section('extra-scripts')
<script src="{{asset('theme/lib/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('theme/lib/datatables-responsive/js/dataTables.responsive.js')}}"></script>

<script src="{{ asset('js/datatable.js') }}"></script>
@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif
@if (session()->has('warning'))
<script type="text/javascript">
	warning('{{ session('warning') }}');
</script>
@endif
@stop



