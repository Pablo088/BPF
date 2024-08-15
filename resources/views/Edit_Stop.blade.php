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
    <h2>Editar {{ $id }}</h2>

    <input type="hidden" name="id" value="{{$id}}">
    <input type="text" name="nombre" placeholder="Ingrese el nombre de la parada">
    <input type="text" name="latitud" placeholder="Ingrese la latitud">
    <input type="text" name="longitud" placeholder="Ingrese la longitud">
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</body>
</html>
