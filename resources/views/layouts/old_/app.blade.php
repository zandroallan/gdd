<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Page title -->
        <title>SGD v2.0 | Gestión documental</title>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->
        <!-- Vendor styles -->
                
        {!! Html::style('template/vendor/bootstrap/dist/css/bootstrap.css'); !!}
        {!! Html::style('template/vendor/fontawesome/css/font-awesome.css'); !!}
        {!! Html::style('template/vendor/metisMenu/dist/metisMenu.css'); !!}
        {!! Html::style('template/vendor/animate.css/animate.css'); !!}        
        {!! Html::style('template/vendor/ladda/dist/ladda-themeless.min.css'); !!}
        <!-- App styles -->
        {!! Html::style('template/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css'); !!}
        {!! Html::style('template/fonts/pe-icon-7-stroke/css/helper.css'); !!}
        {!! Html::style('template/styles/style.css'); !!}
        {!! Html::style('css/app.css'); !!}
        {!! Html::style('js/sweetalert2-7.33.1/sweetalert2.css'); !!}
        {!! Html::style('template/vendor/jasny-bootstrap/css/jasny-bootstrap.css'); !!}
        @yield('css')
    </head>
    <body class="fixed-small-header sidebar-scroll fixed-navbar">

        <!-- HEADER -->
        <div id="header">
            <div class="color-line"></div>
            <div id="logo" class="light-version">
                <span>SGD v2.0</span>
            </div>
            <nav role="navigation">
                <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
                <div class="small-logo">
                    <span class="text-primary">SGD v2.0</span>
                </div>

                @include('layouts.buscador')
                @include('layouts.top-navbar-mobile')

                <div class="navbar-right">
                    <ul class="nav navbar-nav no-borders">
                        @include('layouts.top-navbar-notify')
                        @include('layouts.top-navbar-quick')
                        @include('layouts.top-navbar-inbox')
                        @include('layouts.logout')
                    </ul>
                </div>
            </nav>
        </div>

        <!-- MENÚ -->
        <aside id="menu">
            <div id="navigation">
                <div class="profile-picture">
                    <a href="index.html">
                        {{ Html::image('img/fotos/'.Auth::User()->curp.'.jpg', 'Logo',['class' => 'img-circle m-b', 'height' => 76]) }} 
                    </a>
                    <div class="stats-label text-color">
                        <span class="font-extra-bold font-uppercase">{{ Auth::User()->nombre }}</span>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                <small class="text-muted">Mi cuenta<b class="caret"></b></small>
                            </a>
                            <ul class="dropdown-menu animated flipInX m-t-xs">
                                <li><a href="contacts.html">Cambiar contraseña</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesión                                        
                                    </a>  
                                </li>                              
                            </ul>
                        </div>
                    </div>
                </div>
                
                @if(Auth::User()->hasRole(['Oficialia']))
                    @include('layouts.menu.oficialia-partes')
                @endif
                @if(Auth::User()->hasRole(['Titular']))
                    @include('layouts.menu.titulares')
                @endif 
                @if(Auth::User()->hasRole(['Coordinacion']))
                    @include('layouts.menu.coordinacion')
                @endif               

            </div>
        </aside>

        <div id="wrapper">
            @include('layouts.breadcrumb')
            <div class="content animate-panel">
                <div id="vHTMLSignature"></div>
                <input type="hidden" name="txtcurp" id="txtcurp" value="{{ Auth::User()->curp }}">
                @yield('content')
                
            </div>
        </div>     

        <!-- Vendor scripts -->
        {!! Html::script('template/vendor/jquery/dist/jquery.min.js'); !!} 
        {!! Html::script('template/vendor/jquery-ui/jquery-ui.min.js'); !!}
        {!! Html::script('template/vendor/slimScroll/jquery.slimscroll.min.js'); !!}
        {!! Html::script('template/vendor/bootstrap/dist/js/bootstrap.min.js'); !!}   
        {!! Html::script('template/vendor/metisMenu/dist/metisMenu.min.js'); !!}  
        {!! Html::script('template/vendor/iCheck/icheck.min.js'); !!}   
        {!! Html::script('template/vendor/sparkline/index.js'); !!}        
        {!! Html::script('template/vendor/ladda/dist/spin.min.js'); !!}
        {!! Html::script('template/vendor/ladda/dist/ladda.min.js'); !!}
        {!! Html::script('template/vendor/ladda/dist/ladda.jquery.min.js'); !!}
        <!-- App scripts -->
        {!! Html::script('template/scripts/homer.js'); !!}
        {!! Html::script('js/sweetalert2-7.33.1/sweetalert2.min.js'); !!}
        <script type="text/javascript"> 
            var vuri=window.location.origin;
        </script>
        @yield('js')
        <script> @yield('scripts'); </script>
                
        
    </body>
</html>