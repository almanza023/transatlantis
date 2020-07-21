@php 
    function activeMenu(array $urls)
    {
       foreach ($urls as $url)
       {
           if (Route::is($url)){
               return 'active';
           break;
           }
       }
    }

    function activeSubMenu($url)
    {
        return Route::is($url) ? 'active' : '';
    }
    @endphp

<div class="slim-navbar">
    <div class="container">
      <ul class="nav">
        <li class="nav-item {{activeSubMenu('home')}}">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="icon ion-ios-home-outline"></i>
            <span>INICIO</span>
          </a>
          
        </li>
        @if (auth()->user()->hasRole('cliente') )  
        <li class="nav-item with-sub  {{activeMenu(['quotation*'])}}">
          <a class="nav-link " href="#">
           
            <i class="icon ion-ios-analytics"></i>
            <span>COTIZACIONES</span>
          </a>
          <div class="sub-item">
            <ul>
              <li class=""><a href="{{ route('quotation.create') }}">Registro</a></li>
              <li><a href="{{ route('quotation.index') }}">Consulta</a></li>
            
            </ul>
          </div><!-- dropdown-menu -->
        </li>
        @endif

        @if (auth()->user()->hasRole('conductor') )  
        <li class="nav-item with-sub  {{activeMenu(['quotation*'])}}">
          <a class="nav-link " href="#">
           
            <i class="icon ion-ios-analytics"></i>
            <span>AGENDA</span>
          </a>
          <div class="sub-item">
            <ul>
              
              <li><a href="{{ route('agendados') }}">Consulta</a></li>
            
            </ul>
          </div><!-- dropdown-menu -->
        </li>
        @endif
        @if (auth()->user()->hasRole('proveedor') )  
        <li class="nav-item with-sub  {{activeMenu(['quotation*'])}}">
          <a class="nav-link " href="#">
           
            <i class="icon ion-ios-analytics"></i>
            <span>PEDIDOS</span>
          </a>
          <div class="sub-item">
            <ul>
              <li><a href="{{ route('provider.productos') }}">Productos Solicitados</a></li>
            
            </ul>
          </div><!-- dropdown-menu -->
        </li>
        @endif
        {{--  Facturador --}}
        @if (auth()->user()->hasRole('regular'))  
        <li class="nav-item with-sub mega-dropdown {{activeMenu(['orders*', 'product*'])}}">
          <a class="nav-link" href="#">
            <i class="icon ion-ios-filing-outline"></i>
            <span>PEDIDOS</span>
          </a>
          <div class="sub-item">
            <div class="row">
              <div class="col-lg-5">
                <label class="section-label">MODULO DE PEDIDOS</label>
                <div class="row">
                  <div class="col">
                    <ul>                     
                      <li><a href="{{ route('order.facturar') }}">Facturar</a></li>                    
                    </ul>
                  </div><!-- col -->

                </div><!-- row -->
              </div><!-- col -->
              
           
              
            </div><!-- row -->
          </div><!-- dropdown-menu -->
        </li>

     
        <li class="nav-item with-sub {{activeSubMenu('orders.report')}}">
          <a class="nav-link" href="#">
            <i class="icon ion-ios-book-outline"></i>
            <span>Reportes</span>
          </a>
          <div class="sub-item">
            <ul>             
              <li><a href="{{ route('reporte.facturados') }}">Pedidos Facturados</a></li>
              <li><a href="{{ route('reporte.compra') }}">Compra a Proveedores</a></li>           
             
            </ul>
          </div><!-- dropdown-menu -->
        </li>
      
        @endif


        @if (auth()->user()->hasRole('super-admin') )  
        <li class="nav-item {{activeSubMenu('#')}}">
          <a class="nav-link" href="#">
            <i class="icon ion-ios-world"></i>
            <span>UBICACION</span>
          </a>
          
        </li>
        @endif
        @if (auth()->user()->hasRole('super-admin') )  
        <li class="nav-item {{activeSubMenu('customers.index')}}">
          <a class="nav-link" href="{{ route('customers.index') }}">
            <i class="icon ion-ios-person-outline"></i>
            <span>CLIENTES</span>
          </a>
        </li>
        @endif
        @if (auth()->user()->hasRole('super-admin') )  
        <li class="nav-item with-sub  {{activeMenu(['provider*'])}}">
          <a class="nav-link " href="#">
           
            <i class="icon ion-ios-analytics"></i>
            <span>PROVEEDORES</span>
          </a>
          <div class="sub-item">
            <ul>
              <li class=""><a href="{{ route('provider.create') }}">Registro</a></li>
              <li><a href="{{ route('provider.index') }}">Consulta</a></li>
             
            
            </ul>
          </div><!-- dropdown-menu -->
        </li>
        @endif
        @if (auth()->user()->hasRole('super-admin'))  
        <li class="nav-item with-sub mega-dropdown {{activeMenu(['orders*', 'product*'])}}">
          <a class="nav-link" href="#">
            <i class="icon ion-ios-filing-outline"></i>
            <span>PEDIDOS</span>
          </a>
          <div class="sub-item">
            <div class="row">
              <div class="col-lg-5">
                <label class="section-label">MODULO DE PEDIDOS</label>
                <div class="row">
                  <div class="col">
                    <ul>
                      <li><a href="{{ route('orders.create') }}">Crear</a></li>
                      <li><a href="{{ route('orders.index') }}">Consultar</a></li>
                      <li><a href="{{ route('agendados') }}">Registrar Entregas</a></li>
                      <li><a href="{{ route('quotation.index') }}">Cotizaciones</a></li>
                      <li><a href="{{ route('order.facturar') }}">Facturar</a></li>

                      
                    </ul>
                  </div><!-- col -->

                </div><!-- row -->
              </div><!-- col -->
              
           
              
            </div><!-- row -->
          </div><!-- dropdown-menu -->
        </li>
        @endif
        @if (auth()->user()->hasRole('super-admin'))  
        <li class="nav-item with-sub {{activeSubMenu('orders.report')}}">
          <a class="nav-link" href="#">
            <i class="icon ion-ios-book-outline"></i>
            <span>Reportes</span>
          </a>
          <div class="sub-item">
            <ul>
              <li><a href="{{ route('liquidacion.index') }}">Liquidación Conductores</a></li>
              <li><a href="{{ route('despacho.index') }}">Agenda</a></li>
              <li><a href="{{ route('orders.report') }}">Pedidos</a></li>
              <li><a href="{{ route('entregas.conductor') }}">Entregas Por Conductor</a></li>
              <li><a href="{{ route('estadistica') }}">Estadisticas</a></li> 
              <li><a href="{{ route('reporte.general') }}">Reporte General</a></li>
              <li><a href="{{ route('reporte.facturados') }}">Pedidos Facturados</a></li>
              <li><a href="{{ route('reporte.compra') }}">Compra a Proveedores</a></li>
              <li><a href="{{ route('reporte.viajes') }}">Viajes Conductores</a></li>
              <li><a href="{{ route('reporte.historial') }}">Historial de Día</a></li>
             
            </ul>
          </div><!-- dropdown-menu -->
        </li>
        @endif
        @if (auth()->user()->hasRole('super-admin'))  
        <li class="nav-item with-sub {{activeSubMenu('product.*')}}">
          <a class="nav-link" href="#" data-toggle="dropdown">
            <i class="icon ion-ios-gear-outline"></i>
            <span>CONFIGURACIONES</span>
          </a>
          <div class="sub-item">
            <ul>
              <li><a href="{{ route('product.index') }}">Productos</a></li>
              <li><a href="{{ route('vehicle.index') }}">Vehiculos</a></li>
              <li><a href="{{ route('driver.index') }}">Conductores</a></li>            
              <li><a href="{{ route('typeprovider.index') }}">Tipo de Proveedores</a></li>
              <li><a href="{{ route('timepayment.index') }}">Tiempo de Pago</a></li>
              <li><a href="{{ route('orderstatus.index') }}">Estado de Pedidos</a></li>
              <li><a href="{{ route('typeunit.index') }}">Tipo de Unidades</a></li>
              <li><a href="{{ route('orderstatus.index') }}">Estado de Ordenes</a></li>
              <li><a href="{{ route('driver_vehicle.index') }}">Asignar Vehiculo</a></li>
              
            </ul>
          </div><!-- dropdown-menu -->
         
        </li>
        @endif
        
        
       
        
      </ul>
    </div><!-- container -->
  </div><!-- slim-navbar -->