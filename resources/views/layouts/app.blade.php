<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $enterprise_public->short_name or "Transporte Digital" }} | FestCar</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    {!! Html::style('/bower_components/admin-lte/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('/dependencia_local/bootstrap-xlgrid.min.css') !!}
    {!! Html::style('/bower_components/components-font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('/bower_components/select2/dist/css/select2.min.css') !!}
    {!! Html::style('/bower_components/admin-lte/dist/css/AdminLTE.min.css') !!}
    {!! Html::style('/bower_components/admin-lte/dist/css/skins/_all-skins.min.css') !!}
    <!-- Linear Icons -->
    {!! Html::style('/dependencia_local/icon-font.min.css') !!}
    <!-- Simple Line icons -->
    {!! Html::style('/dependencia_local/simple-line-icons.min.css') !!}
    <!-- Ionicons -->
    {!! Html::style('/bower_components/Ionicons/css/ionicons.min.css') !!}
    <!-- Animsitun -->
    {!! Html::style('/dependencia_local/animsition.min.css') !!}
    <!-- datepicker -->
    {!! Html::style('/dependencia_local/bootstrap-datepicker.min.css') !!}
    <!-- skin icheck -->
    {!! Html::style('/bower_components/admin-lte/plugins/iCheck/square/blue.css') !!}


    <!-- /dependencia_local/ -->

    <!-- select2 -->
    <!--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    -->
    <!-- FLATICONS Custom -->
    {!! Html::style('/css/flaticon_bus/flaticon.css') !!}

    <!-- CSS PRINCIPAL WEB PAGE CUSTOM-->
    {!! Html::style('/css/main.css') !!}
    <!-- FavICONS ================================================== -->

    @if (Auth::guest())
          {!! Html::style('/css/guest.css') !!}
    @endif

        <link rel="apple-touch-icon" sizes="57x57" href="{!! url('/favicon/apple-icon-57x57.png') !!}">
        <link rel="apple-touch-icon" sizes="60x60" href="{!! url('/favicon/apple-icon-60x60.png') !!}">
        <link rel="apple-touch-icon" sizes="72x72" href="{!! url('/favicon/apple-icon-72x72.png') !!}">
        <link rel="apple-touch-icon" sizes="76x76" href="{!! url('/favicon/apple-icon-76x76.png') !!}">
        <link rel="apple-touch-icon" sizes="114x114" href="{!! url('/favicon/apple-icon-114x114.png') !!}">
        <link rel="apple-touch-icon" sizes="120x120" href="{!! url('/favicon/apple-icon-120x120.png') !!}">
        <link rel="apple-touch-icon" sizes="144x144" href="{!! url('/favicon/apple-icon-144x144.png') !!}">
        <link rel="apple-touch-icon" sizes="152x152" href="{!! url('/favicon/apple-icon-152x152.png') !!}">
        <link rel="apple-touch-icon" sizes="180x180" href="{!! url('/favicon/apple-icon-180x180.png') !!}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{!! url('/favicon/android-icon-192x192.png') !!}">
        <link rel="icon" type="image/png" sizes="32x32" href="{!! url('/favicon/favicon-32x32.png') !!}">
        <link rel="icon" type="image/png" sizes="96x96" href="{!! url('/favicon/favicon-96x96.png') !!}">
        <link rel="icon" type="image/png" sizes="16x16" href="{!! url('/favicon/favicon-16x16.png') !!}">
        <link rel="manifest" href="{!! url('/favicon/manifest.json') !!}">
        <meta name="msapplication-TileColor" content="#ffffff') !!}">
        <meta name="msapplication-TileImage" content="{!! url('/favicon//ms-icon-144x144.png') !!}">
        <meta name="theme-color" content="#ffffff">
        <!-- favicons -->

    @yield('css')
    @stack('css')
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <span class="logo-mini"><b>T</b>RS</span>
                <span class="logo-lg"><b>T</b>ranseba</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                @if(Auth::user()->role != 'autorizador_emdisalud')
                                    <img  src="{{ asset('/multimedia/profiles/default.png') }}" class="user-image" alt="imagen de usuario"/>
                                @else
                                    <img  src="{{ asset('/multimedia/profiles/logo_emdi.png') }}" class="user-image" alt="imagen de usuario"/>
                                @endif                                    
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->nombres !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    @if(Auth::user()->role != 'autorizador_emdisalud')
                                        <img  src="{{ asset('/multimedia/profiles/default.png') }}" class="img-circle" alt="imagen de usuario"/>
                                    @else
                                        <img  src="{{ asset('/multimedia/profiles/logo_emdi.png') }}" class="img-circle" alt="imagen de usuario"/>
                                    @endif 
                                    
                                    <p>
                                        {!! Auth::user()->fullname !!}

                                        <small>Miembro desde {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                        <small>({!! ucwords(Auth::user()->role) !!})</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat">Cerrar session</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        
            @yield('content')
        
            
        </div>

        <!-- Main Footer -->

        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2017 <a href="">FestCar</a>.</strong> Todos los derechos reservados.
        </footer>
    </div> <!-- End wrapper -->
    
@else
<!-- USUARIO O INVITADO -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                    {{ $enterprise_public->short_name or "Transporte Digital" }} 
                    {{-- {!! Auth::guest() !!} --}} <!-- logged? -->
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/home') !!}">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">PQRS <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!! url('/pqrsPublic/create') !!}">Radicar</a></li>
                            <li><a href="{!! url('/pqrsPublic/consulta') !!}">Consultar</a></li>                        
                        </ul>
                      </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Iniciar sesión </a></li>
                    {{-- <li><a href="{!! url('/register') !!}">Registrarse</a></li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery -->
    {!! HTML::script('/dependencia_local/jquery.min.js') !!}
    {!! HTML::script('/bower_components/admin-lte/bootstrap/js/bootstrap.min.js') !!}
    {!! HTML::script('/bower_components/select2/dist/js/select2.min.js') !!} 

    <!-- AdminLTE App -->
    {!! HTML::script('/bower_components/admin-lte/dist/js/app.min.js') !!}
    <!-- Vue.js -->
    <!-- 
    {!! HTML::script('/dependencia_local/vue.js"') !!} // COMENTADO
    --> 
    <!-- select2 español -->
    {!! HTML::script('/bower_components/select2/dist/js/i18n/es.js') !!}
    <!-- datepicker  -->
    {!! HTML::script('/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js') !!}
    <!-- datepicker español -->
    {!! HTML::script('/bower_components/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.es.js') !!}
    {!! HTML::script('/bower_components/admin-lte/plugins/iCheck/icheck.min.js') !!}

    <!-- input mask -->
    {!! HTML::script('/js/jquery.inputmask.bundle.min.js') !!}
    <!-- Animsition -->
    {!! HTML::script('/dependencia_local/animsition.min.js') !!}
     <!-- Animsition ini -->
    {!! HTML::script('/js/main.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
          $(".animsition").animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 1500,
            outDuration: 800,
            linkElement: '.animsition-link',
            // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
            loading: true,
            loadingParentElement: 'body', //animsition wrapper element
            loadingClass: 'animsition-loading',
            loadingInner: '', // e.g '<img src="loading.svg" />'
            timeout: false,
            timeoutCountdown: 5000,
            onLoadEvent: true,
            browser: [ 'animation-duration', '-webkit-animation-duration'],
            // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
            // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
            overlay : false,
            overlayClass : 'animsition-overlay-slide',
            overlayParentElement : 'body',
            transition: function(url){ window.location.href = url; }
          });
          console.log('%cReady To FestCar - PowerBy XSEDUARD', 'color:green;');          
        });
    </script>
     <!-- Animsition end ini -->
    @yield('scripts')
    @stack('scripts')
</body>
</html>