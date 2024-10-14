@extends('adminlte::page')

@section('content_header')
@stop
@section('content')

<div>
    <style>
        .container{
            border: solid blue 1px;
        }
    </style>
    @if ($userStops !== false)
        <h3>Estas son tus paradas</h3>
        @foreach ($userStops as $stops)
        <div class="container">
        <button value="{{$stops->stopId}}" id="paradaId" class="paradaId">    
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
            let paradaId = document.querySelectorAll(".paradaId");
            let inputParada = document.getElementById("inputParada");
            let form = document.getElementById("form");
            
            
            paradaId.forEach(button => {
                button.addEventListener("click", (parada) => {
                    inputParada.value = parada.currentTarget.value;
                    form.submit();
                });
            });
            
            
    </script>
</div>
@stop