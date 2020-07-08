@extends('theme.main')
@section('titulo', 'Registro de Usuarios')
@section('extra-css')@stop
@section('content')
<div class="section-wrapper">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header bg-warning">
					<h2 class="text-center font-bold col-deep-purple font-42">
						ACTUALIZACION DE USUARIOS
					</h2>
					<a href="{{route('user.index')}}"
						class="btn btn-oblong btn-danger btn-sm" data-toggle="tooltip"
						data-placement="right" title="" data-original-title="Regresar">
						<i class="fa fa-reply-all"> </i>
					</a>
				</div>
				<div class="card-body">
                    <form class="form-horizontal"  id="form_update" method="POST"  action="{{ route('user.update', $user[0]->id_admin) }}">

                        @csrf
                       @method('PATCH')
                        <input type="hidden" value="{{ $user[0]->idusuario }}" name="idusuario">
                        <div class="row ">
                            <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="time_payment">Nombres: </label>
                            </div>
                            <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user[0]->first_name }}" >                   
                                    </div>
                                </div>
                            </div>
                        
        
                        
                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="time_payment">Apellidos: </label>
                        </div>
                        <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="last_name" name="last_name"  value="{{ $user[0]->last_name }}" >                   
                                </div>
                            </div>
                        </div>
                    </div>
               
        
                <div class="row ">
                    <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="time_payment">N° Documento: </label>
                    </div>
                    <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" class="form-control" id="document" name="document"  value="{{ $user[0]->document }}">                   
                            </div>
                        </div>
                    </div>
               
             
              
                <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="time_payment">Dirección: </label>
                </div>
                <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" id="address" name="address" value="{{ $user[0]->address }}">                   
                        </div>
                    </div>
                </div>
            </div>
          
           <div class="row ">
            <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="time_payment">Correo: </label>
            </div>
            <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <input type="email" class="form-control" id="email" name="email"  value="{{ $user[0]->email }}">                   
                    </div>
                </div>
            </div>
           
                <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="time_payment">Teléfono: </label>
                </div>
                <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" class="form-control" id="contact_number" name="contact_number" value="{{ $user[0]->contact_number }}">                   
                        </div>
                    </div>
                </div>
                </div>
        
                <div class="row ">
                    <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="time_payment">Contraseña: </label>
                    </div>
                    <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" id="password" name="password" >                   
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="time_payment">Rol: </label>
                    </div>
                    <div class="col-lg-5 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                               <select name="rol_id" id="rol_id" class="form-control">
                                   <option value="">Seleccione</option>
                                   @if($user[0]->rol=='Super Administrador')
                                   <option value="1" selected>ADMINISTRADOR</option>
                                   <option value="2">REGULAR</option>
                                   @endif
                                   @if($user[0]->rol=='Regulas')
                                   <option value="1" >ADMINISTRADOR</option>
                                   <option value="2" selected>REGULAR</option>
                                   @endif
                                   
                                   
                               </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" id="btnUpdate" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                <span> ACTUALIZAR</span>
                            </button>
                        </div>
                     </div>
                 </div>
                        
               
						
						
	
	
	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>




@stop
@section('extra-scripts')
<script src="{{asset('js/users.js')}}"></script>
@if (session()->has('success'))
<script type="text/javascript">
	success('{{ session('success') }}');
</script>
@endif


@stop