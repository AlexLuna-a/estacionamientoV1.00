<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>QCI's Parking</title>
        <meta lang="es"/>
        <link rel="stylesheet" type="text/css" href="/css/estilos.css"/>
    </head>
    <body>
        <!--CABECERA -->
        <div class="Cabecera">
            <!--LOGO -->
            <div class="Logo">
                <div id="imagen">
                    <a href="{{action('usuarioController@index')}}"><image src="/css/Logo/Logo_qci.jpg"/></a>
                </div>    
            </div>
            <!--TITULO -->
            <div id="titulo">
                <a href="{{action('usuarioController@index')}}">Estacionate CUCEI</a>
            </div>
            @if(session('usuario') ){{--existencia de usuario --}}
            <!-- MENU -->
            <nav class="menu">
                <ul>
                    <li>
                        <a href="{{action('usuarioController@index')}}">inicio</a>
                </li>
                <li>
                    <a href="{{action('estacionamientoController@index')}}">Estacionamientos</a>
                </li>
                <li>
                    <a href="{{action('movimientoController@index')}}">Movimientos</a>
                </li>
                <li>
                    <a href="">Vehiculos</a>
                </li>
                @if(session()->exists('nivel'))
                @if(session('nivel')>=9)
                <li>
                    <a href="">Control acceso</a>
                </li>
                @endif
                @if(session('nivel')==10)
                <li>
                    <a href="">Administrar</a>
                </li>
                @endif

                @endif
                
                @yield('menu')
            </ul>
        </nav>

        <div class="boton_log">
            <div class="dropdown">
                <button class="dropbtn">{{session('usuario')->nombre_user}}</button>{{-- Nomnre de usuario --}}
                <div class="dropdown-content">
                    <a href="{{action('usuarioController@edit')}}">Administrar cuenta</a>
                    <a href="{{action('usuarioController@loggout')}}">Cerrar sesion</a>
                </div>
            </div>
        </div>

        @endif
    </div>

    <div class="contenedor">
        @yield('contenido')
    </div>
    <div class="pie">

    </div>
</body>
</html>



