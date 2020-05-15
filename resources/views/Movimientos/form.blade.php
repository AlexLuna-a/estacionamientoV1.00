@extends('Usuario.masterUsuario')

@section('contenido')


@if(!isset($e))
<form action="{{action('estacionamientoController@save')}}" method="POST" class="formitas">
@else
<form action="{{action('estacionamientoController@store')}}" method="POST" class="formitas">
@endif
<h1>
    {{$accion ?? ''}}
</h1>
{{csrf_field()}}
<p class='alerta_error'>{{session('mensajeError') ?? ''}}</p>
<p class='alerta_exito'>{{session('mensajeCompleto') ?? ''}}</p>
<table class="formTabulado">
    <tr>
        <td>
            <label for="nombre">Nombre</label>
        </td>
        <td>
            <input type="text" name="nombre" required value="{{$e->nombre_est ?? ''}}"/>
        </td>
    </tr>
    <td>
        <label for="nivel">Accesible desde</label>
    </td>
    <td>
        <select name="nivel" required>
            @foreach($tipos as $tipo)
            <option value="{{$tipo->nivel_tipo}}" 
                    @if(isset($e))
                    @if($e->nivel_est == $tipo->nivel_tipo)
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
        <label for="ubicacion">Ubicacion</label>
    </td>
    <td>
        <input type="text" name="ubicacion" value="{{$e->ubicacion_est ?? ''}}"/>
    </td>
</tr>
<tr>
    <td>
        <label for="maxima">capacidad maxima</label>
    </td>
    <td>
        <input type="number" name="maxima"  value="{{$e->capacidad_max_est ?? ''}}"/>
            </td    >
        </tr>
<tr>@if(!isset($e))
        <td>
            <label for="actual">Ocupacion actual </label>
        </td>
        <td>
            <input type="number" name="actual"  value="{{$e->ocupacion_actual_est ?? '0'}}"/>
        </td>
        @else
        <td>
            <input type="number" name="actual" hidden value="{{$e->ocupacion_actual_est ?? ''}}"/>
        </td>
        @endif
    <input type="text" name="id" hidden value="{{$e->id ?? ''}}"/>
</tr>
</table>
@if(!isset($e))
<input type="submit" value="Añadir"/>
@else
<input type="submit" value="Guardar cambios"/>
@endif
</form>
@stop