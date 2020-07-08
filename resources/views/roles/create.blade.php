@extends('theme.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Roles
                </div>

                <div class="card-body">
                    {!! Form::open(['route' => 'roles.store']) !!}

                        @include('roles.partials.form')

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                        GUARDAR
                        </button>
                        </div>
                    {!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection