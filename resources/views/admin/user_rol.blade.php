@extends('adminlte::page')

@section('content_header')
@stop

@section('content')
    <table>
        <thead>
            <tr>
                <td>Usuario</td>
            </tr>
        </thead>
    </table>
    @foreach ($users as $user)
        
    @endforeach
@stop