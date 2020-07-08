<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />

    @section('css')

    <!-- Google Fonts -->
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
     

    <!-- all Css -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/all-themes.min.css') }}" rel="stylesheet" />

    @show

    @yield('extra-css')



</head>

<body class="theme-red">
    
    {{--Overlay For Sidebars--}}
    <div class="overlay"></div>
    {{-- FIN Overlay For Sidebars--}}

    {{-- Search Bar --}}
    {{-- FIN Search Bar --}}

    {{-- Top Bar --}}
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" style="margin-left:35px;" href="{{route('home')}}">Plataforma Atlantis</a>
            </div>
            {{-- Call Search --}}
            {{-- FIN Call Search --}}
    
            {{-- Notifications --}}
            {{-- FIN Notifications --}}
    
            {{-- Tasks --}}
            {{-- FIN Tasks --}}
            
        </div>
    </nav>
    {{-- FIN Top Bar --}}


    <section>
        {{-- LEFT Sidebar--}}
        @include('layouts.partials.left-sidebar')
        {{-- FIN LEFT Sidebar--}}

        {{-- RIGHT Sidebar--}}
        {{-- FIN RIGHT Sidebar--}}
    </section>

    <section class="content">
        @yield('content')
    </section>

    @section('scripts')

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    
    


    @show

    @yield('extra-scripts')

</body>

</html>