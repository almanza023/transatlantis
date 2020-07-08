@extends('theme.main')
@section('titulo', 'VER ROLES')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning">
                    Detalles de Rol
                </div>

                <div class="card-body">
                    <p><strong>Nombre</strong> {{$role->name}}</p>
                    <p><strong>Slug</strong> {{$role->slug}}</p>
                    <p><strong>Descripcion</strong> {{$role->description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection