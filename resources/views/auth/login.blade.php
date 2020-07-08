<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Meta -->
      <meta name="description" content="Plataforma Atlantis.">
      <meta name="author" content="ThemePixels">
      <title>INICIO DE SESIÓN</title>
      <!-- Vendor css -->
      <link href="{{ asset('theme/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
      <link href="{{ asset('theme/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
      <!-- Slim CSS -->
      <link rel="stylesheet" href="{{ asset('theme/css/slim.css') }}">
    <link href="{{asset('plugins/toast/jquery.toast.min.css')}}" rel="stylesheet" />

   </head>
   <body>
      <div class="signin-wrapper">
         <div class="signin-box">

            <h2 class="slim-logo"></h2>
            <center><img src="{{ asset('images/logo.png') }}" alt="" class="img-circle"></center>
            <h2 class="signin-title-primary"><center>PLATAFORMA ATLANTIS SOFT v1.0</center></h2>
            <h3 class="signin-title-secondary">Ingresa tus datos de acceso.</h3>
            <form id="form_validation" method="POST" action="{{ route('login') }}">
               @csrf               
               <div class="form-group">
                 
                  <div class="form-line{{ $errors->has('email') ? 'error' : '' }}">
                     <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu usuario" value="{{ old('cedula') }}" required autofocus>
                     @if ($errors->has('email'))
                     <label id="email-error" class="error" for="email">
                     {{$errors->first('email')}}
                     </label>
                     @endif
                  </div>
               </div>
               <div class="form-group">
                  
                  <div class="form-line{{ $errors->has('password') ? 'error' : '' }}">
                     <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                     @if ($errors->has('password'))
                     <label id="password-error" class="error" for="password">
                     {{$errors->first('password')}}
                     </label>
                     @endif
                  </div>
               </div>
               <button type="submit" class="btn btn-main btn-block " ><i class="fa fa-check"></i> INGRESAR</button>
            </form>
         </div>
         <!-- signin-box -->
      </div>
      <!-- signin-wrapper -->
      <script src="{{ asset('theme/lib/jquery/js/jquery.js ') }}"></script>
      <script src="{{ asset('theme/lib/popper.js/js/popper.js') }}"></script>
      <script src="{{ asset('theme/lib/bootstrap/js/bootstrap.js') }}"></script>
      <script src="{{ asset('theme/js/slim.js') }}"></script>
      <script src="{{asset('plugins/toast/jquery.toast.min.js')}}"></script>

      <script src="{{ asset('js/login.js') }}"></script>
   </body>
</html>