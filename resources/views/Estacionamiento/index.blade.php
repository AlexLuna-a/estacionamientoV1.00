@extends('layout.master')

@section('contenido')
<div class="mostrarEstacionamientos">
    <table class="estacionamientosDisponibles">
        <thead>
            <tr>
                <td>
                    Estacionamiento
                </td>
                <td>
                    Espacios disponibles
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach($estacionamientos as $est)
            <tr>
                <td>
                    <a href="{{action('estacionamientoController@show',['id'=> $est->id ])}}">{{$est->nombre_est}}</a>
                </td>
                <td>
                    {{$est->capacidad_max_est - $est->ocupacion_actual_est}}
                </td>
           </tr>
           @endforeach
            </tbody>
    </table>
    @if(session('nivel') == 10)
<a href="{{action('estacionamientoController@create')}}">añadir</a>
@endif




</div>
@stop



