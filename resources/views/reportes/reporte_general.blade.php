<!doctype html>
<html lang="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
    <title>Reporte Orden de Pedido</title>  
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
    <style>
        .page-break {
            page-break-after: always;}

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
            <h1 class="text-center font-bold"><b>ATLANTIS SOFT</b></h1>
            <h3 class="text-center">REPORTE GENERAL </h3>     
            <P>DESDE: <b>{{ $date1 }}</b> - HASTA: <b>{{ $date2 }}</b> </P> 
            <p >FECHA DE IMPRESION: {{ $fecha }} </p>
            </div>
      
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color" >
                    <th class="text-center" colspan="2">CANTIDADES</th>
                </tr>
                <tr>
                    <th>CLIENTES</th>   
                    <td>{{ $totalclientes }}</td>            
                </tr>
                <tr>
                    <th>PROVEEDORES</th>   
                    <td>{{ $totalproveedores }}</td>          
                </tr>
                <tr>
                    <th>PRODUCTOS</th>   
                    <td>{{ $totalproductos }}</td>            
                </tr>
            </thead>            
        </table>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th class="text-center" colspan="2">ESTADO DE PEDIDOS</th>
                </tr>
                <tr>
                    <th>ESTADO</th>
                    <th>CANTIDAD</th>
                </tr>
                <tr>
                    <th>COTIZACIONES</th>   
                    <td>{{ $num_cot[0]->total }}</td>            
                </tr>
                <tr>
                    <th>PRE-ORDEN</th>   
                    <td>{{ $num_pre[0]->total }}</td>            
                </tr>
                
                <tr>
                    <th>COMPRA</th>   
                    <td>{{ $num_com[0]->total }}</td>            
                </tr>
                <tr>
                     <th>AGENDADOS</th>
                     <td>{{ $num_agen[0]->total }}</td>
                </tr>
                <tr>
                    <th>ENTREGADOS</th>
                    <td>{{ $num_ent[0]->total}}</td>
               </tr>
               <tr>
                <th>FACTURADOS</th>
                <td>{{ $num_fact[0]->total}}</td>
           </tr>
            </thead>            
        </table>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th class="text-center" colspan="2">MEJORES CINCO CLIENTES</th>
                </tr>
                <tr>
                <th>CLIENTE</th>
                <th>CANTIDAD DE PEDIDOS</th>

                </tr>
               @foreach ($clientes as $item)
                   <tr>
                       <th>{{ $item->cliente }}</th>
                       <td>{{ $item->cantidad }}</td>
                   </tr>
               @endforeach
            </thead>            
        </table>

        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th class="text-center" colspan="2">COMPRAS A PROVEEDORES</th>
                </tr>
                <tr>
                <th>PROVEEDOR</th>
                <th>CANTIDAD DE COMPRAS</th>
            </tr>
               @foreach ($providers as $item)
                   <tr>
                       <th>{{ $item->proveedor }}</th>
                       <td>{{ $item->cantidad }}</td>
                   </tr>
               @endforeach
            </thead>            
        </table>
        <br>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th class="text-center" colspan="2">PRODUCTO MAS COMPRADOS</th>
                </tr>
                <tr>
                    <th>NOMBRE</th>
                    <th>CANTIDAD</th>
                </tr>
               @foreach ($productos as $item)
                   <tr>
                       <th>{{ $item->producto }}</th>
                       <td>{{ $item->total }}</td>
                   </tr>
               @endforeach
            </thead>            
        </table>
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th class="text-center" colspan="2">DESTINOS</th>
                </tr>
                <tr>
                    <th>NOMBRE</th>
                    <th>CANTIDAD</th>
                </tr>
               @foreach ($destinos as $item)
                   <tr>
                       <th>{{ $item->destino }}</th>
                       <td>{{ $item->cantidad }}</td>
                   </tr>
               @endforeach
            </thead>            
        </table>
        
        @if(count($productosDia)> 0)
                <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th class="text-center" colspan="3">PRODUCTOS COMPRADOS </th>
                </tr>
                <tr>
                    <th>PRODUCTO</th>
                    <th>TOTAL</th>
                    <th>PROVEEDOR</th>
                </tr>
               @foreach ($productosDia as $item)
                   <tr>
                       <th>{{ $item->name_product }}</th>
                       <th>{{ $item->total }}</th>
                       <td>{{ $item->full_name }}</td>
                   </tr>
               @endforeach
            </thead>            
        </table>
        @endif

        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th class="text-center" colspan="3">VIAJES POR CONDUCTOR</th>
                </tr>
                <tr>
                    <th>CONDUCTOR</th>
                    <th>PLACA</th>
                    <th>CANTIDAD DE VIAJES</th>
                </tr>
               @foreach ($viajes_conductor as $item)
                   <tr>
                       <th>{{ $item->conductor }}</th>
                       <th>{{ $item->placa }}</th>
                       <td>{{ $item->cantidad }}</td>
                   </tr>
               @endforeach
            </thead>            
        </table>

    </div>




</body>


</html>