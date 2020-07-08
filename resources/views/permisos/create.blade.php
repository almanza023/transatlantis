@extends('theme.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header bg-warning">
                    Creación de Permisos
                </div>

                <div class="card-body">
                    {!! Form::open(['route' => 'permisos.store']) !!}

                        @include('permisos.partials.form')

                    {!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection