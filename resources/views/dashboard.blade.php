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
            <button onclick="mostrarParada()" value="{{$stops->stopId}}" id="paradaId">
                <div>Parada: {{$stops->direction}}</div>
                <div>Latitud: {{$stops->latitude}}</div>    
                <div>Longitud: {{$stops->longitude}}</div>
            </button>  
        </div>  
        @endforeach
    @else
        <h3>No tenes paradas guardadas</h3>
    @endif
    <form action="{{route('bus-stops.index')}}" method="get" id="form">
        <input type="hidden" name="parada" value="" id="inputParada">
    </form>
    <script>
        function mostrarParada(){
            const parada = document.getElementById("paradaId").value;
            const inputParada = document.getElementById("inputParada");
            const form = document.getElementById("form");
            inputParada.value = parada;

            form.submit();
        }
    </script>
</div>
@stop