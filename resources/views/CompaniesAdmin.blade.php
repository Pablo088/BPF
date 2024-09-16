<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar compania</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <style>
        #pos2{
            left: 90%;
            top: 50%;
        }
    </style>
</head>
<body>
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

<form action="{{ route('lineaupdate') }}" method="POST" class="row gx-3 gy-2 align-items-center">
    @csrf
    <h2>Agregar Linea</h2>
    <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputName">Nombre</label>
    <input type="text" class="form-control" id="specificSizeInputName" placeholder="Nombre linea" name="line_name">
  </div>
  <div class="col-sm-1">
    <label class="visually-hidden" for="specificSizeInputName">Hora</label>
    <input type="time" class="form-control" name=horarios >
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
    <button type="submit" class="btn btn-primary">Enviar</button>
  </div>
</form>

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
      <option value="{{ $stop->id }}">{{ $stop->id}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Enviar</button>
  </div>
</form>
</body>
</html>