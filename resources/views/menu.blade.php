<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto Laravel</title>
    <!-- Incluir el archivo CSS -->
    <link rel="stylesheet" href="{{ asset('menu\menu.css') }}">
</head>
<body>
    <!-- Menú lateral -->
    <div class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="#">Inicio</a>
        <a href="#">Servicios</a>
        <a href="#">Contacto</a>
    </div>

    <!-- Botón para abrir el menú -->
    <span class="open-menu" onclick="openMenu()">&#9776; Abrir Menú</span>

    <!-- Overlay -->
    <div class="overlay" id="menuOverlay" onclick="closeMenu()"></div>

    <!-- Contenido principal -->
    <div class="content">
        <h1>Bienvenido a Mi Proyecto</h1>
        <p>Contenido de la página aquí...</p>
    </div>

    <!-- Incluir el archivo JS -->
    <script src="{{ asset('menu/menu.js') }}"></script>
</body>
</html>
