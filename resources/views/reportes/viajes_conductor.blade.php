<!doctype html>
<html lang="en">

<head><meta charset="gb18030">
    <title>Reporte</title>
    <!-- Required meta tags -->
    
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
            <h4 class="text-center">REPORTE VIAJES POR CONDUCTORES</h4><br>
            <P>DESDE: {{ $date1 }} HASTA {{ $date2 }}</P>           
            <p >Fecha De Elaboración: {{ $fecha }}</p>
        </div>
       
        <table class="table table-condensed table-bordered ">
            <thead>
                <tr class="tr-color">
                    <th>#</th>
                    <th>CONDUCTOR</th>
                    <th>PLACA</th>
                    <th>CANTIDAD ENTREGAS</th>  
                    <th>CANTIDAD VIAJES</th>  
                </tr>

            </thead>
            <tbody>
              
                @foreach($viajes as $v)
                
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$v->conductor}}</td>   
                    <td>{{$v->placa}}</td>                   
                    <td>{{$v->entregas}}</td>
                    <td>{{$v->viajes}}</td>
                </tr>
                @endforeach
                
            </tbody>
            
        </table>  
      
       
       
              
               
    </div>




</body>
@if (session()->has('warning'))
<script type="text/javascript">
	success('{{ session('warning') }}');
</script>
@endif

</html>