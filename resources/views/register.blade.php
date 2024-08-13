<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse</title>
</head>
<body>
    <h2>Registrarse</h2>
        <form action="{{ route('dashboard') }}" method="POST">
            @csrf
            <input type="text" name="name" id="name" placeholder="Nombre">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Contraseña">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña">
            <button id="button" type="submit">Enviar</button>
        </form>
</body>
</html>