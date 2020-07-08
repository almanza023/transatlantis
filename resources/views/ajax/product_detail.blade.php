<div class="row">

    <div class="col-md-12">      
                <div class="table-responsive">
                    <table class="table table-hover dashboard-task-infos">
                        <tr>
                            <th colspan="4" class="text-center">DETALLES DE PRODUCTO</th>
                        </tr>
                        <tbody>
                            <tr>
                                <th>Producto</th>
                                <td>{{$product->name_product}}</td>
                            </tr>
                            <tr>
                                <th>Descripcion</th>
                                <td>{{$product->description}}</td>
                            </tr>
                            
                            <tr>
                                <th>Categoria</th>
                                <td>{{$product->category->name_category}}</td>
                            </tr>
                            <tr>
                                <th>Caracteristicas</th>
                                <td>
                                    <li>T/U:
                                        <span class='font-bold font-italic col-purple'>{{$product->typeUnit->type_unit}}</span>
                                    </li>
                                    <li>Peso: 
                                        <span class='font-bold font-italic col-orange'>{{$product->weight}}</span>
                                    </li>
                                    <li>Volumen: 
                                        <span class='font-bold font-italic col-blue'>{{$product->volume}}</span>
                                    </li>
                                </td>
                            </tr>
                            <tr>
                                <th>Precio</th>
                                <td>
                                    {{$product->present()->typePrice()}}
                                </td>
                            </tr>

                            <tr>
                                <th>Estado</th>
                                <td>{{$product->present()->textActiveProduct()}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div> 
</div>    


@if ($product->type_price == 1)
<div class="row">

    <div class="col-md-12">        
                <div class="table-responsive">
                    <table class="table table-hover dashboard-task-infos">
                        <thead>
                            <tr>
                                <td colspan="4" class="text-center">HISTORIAL DE PRECIO</td>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Fechas</th>
                                <th>Precio</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->prices as $price)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <li>Fecha Vigente: {{$price->effective_format}}</li>
                                    <li>Fecha Expiracion: {{$price->expiration_date}}</li>  
                                </td>
                                <td>{{$price->price}}</td>
                                <td>
                                    @if($price->price_status)
                                        <span class='col-blue'>Vigente</span>
                                    @else
                                        <span class='font-bold col-red'>Expirada</span>
                                     @endif
                                </td>
                            </tr>
                            @endforeach
                            
                           
                        </tbody>
                    </table>
                </div>
            </div>       
@endif