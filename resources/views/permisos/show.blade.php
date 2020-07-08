@extends('theme.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning">
                    Detalles de Permiso
                </div>

                <div class="card-body">
                    <p><strong>Nombre</strong> {{$permission->name}}</p>
                    <p><strong>Slug</strong> {{$permission->slug}}</p>
                    <p><strong>Descripcion</strong> {{$permission->description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection