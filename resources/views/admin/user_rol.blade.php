@extends('adminlte::page')
@section('content_header')
    @vite('resources/css/admin/user_rol.css')    
@stop
@section('content')

    <table>
        <thead>
            <tr>
                <td>Usuario</td>
                <td>Email</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th>{{$user->name}}</th>
                    <th>{{$user->email}}</th>
                    <th><a href="{{route('users.manage',$user->id)}}"><button>Cambiar Rol</button></a></th>
                </tr>
            @endforeach
        </tbody>
    </table>
   
    <div id="infoModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Información Detallada</h2>
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
            <div>El colectivero {{$relacion->name}} esta asociado a la linea {{$relacion->line_name}}</div>
        
        @endforeach
    
        <p id="modalInfo">Detalles aquí...</p>
    </div>
    
@vite('resources/js/admin/user_rol.js')
@stop