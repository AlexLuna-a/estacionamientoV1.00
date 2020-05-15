@extends('layout.master')

@section('contenido')
<div class="mostrarEstacionamientos">
    <table class="estacionamientosDisponibles">
        <thead>
            <tr>
                <td>
                    Usuario
                </td>
                <td>
                    Estacionamiento
                </td>
                <td>
                    Fecha
                </td>
                <td>
                    Accion
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach($mov as $m)
            <tr>
                <td>
                    {{$m->codigo_user}}
                </td>
                <td>
                    @foreach($est as $e)
                    @if($e->id == $m->codigo_est)
                    {{$e->nombre_est}}
                    @endif
                    @endforeach
                </td>
                <td>
                    {{$m->fecha_mov}}
                </td>
                <td>
                    @if($m->accion_mov == 'i')entrada
                    @elseif($m->accion_mov == 'o')Salida
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(session('nivel') >= 9)
    <a href="{{action('estacionamientoController@create')}}">añadir</a>
    @endif




</div>
@stop



