@extends('adminlte::page')
@section('content_header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Lineas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/admin/add/ManageLines.css')
@stop
@section('content')

<div id="div-container" class="container">
  <div id="form-container" class="form-container">
    <h2>Agregar compania</h2>
    <form action="{{ route('companyupdate') }}" method="POST">
        @csrf
      <div class="">
        <input class="form-control" type="text" placeholder="Nombre compania" aria-label=".form-control-lg example" name="company_name">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    @if ($errors->has('company_name'))
      <div class="alert alert-danger">
        {{ $errors->first('company_name') }}
      </div>
    @endif
  </div>
  <div class="form-container">
      <form action="{{ route('lineaupdate') }}" method="POST" class="row gx-3 gy-2 align-items-center">
        @csrf
        <h2>Agregar Linea</h2>
        <div class="form-group">
          <label class="visually-hidden" for="specificSizeInputName">Nombre</label>
          <input type="text" class="form-control" id="specificSizeInputName" placeholder="Nombre linea" name="line_name">
        </div>
        <div class="form-group">
          <label class="form-label" for="specificSizeInputHorarioI">Hora inicio</label>
          <input type="time" class="form-control" id="specificSizeInputHorarioI" name=horario_comienzo value="00:00:00" >
        </div>
        <div class="form-group">
          <label class="form-label" for="specificSizeInputHorarioF">Hora fin</label>
          <input type="time" class="form-control" id="specificSizeInputHorarioF" name=horario_finalizacion value="00:00:00" >
        </div>
        <div class="form-group">
          <label class="visually-hidden" for="specificSizeSelect">Compañía</label>
          <select class="form-select" id="specificSizeSelect" name="company_id">
            <option selected disabled>Seleccionar Compañía</option>
            @foreach($buscompany as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <input type="color" name="color" id="color">
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
  </div>
  <div class="form-container">
    <form action="{{ route('relacion1a1') }}" method="POST" class="row gx-3 gy-2 align-items-center">
        @csrf
        <h2>Relacion con las lineas</h2>
        <div class="form-group">
          <label class="visually-hidden" for="specificSizeSelect">Compañía</label>
          <select class="form-select" id="specificSizeSelect" name="busLine_id">
            <option selected>Linea</option>
            @foreach($busline as $lines)
            <option value="{{ $lines->id }}">{{ $lines->line_name}}</option>
            @endforeach
          </select>
        </div>
  
        <div class="form-group">
          <label class="visually-hidden" for="specificSizeSelect">Compañía</label>
          <select class="form-select" id="specificSizeSelect" name="busStop_id">
            <option selected>Parada</option>
            @foreach($busstop as $stop)
            <option value="{{ $stop->id }}">ID:{{$stop->id}}   /Direccion:{{$stop->direction}}</option>
            @endforeach
          </select>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
  </div>
  <div id="contenedor2" class="container">
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
  </div>

  <div id="button-editar" class="button-editar">
    <a href="{{ route('companyedit') }}" class="btn btn-success" id="boton">Editar Lineas</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop