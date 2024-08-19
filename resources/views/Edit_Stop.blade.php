<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <form action="{{ route('bus-stops.edit') }}" method="POST">
    @csrf
    <h2>Editar {{ $stop->id }}</h2>

    <input type="hidden" name="id" value="{{$stop->id}}">
    <input type="text" name="nombre" value="{{$stop->direction}}" placeholder="Ingrese el nombre de la parada">
    <input type="text" name="latitud" value="{{$stop->latitude}}" placeholder="Ingrese la latitud">
    <input type="text" name="longitud" value="{{$stop->longitude}}" placeholder="Ingrese la longitud">
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</body>
</html>
