@extends('Usuario.masterUsuario')
@section('menu')
@parent
@stop



@section('contenido')
<form action="{{action('usuarioController@loggin_in')}}" method="POST" class="formitas">
    <h1>Bienvenido</h1>
    <table class="formTabulado">
        {{csrf_field()}}
        <tr>
            <td>
                <label for="codigo_user">Codigo</label>
            </td>
            <td>
                <input type="text" name="codigo_user" required minlength="8" maxlength="10" pattern="[0-9]+"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="password_user">Contraseña </label>
            </td>
            <td>
                <input type="password" name="password_user" required minlength="6" />
            </td>
        </tr>
        
        @if(session('mensaje'))
        <p class="alerta_error">
            {{session('mensaje')}}
        </p>
        @endif
    </table>
    <input type="submit" value="Iniciar sesion"/>
</form>


    <p class="cambioLog">
        No tienes una cuenta?
        <a href="{{action('usuarioController@reg')}}">Registrarse</a>
    </p>
    

@stop