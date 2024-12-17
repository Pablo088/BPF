@extends('adminlte::page')
@section('content_header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/lines.css')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stop
    @section('content')
    

<div id="contenedor1" class="container">
    <table class="table">
        <thead>
            <tr class="table-primary">
                <th>Compañía</th> 
                <th>Linea</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th style="display: none;">ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lines as $line)
            <tr class="table-secondary" data-line-id="{{ $line->id }}">
                <td id="texto">{{$line->BusCompany->company_name}}</td> 
                <td id="texto">{{$line->line_name}}</td>
                <td id="texto">{{$line->horario_comienzo}}</td>
                <td id="texto">{{$line->horario_finalizacion}}</td>
                <td style="display: none;">{{ $line->id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="infoModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Información Detallada</h2>
        <p id="modalInfo">Detalles aquí...</p>
    </div>
</div>
</div>

<input type="hidden" id="lineId" value="{{ $id_line }}">

@vite('resources/js/lines.js')
@stop