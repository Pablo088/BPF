<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Desplegable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .menu {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #333;
            padding-top: 60px;
            transition: 0.3s;
            z-index: 1;
        }

        .menu a {
            padding: 8px 16px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .menu a:hover {
            background-color: #575757;
        }

        .menu .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .open-menu {
            font-size: 30px;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 2;
        }

        .content {
            transition: margin-left 0.3s;
            padding: 16px;
            margin-left: 0;
        }

    </style>
</head>
<body>
    <div class="open-menu" onclick="openMenu()">&#9776;</div>

    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="#">Home</a>
        <a href="#">About Us</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </div>

    <div id="content" class="content">
        <h2>Página Principal</h2>
        <p>Este es el contenido principal de la página.</p>
    </div>

    <script>
        function openMenu() {
            document.getElementById("menu").style.left = "0";
            document.getElementById("content").style.marginLeft = "250px";
        }

        function closeMenu() {
            document.getElementById("menu").style.left = "-250px";
            document.getElementById("content").style.marginLeft = "0";
        }
    </script>
</body>
</html>
