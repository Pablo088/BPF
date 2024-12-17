@extends('adminlte::page')
@section('content_header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@stop
@section('content')

    <div class="container">
        <form action="{{ route('Lenviar') }}" method="POST">
            @csrf
            <h2>Editar Linea</h2>
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $Line->id }}">
                    <input class="form-control form-control-lg" type="text" value="{{ $Line->line_name }}" placeholder="Nombre linea" aria-label=".form-control-lg example" name="line_name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="specificSizeInputHorarioI">Hora inicio</label>
                    <input type="time" class="form-control" id="specificSizeInputHorarioI" name="horario_comienzo" value="00:00:00">
                </div>
                <div class="form-group">
                    <label class="form-label" for="specificSizeInputHorarioF">Hora fin</label>
                    <input type="time" class="form-control" id="specificSizeInputHorarioF" name="horario_finalizacion" value="00:00:00">
                </div>
                <div class="form-group">
                    <label class="visually-hidden" for="specificSizeSelect">Compañía</label>
                    <select class="form-select" id="specificSizeSelect" name="company_id">
                        @foreach ($buscompany as $company)
                            <option value="{{ $company->id }}" {{ $company->id == $Line->company_id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
    
                </div>
                <div class="form-group">
                    <input type="color" name="color" value="{{ $Line->color }}" name="color" id="color" class="form-control">
                </div>
                <div class="form-group">
                    @if ($users !== null)
                        <form action="{{ route('user-line.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="line_id" value="{{ $Line->id }}">
                            <select name="usuarios" id="usuarios" class="form-select">
                              <option selected disabled>Seleccionar conductor de la linea</option>
                                @foreach ($users as $user)
                                   
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    @endif
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container">
            <h4>Paradas de autobús asociadas</h4>
            <ul>
                @foreach ($Line->busStops as $stop)
                    <li>
                        {{ $stop->direction }}
                        <form action="{{ route('EliminarStop') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="line_id" value="{{ $Line->id }}">
                            <input type="hidden" name="stop_id" value="{{ $stop->id }}">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop