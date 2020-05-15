@extends('Usuario.masterUsuario')
@section('menu')
@stop

@section('contenido')
<form action="{{action('usuarioController@reg_in')}}" method="POST" class="formitas">
    <h1>
        @if(isset($accion))
        {{$accion}}
        @else
        Registrate
        @endif
    
    </h1>
    {{csrf_field()}}
    <p class='alerta_error'>{{session('mensajeError') ?? ''}}</p>
    <p class='alerta_exito'>{{session('mensajeCompleto') ?? ''}}</p>
    <table class="formTabulado">
        <tr>
            <td>
                <label for="nombre">Nombre(s)</label>
            </td>
            <td>
                <input type="text" name="nombre" required value="{{$usuario->nombre_user ?? ''}}"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="apellidoP">Apellido paterno</label>
            </td>
            <td>
                <input type="text" name="apellidoP" required value="{{$usuario->apellido_p_user ?? ''}}"/>
            </td>
        </tr>
        <tr>
            <td><p></p>
                <label for="apellidoM">Apellido Materno</label>
            </td>
            <td>
                <input type="text" name="apellidoM" required value="{{$usuario->apellido_m_user ?? ''}}" />
            </td>
        </tr>
        <tr>
            <td><p></p>
                <label for="tipo">Rol</label>
            </td>
            <td>
                <select name="tipo" required>
                    @foreach($tipos as $tipo)
                    <option value="{{$tipo->id}}" 
                            @if(isset($usuario))
                                @if($usuario->clave_tipo == $tipo->id)
                                selected
                                @endif
                            @endif
                            >{{$tipo->nombre_tipo}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="codigo">Codigo</label>
            </td>
            <td>
                <input type="text" name="codigo_user" required minlength="8" maxlength="10" pattern="[0-9]+" value="{{$usuario->id ?? ''}}"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="password">Contraseña </label>
            </td>
            <td>
                <input type="password" name="password" required value="{{$usuario->password_user ?? ''}}"/>
            </td>
        </tr>
        <p class="alerta_error">{{session('mensaje')->vacios ?? ''}}</p>
        <p class="alerta_error">{{session('mensaje')->idRepetido ?? ''}}</p>
        <p class="alerta_error">{{session('mensaje')->invalidos ?? ''}}</p>
    </table>
    @if(!isset($usuario))
        <input type="submit" value="Resgistrarse"/>
        <p class="cambioLog">
        Ya tienes una cuenta?
        <a href="{{action('usuarioController@loggin')}}" class="button">Inicia sesion</a>
    </p>
    @else
        <input type="submit" value="Guardar cambios"/>
    @endif
</form>
@stop