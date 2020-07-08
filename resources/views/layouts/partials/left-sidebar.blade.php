<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
            <div class="email"></div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Cerrar Sesion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
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
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="{{activeSubMenu('home')}}">
                <a href="{{route('home')}}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>

            <li class="header">Gestion Clientes</li>
            <li class="{{activeMenu(['customer*'])}}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">account_circle</i>
                    <span>Clientes</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{activeSubMenu('customer*')}}">
                        <a href="{{route('customers.index')}}">
                            <span>Modulo Clientes</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="header">Gestion Pedido</li>
            <li class="{{activeMenu(['order*','typepayment.index','timepayment*','oderstatus*', 'purchase.*', 'despacho.*'])}}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">add_shopping_cart</i>
                    <span>Pedidos</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{activeSubMenu('order.*')}}">
                    <a href="{{route('orders.index')}}">
                            <span>Modulo Pedidos</span>
                        </a>
                    </li>
                    <li class="{{activeSubMenu('purchase.*')}}">
                        <a href="{{route('purchase.index')}}">
                            <span>Modulo Compras</span>
                        </a>
                    </li>

                    <li class="{{activeSubMenu('despacho.*')}}">
                        <a href="{{route('despacho.index')}}">
                            <span>Modulo Agenda</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="javascript:void(0)">
                            <span>Modulo Despacho</span>
                        </a>
                    </li>
 
 
                    <li class="{{activeSubMenu('typepayment*')}}">
                        <a href="{{route('typepayment.index')}}">
                            <span>Modulo Tipos de Pagos</span>
                        </a>
                    </li>
 
                    <li class="{{activeSubMenu('timepayment*')}}">
                        <a href="{{route('timepayment.index')}}">
                             <span>Modulo Tiempos de Pago</span>
                        </a>
                    </li>

                    <li class="{{activeSubMenu('orderstatus.index')}}">
                        <a href="{{route('orderstatus.index')}}">
                             <span>Modulo Status Pedidos</span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>

            <li class="header">Gestion Proveedores</li>
            <li class="{{activeMenu(['typeprovider*','provider*'])}}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">school</i>
                    <span>Proveedor</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{activeSubMenu('typeprovider*')}}">
                        <a href="{{route('typeprovider.index')}}">
                            <span>Modulo Tipos de Proveedores</span>
                        </a>
                    </li>
                    <li class="{{activeSubMenu('provider*')}}">
                        <a href="{{route('provider.index')}}">
                            <span>Modulo Proveedores</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="header">Gestion Productos</li>
            <li class="{{activeMenu(['category*', 'typeunit*', 'product*'])}}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">school</i>
                    <span>Producto</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{activeSubMenu('category*')}}">
                        <a href="{{route('category.index')}}">
                            <span>Modulo Categorias</span>
                        </a>
                    </li>
                    <li class="{{activeSubMenu('typeunit*')}}">
                        <a href="{{route('typeunit.index')}}">
                            <span>Modulo Tipos de Unidades</span>
                        </a>
                    </li>
                    <li class="{{activeSubMenu('product*')}}">
                        <a href="{{route('product.index')}}">
                            <span>Modulo Productos</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <span>Modulo Precios</span>
                        </a>
                    </li>
                       
                </ul>
            </li>

            <li class="header">Gestion Conductores y Vehiculos</li>
            <li class="{{activeMenu(['driver.*', 'vehicle.*'])}}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">school</i>
                    <span>Conductores y Vehiculos</span>
                </a>
                <ul class="ml-menu">
                    <li  class="{{activeSubMenu('driver.*')}}">
                    <a href="{{route('driver.index')}}">
                            <span>Modulo Conductores</span>
                        </a>
                    </li>
                    <li class="{{activeSubMenu('vehicle.*')}}">
                    <a href="{{route('vehicle.index')}}">
                            <span>Modulo Vehiculos</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <span>Modulo Status Vehiculo</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <span>Modulo Asignacion Conductor-Vehiculo</span>
                        </a>
                    </li>
                       
                </ul>
            </li>




            

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2019 <a href="javascript:void(0);">Plataforma - Atlantis</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.0
        </div>
    </div>
    <!-- #Footer -->
</aside>