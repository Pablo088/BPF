<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Lineas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js\menu.js') }}"></script>
    <style>
        #pos2{
            left: 90%;
            top: 50%;
        }
        #boton{
          position: absolute;
          top: 55%;
          right: 0%;
        }
    </style>
</head>
<body>

  {{-- <div id="menu" class="menu">
    <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
    <a href="{{route('bus-stop.admin')}}">Agregar Parada</a>
    <a href="{{route('LinesAdmin')}}">Administrar Lineas</a>
    <a href="{{route('bus-stops.routes')}}">Administrar Rutas</a>
    <a href="{{route('LinesView')}}">Lineas</a>
    <a href="{{route('dashboard')}}">Dashboard</a>
  </div> --}}

{{-- <a href="{{route ('bus-stops.index')}}">Inicio</a> --}}
<a href="{{route ('bus-stops.index')}}"><button style="btn btn-primary">Inicio</button></a>

<form action="{{ route('companyupdate') }}" method="POST">
    @csrf
    <h2>Agregar compania</h2>
<div class="row g-3">
  <div class="col-sm-4">
  <input class="form-control form-control-lg" type="text" placeholder="Nombre compania" aria-label=".form-control-lg example" name="company_name">
</div>
<div class="col-auto">
    <button type="submit" class="btn btn-primary">Enviar</button>
  </div>
</form>
@if ($errors->has('company_name'))
    <div class="alert alert-danger">
        {{ $errors->first('company_name') }}
    </div>
@endif

<form action="{{ route('lineaupdate') }}" method="POST" class="row gx-3 gy-2 align-items-center">
    @csrf
    <h2>Agregar Linea</h2>
    <div class="col-sm-3">
      <label class="visually-hidden" for="specificSizeInputName">Nombre</label>
      <input type="text" class="form-control" id="specificSizeInputName" placeholder="Nombre linea" name="line_name">
     </div>

      <div class="col-sm-1">
        <label class="form-label" for="specificSizeInputHorarioI">Hora inicio</label>
        <input type="time" class="form-control" id="specificSizeInputHorarioI" name=horario_comienzo value="00:00:00" >
      </div>
      <div class="col-sm-1">
        <label class="form-label" for="specificSizeInputHorarioF">Hora fin</label>
        <input type="time" class="form-control" id="specificSizeInputHorarioF" name=horario_finalizacion value="00:00:00" >
      </div>
      <div class="col-sm-3">
        <label class="visually-hidden" for="specificSizeSelect">Compañía</label>
          <select class="form-select" id="specificSizeSelect" name="company_id">
            <option selected>Seleccionar</option>
            @foreach($buscompany as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
          </select>
      </div>
      <div class="col-auto">
        <input type="color" value="#000000" name="color" id="color">
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

<form action="{{ route('relacion') }}" method="POST" class="row gx-3 gy-2 align-items-center">
    @csrf
    <h2>Relacion con las lineas</h2>
    <div class="col-sm-3">

  <label class="visually-hidden" for="specificSizeSelect">Compañía</label>
    <select class="form-select" id="specificSizeSelect" name="busLine_id">
      <option selected>Linea</option>
      @foreach($busline as $lines)
      <option value="{{ $lines->id }}">{{ $lines->line_name}}</option>
      @endforeach
    </select>
  </div>

  <div class="col-sm-3">
  <label class="visually-hidden" for="specificSizeSelect">Compañía</label>
    <select class="form-select" id="specificSizeSelect" name="busStop_id">
      <option selected>Parada</option>
      @foreach($busstop as $stop)
      <option value="{{ $stop->id }}">ID:{{$stop->id}}   /Direccion:{{$stop->direction}}</option>
      @endforeach
    </select>
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
<br>
<a href="{{ route('companyedit') }}" class="btn btn-success" id="boton">Opciones</a>
</body>
</html>
