@extends('adminlte::page')

@section('content_header')
@stop

@section('content')
<div>
    @if ($userStops !== false)
        <h3>Estas son tus paradas</h3>
        @foreach ($userStops as $stops)
        <div>
            <p></p>
            <button>
                <div>Parada: {{$stops->direction}}</div>
                <div>Latitud: {{$stops->latitude}}</div>    
                <div>Longitud: {{$stops->longitude}}</div>
            </button>  
        </div>  
        @endforeach
    @else
        <h3>No tenes paradas guardadas</h3>
    @endif
    
</div>
@stop