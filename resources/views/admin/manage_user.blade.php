@extends('adminlte::page')

@section('content_header')
@stop

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
    
@stop