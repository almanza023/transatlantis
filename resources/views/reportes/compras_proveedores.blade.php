<!doctype html>
<html lang="en">

<head>
    <title>Reporte</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <style>
        
        .tr-color{
            background-color: #ff8000;
            color: black;
            
        }
       </style>
    

</head>

<body>

   
    <div class="container">
        <div class="header">
            <img src="../public/images/logo.png" alt="" width="100px;" height="50px;">
            <h2 class="text-center font-bold"><b>ATLANTIS SOFT</b></h2>
            <h4 class="text-center">COMPRAS A PROVEEDORES</h4><br>
            <P>DESDE: {{ $date1 }} HASTA {{ $date2 }}</P>           
            <p >Fecha De Elaboración: {{ $fecha }}</p>


        </div>
        @if ($tipo==2)
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th>#</th>
                    <th>PROVEEDOR</th>

                    <th>PRODUCTO</th>
                    <th>PRECIO</th>                                     
                    <th>CANTIDAD</th>   
                    <th>SUBTOTAL</th>                                  
                </tr>

            </thead>
            <tbody>
              @php
                  $suma=0;
              @endphp
                @foreach($purchases as $p)
                @php
                   
                $suma+=($p->price*$p->total);
                @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$p->proveedor}}</td>   
                    <td>{{$p->name_product}}</td>                   
                    <td>
                        {{ '$'.number_format($p->price) }}
                    </td>  
                    <td>
                        {{ $p->total}}
                    </td>    
                    <td>
                        {{ '$'. number_format($p->price*$p->total) }}
                    </td>                        
                </tr>
                @endforeach
                
            </tbody>
            <br>
            <tr>
                <th colspan="5">
                    TOTAL
                </th>
                
                    <td>
                        {{ '$'. number_format($suma) }}
                    </td> 
                
            </tr>
        </table>  
        @endif
       
        @if ($tipo==1)
        
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th>#</th>                   
                    <th>PRODUCTO</th>
                    <th>PRECIO</th>                                     
                    <th>CANTIDAD</th>   
                    <th>SUBTOTAL</th>                                  
                </tr>

            </thead>
            <tbody>
              
                @php
                $suma=0;
            @endphp
              @foreach($purchases as $p)
              @php
                   
                    $suma+=($p->price*$p->total);
                @endphp
                
                <tr>
                    <td>{{$loop->iteration}}</td>                   
                    <td>{{$p->name_product}}</td>                   
                    <td>
                        {{ '$'.number_format($p->price) }}
                    </td>  
                    <td>
                        {{ $p->total}}
                    </td>    
                    <td>
                        {{ '$'. number_format($p->price*$p->total) }}
                    </td>                        
                </tr>
                @endforeach
                
            </tbody>
            <br>
            <tr>
                <th colspan="4">
                    TOTAL
                </th>
                
                    <td>
                        {{ '$'. number_format($suma) }}
                    </td> 
                
            </tr>
        </table>  
        @endif
              
               
    </div>




</body>
@if (session()->has('warning'))
<script type="text/javascript">
	success('{{ session('warning') }}');
</script>
@endif

</html>