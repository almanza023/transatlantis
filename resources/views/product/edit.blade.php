@extends('theme.main')
@section('titulo', 'Edición  de Productos')
@section('extra-css')
<!-- Sweetalert Css -->
<link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@stop
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
   <div class="row ">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card">
            <div class="card-header bg-warning">
               <h2 class="text-center font-bold col-teal">EDICION DE PRODUCTOS</h2>
               <a href="{{route('product.index')}}"
                  class="btn btn-oblong btn-danger btn-sm" data-toggle="tooltip"
                  data-placement="right" title="" data-original-title="Regresar">
               <i class="fa fa-reply-all"></i>
               </a>
            </div>
            <div class="card-body">
               {!! Form::model($product, ['route'=>['product.update', $product->id_product], 'method'=>'PUT', 'id'=>'form_update']) !!}
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
                              value="{{$product->name_product}}">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label for="id_type_unit">Tipo Unidad</label>
                     <div class="form-group">
                        <div class="form-line {{ $errors->has('id_type_unit') ? 'error focused' : 'success' }}">
                           <select class="form-control select2" name="id_type_unit"
                              id="id_type_unit" data-live-search="true" data-show-subtext="true">
                              <option value="">Escoge una opcion</option>
                              @foreach ($typeunits as $typeunit)
                              @if ($typeunit->id_type_unit==$product->id_type_unit)
                              <option data-subtext="{{$typeunit->description}}"
                                 value="{{$typeunit->id_type_unit}}" selected>
                                 {{$typeunit->type_unit}}
                              </option>
                              @endif
                              <option data-subtext="{{$typeunit->description}}"
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
                              @if ($category->id_category==$product->id_category)
                              <option data-subtext="{{$category->description}}"
                                 value="{{$category->id_category}}" selected>
                                 {{$category->name_category}}
                              </option>
                              @endif
                              <option data-subtext="{{$category->description}}"
                                 value="{{$category->id_category}}">
                                 {{$category->name_category}}
                              </option>
                              @endforeach
                           </select>
                        </div>
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
                              minlength="5">{{$product->description}}</textarea>
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
                              @if ($product->type_price==1)
                              <option data-subtext="Precion Especial"
                                 value="1" selected>Precio Especial</option>
                              @endif
                              <option data-subtext="Precion fijo"
                                 value="2" selected>Precio Fijo</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                     <label for="price">Precio Estipulado</label>
                     <div class="form-group">
                        <div class="form-line {{ $errors->has('price') ? 'error focused' : 'success' }}">
                           <input type="number" class="form-control" name="price" id="price"
                              value="{{$product->price}}">
                        </div>
                     </div>
                  </div>
                  @isset($price)
                  <div class="col-md-6" id="precio">
                     <label for="effective_date">Fecha Vigencia</label>
                     <div class="form-group">
                        <div class="form-line {{ $errors->has('effective_date') ? 'error focused' : 'success' }}">
                           <input type="date" class="form-control" name="effective_date" id="effective_date"
                              value="{{$price->effective_date}}">
                        </div>
                     </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                     <label for="price">Precio Estipulado</label>
                     <div class="form-group">
                        <div class="form-line {{ $errors->has('price') ? 'error focused' : 'success' }}">
                           <input type="number" class="form-control" name="price" id="price"
                              value="{{$price->price}}">
                        </div>
                     </div>
                  </div>
                  @endisset
                  <div class="col-md-6">
                     <label for="weight">Peso (unidad:?)</label>
                     <div class="form-group">
                        <div class="form-line {{ $errors->has('weight') ? 'error focused' : 'success' }}">
                           <input type="number" class="form-control" name="weight"
                              id="weight" value="{{$product->weight}}">
                        </div>
                     </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                     <label for="volume">Volumen (unidad:?)</label>
                     <div class="form-group">
                        <div class="form-line {{ $errors->has('volume') ? 'error focused' : 'success' }}">
                           <input type="number" class="form-control" name="volume"
                              id="volume" value="{{$product->volume}}">
                        </div>
                     </div>
                  </div>
               </div>
               </fieldset>
               <div class="row">
               <div class="col-md-12">
                  <button type="button" id="btnUpdate" class="btn btn-primary">
                  <i class="fa fa-save"></i>
                  <span> ACTUALIZAR</span>
                  </button>
               </div>
               </div>
               {!! Form::close() !!}
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('extra-scripts')
<!-- SweetAlert Plugin Js -->
<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
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