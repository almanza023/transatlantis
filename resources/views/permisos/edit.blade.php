@extends('theme.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning">
                    Edicón de Permisos
                </div>

                <div class="card-body">
                    {!! Form::model($permission, ['route' => ['permisos.update', $permission->id],
                    'method' => 'PUT']) !!}

                        @include('permisos.partials.form')

                    {!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection