<div class="slim-header">
    <div class="container">
      <div class="slim-header-left">
        <img src="{{ asset('images/logo.png') }}" alt="" width="220px" height="
        70px">
     
       
        
      </div><!-- slim-header-left -->
      <div class="slim-header-right">        
        <div class="dropdown dropdown-c">
          <a href="#" class="logged-user" data-toggle="dropdown">
            <img src="http://via.placeholder.com/500x500" alt="">
            <span> {{ auth()->user()->email }}</span>
            <i class="fa fa-angle-down"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <nav class="nav">
              <!--<a href="page-profile.html" class="nav-link"><i class="icon ion-person"></i> View Profile</a> -->
                <!-- <a href="page-edit-profile.html" class="nav-link"><i class="icon ion-compose"></i> Edit Profile</a> -->
                  <!-- <a href="page-activity.html" class="nav-link"><i class="icon ion-ios-bolt"></i> Activity Log</a> -->
                    <!--<a href="page-settings.html" class="nav-link"><i class="icon ion-ios-gear"></i> Account Settings</a> -->
              <li>
                <a href='#modalPerfil' data-toggle='modal' data-href="{{ route('perfil', auth()->user()->id) }} " class="nav-link"><i class="icon ion-edit"></i>Perfil</a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="icon ion-close"></i> Cerrar Sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </li>
            </nav>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </div><!-- header-right -->
    </div><!-- container -->
  </div><!-- slim-header -->
