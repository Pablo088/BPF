@extends('adminlte::page')
@section('content')

<div>
    @if ($userStops !== false)
        <h3>Estas son tus paradas</h3>
        @foreach ($userStops as $stops)
        <div class="container" id="container" style="position: relative">
            <button value="{{$stops->stopId}}" id="paradaId" class="paradaId" style="padding: 30px; margin:5px">    
                <div>Parada: {{$stops->direction}}</div>
                <div>Latitud: {{$stops->latitude}}</div>    
                <div>Longitud: {{$stops->longitude}}</div>
            </button>  
            <form action="{{route('bus-stop.delete',$stops->stopId)}}" method="post" id="frmBorrar" style="position: absolute;top:4%;left:1.2%">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" id="btnBorrar" style="font-size:13px"><i class="fas fa-trash-alt"></i></button>
            </form>                         
        </div>  
        @endforeach
    @else
        <h3>No tenes paradas guardadas</h3>
    @endif
    <form action="{{route('bus-stops.index')}}" method="get" id="form">
        <input type="hidden" name="parada" value="" id="inputParada">
    </form>

    <div id="mensaje-exito" class="container">
        @if (session('success'))
            <input type="hidden" name="exito" id="exito" value="{{session('success')}}">
        @endif
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/dashboard.js')
@stop