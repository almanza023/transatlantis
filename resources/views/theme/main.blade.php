<!DOCTYPE html>
<html lang="en">
  <head>
    @include('theme.header')
    <title>@yield('titulo')</title>
    @yield('extra-css')

  </head>
  <body>
   
    @include('theme.navbar')

    @include('theme.sidebar')

    <div class="slim-mainpanel">
      <div class="container">
        <div class="slim-pageheader">
          <ol class="breadcrumb slim-breadcrumb">
           
          </ol>
          <h6 class="slim-pagetitle">PLATAFORMA ATLANTIS</h6>
        </div><!-- slim-pageheader -->
        @yield('content')
      </div><!-- container -->
    </div><!-- slim-mainpanel -->
    @include('modals.modal-cambio-clave')
    @include('theme.footer')

    @include('theme.scripts')
    
    @yield('extra-scripts')
  </body>
</html>
