@extends('adminlte::page')
@section('content_header')
    @vite('resources/css/admin/user_rol.css')    
@stop
@section('content')

    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="{{route('users.manage',$user->id)}}"><button>Cambiar Rol</button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@vite('resources/js/admin/user_rol.js')
@stop