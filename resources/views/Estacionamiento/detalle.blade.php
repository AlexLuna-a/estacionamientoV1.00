@extends('layout.master')

@section('contenido')
<table class="tablaDetalle">
    <thead>
        <tr>
            <td colspan="2"><h1>{{$est->nombre_est}}</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                Ubicacion: 
            </td>
            <td>
                {{$est->ubicacion_est}}
            </td>
        </tr>
        <tr>
            <td>
                Capacidad: 
            </td>
            <td>
                {{$est->capacidad_max_est}}
            </td>
        </tr>
        <tr>
            <td>
                Ocupacion: 
            </td>
            <td>
                {{$est->ocupacion_actual_est}}
            </td>
        </tr>
        <tr>
            <td>
                Espacios Disponibles: 
            </td>
            <td>
                {{$est->capacidad_max_est-$est->ocupacion_actual_est}}
            </td>
        </tr>
        @if(session('nivel') >= 9)
        <tr>
            <td>
                Nivel: 
            </td>
            <td>
                {{$est->nivel_est}}
            </td>
        </tr>
        @endif
        @if(session('nivel') == 10)
        <tr>
            <td>
                Accesibilidad: 
            </td>
            <td>
                @foreach($acces as $a)
                {{ $a->nombre_tipo}}, 
                @endforeach
            </td>
        </tr>
        @endif
    </tbody>
</table>



@if(session('nivel') == 10)
<a href="{{action('estacionamientoController@edit',['id' => $est->id])}}" class="editBtn">editar</a>
@endif
<a href="{{action('estacionamientoController@index')}}" class="botonRegresar">Regresar</a>

@stop