@extends('adminlte::page')

@section('content_header')
@stop
<?php $lines = Session::get('lines') ?>
@section('content')
    <h3>Cambiar rol del usuario</h3>
    <form action="{{route('users.manage.post',$id)}}" method="post">
        @csrf
        @method('PUT')
        <select name="cambiarRol" id="cambiarRol">
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            <option value="Colectivero">Colectivero</option>
        </select>
        <button type="submit">Cambiar</button>
    </form>

        @foreach ($userLine as $relacion)
            <div>El usuario {{$relacion->name}} esta asociado a la linea {{$relacion->line_name}}</div>
        @endforeach
    @if ($lines !== null)
    <h3>Seleccionar linea para el colectivero</h3>
    <form action="{{route('user-line.add')}}" method="post">
    @csrf
        <input type="hidden" name="user_id" value="{{$id}}">
        <select name="lineas" id="lineas">
           
            @foreach ($lines as $line)
                <option value="{{$line->id}}">{{$line->line_name}}</option>
            @endforeach
        </select> 
        <button type="submit">Relacionar Linea</button>
    </form>
    @endif
@stop