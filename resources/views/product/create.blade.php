@extends('theme.main')
@section('titulo', 'Registro de Productos')
@section('content')
<div class="section-wrapper">
   @if ($errors->any())
   <div class="row">
      <div class="alert bg-red alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
         @foreach ($errors->all() as $error)
         <li class="col-white">{{ $error }}</li>
         @endforeach
      </div>
   </div>
   @endif
   <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card">
            <div class="card-header bg-warning">
               <h2 class="text-center font-bold col-teal">REGISTRO DE PRODUCTOS</h2>
               <a href="{{route('product.index')}}"
                  class="btn btn-oblong btn-danger btn-sm" data-toggle="tooltip"
                  data-placement="right" title="" data-original-title="Regresar">
               <i class="fa fa-reply-all"></i>
               </a>
            </div>
            <div class="card-body">
               <form id="form_create" method="POST" action="{{ route('product.store') }}" autocomplete="off">
                  @csrf
                  <fieldset>
                     <legend>
                        <h5 class="font-bold col-light-green text-center">Informacion Basica</h5>
                     </legend>
                     <div class="row">
                     <div class="col-md-6">
                        <label for="name_product">Nombre Producto</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('name_product') ? 'error focused' : 'success' }}">
                              <input type="text" class="form-control" name="name_product" id="name_product"
                                 value="{{old('name_product')}}">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label for="id_type_unit">Tipo Unidad</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('id_type_unit') ? 'error focused' : 'success' }}">
                              <select class="selectpicker" name="id_type_unit"
                                 id="id_type_unit" data-live-search="true" data-show-subtext="true">
                                 <option value="">Escoge una opcion</option>
                                 @foreach ($typeunits as $typeunit)
                                 <option 
                                    value="{{$typeunit->id_type_unit}}">
                                    {{$typeunit->type_unit}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     </div>
                     <div class="row">
                     <div class="col-md-6">
                        <label for="id_category">Categoria</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('id_category') ? 'error focused' : 'success' }}">
                              <select class="selectpicker" name="id_category"
                                 id="id_category" data-live-search="true" data-show-subtext="true">
                                 <option value="">Escoge una opcion</option>
                                 @foreach ($categories as $category)
                                 <option data-subtext="{{$category->description}}"
									data-tokens="{{$category->name_category}}"  value="{{$category->id_category}}">
                                    {{$category->name_category}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                  </fieldset>
               
                  <fieldset>
                     <legend>
                        <h5 class="font-bold col-light-green text-center">Detalle del Producto</h5>
                     </legend>
                     <div class="row">
                     <div class="col-md-6">
                        <label for="description">Descripcion</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('description') ? 'error focused' : 'success' }}">
                              <textarea class="form-control" id="description" name="description"
                                 minlength="5">{{old('description')}}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label for="type_price">Tipo Precio</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('type_price') ? 'error focused' : 'success' }}">
                              <select class="form-control show-tick" name="type_price"
                                 id="type_price" data-live-search="true" data-show-subtext="true">
                                 <option value="">Escoge una opcion</option>
                                 <option data-subtext="Precion fijo"
                                    value="2">Precio Fijo</option>
                                 <option data-subtext="Precion Especial"
                                    value="1">Precio Especial</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     </div>
                     
                     <div class="row">
                     <div class="col-md-6" id="precio">
                        <label for="effective_date">Fecha Vigencia</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('effective_date') ? 'error focused' : 'success' }}">
                              <input type="date" class="form-control" name="effective_date" id="effective_date"
                                 value="{{old('effective_date')}}">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label for="price">Precio Estipulado</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('price') ? 'error focused' : 'success' }}">
                              <input type="number" class="form-control" name="price" id="price"
                                 value="{{old('price')}}">
                           </div>
                        </div>
                     </div>
                     </div>
                     <div class="row">
                     <div class="col-md-6">
                        <label for="weight">Peso (unidad:?)</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('weight') ? 'error focused' : 'success' }}">
                              <input type="number" class="form-control" name="weight"
                                 id="weight" value="{{old('weight')}}">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label for="volume">Volumen (unidad:?)</label>
                        <div class="form-group">
                           <div class="form-line {{ $errors->has('volume') ? 'error focused' : 'success' }}">
                              <input type="number" class="form-control" name="volume"
                                 id="volume" value="{{old('volume')}}">
                           </div>
                        </div>
                     </div>
                     </div>
                  </fieldset>
                  <div class="row">
                  <div class="col-md-12">		
                     <button type="button" id="btnsave" class="btn btn-primary">
                     <i class="fa fa-save"></i>
                     GUARDAR
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('extra-scripts')
<script>
	$('#id_type_unit').val("{{old('id_type_unit')}}")
	$('#id_type_unit').selectpicker('render');
 </script>
<!-- SweetAlert Plugin Js -->
<script src="{{asset('js/product.js')}}"></script>
@if(old('id_type_unit'))
<script>
   $('#id_type_unit').val("{{old('id_type_unit')}}")
   $('#id_type_unit').selectpicker('render');
</script>
@endif
@if(old('id_category'))
<script>
   $('#id_category').val("{{old('id_category')}}")
   $('#id_category').selectpicker('render');
</script>
@endif
@if(old('type_price'))
<script>
   $('#type_price').val("{{old('type_price')}}")
      $('#type_price').selectpicker('render');
</script>
@endif
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