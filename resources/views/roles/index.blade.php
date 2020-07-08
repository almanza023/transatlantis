@extends('theme.main')
@section('titulo', 'ROLES')
@section('extra-css')
<link href="{{asset('theme/lib/datatables/css/jquery.dataTables.css')}}" rel="stylesheet">
@stop
@section('content')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning">
                    Roles                
                </div>

                <div class="card-body">
                    <a href="{{route('roles.create')}}" class="btn btn-lg btn-primary "><i class="fa fa-save"></i> Crear</a>
                    <br>
                <div class="table-responsive">
                    <br>
                    <table class="table table table-hover js-basic-example">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>NOMBRE</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                
                                <td >
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{route('roles.show', $role->id)}}" class="dropdown-item">
                                                <i class="fa fa-eye"> </i> Ver
                                            </a>
                                            
                                            <a href="{{route('roles.edit', $role)}}" class="dropdown-item">
                                                <i class="fa fa-edit"> </i> Editar
                                            </a>                                         
                                         
                                            {!! Form::open(['route' => ['roles.destroy', $role], 'method' =>'DELETE']) !!}
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