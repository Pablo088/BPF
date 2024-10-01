<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form action="{{ route('Lenviar') }}" method="POST">
    @csrf
<h2>Editar Linea</h2>
<div class="row g-3">
  <div class="col-sm-3">
    <input type="hidden" name="id" value="{{$Line->id}}"  >
  <input class="form-control form-control-lg" type="text"  placeholder="{{$Line->line_name}}" aria-label=".form-control-lg example" name="line_name">
</div>
<div class="col-sm-2">
    <input class="form-control form-control-lg" type="time"  aria-label=".form-control-lg example" name="horarios" placeholder="Inicio" >
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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<h4>Paradas de autobús asociadas</h4>
    <ul>
        @foreach($Line->busStops as $stop)
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



</body>
</html>
