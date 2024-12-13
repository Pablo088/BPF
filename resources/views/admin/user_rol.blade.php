@extends('adminlte::page')

@section('content_header')
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
    
@stop