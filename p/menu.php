<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .menu {
            background-color: #333;
            display: flex;
            justify-content: space-around;
            padding: 10px;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #555;
        }

        .container {
            margin: 50px auto;
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #333;
        }

         .top-bar {
            background-color: #4CAF50;
            padding: 10px;
            color: white;
            text-align: right;
            margin: 0; 
        }

        .top-bar i {
            margin: 0 15px; 
            cursor: pointer;
            font-size: 24px; 
            transition: color 0.3s;
        }

        .top-bar i:hover {
            color: #45a049; 
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px; 
            color: white;
        }

        h1 {
            color: #333;
        }

    </style>
</head>
<body>
    <div class="top-bar">
        <i class="fas fa-user-cog" onclick="window.location.href='clientes.php'"></i>
        <i class="fas fa-users" onclick="window.location.href='empleados.php'"></i>
        <i class="fas fa-building" onclick="window.location.href='empresa.php'"></i>
        <i class="fas fa-sign-out-alt logout-icon" onclick="confirmarCerrarSesion()"></i>
    </div>

    <div class="container">
        <h1>Bienvenido al Menú Principal</h1>
        <p>¡Hola, <?php echo $_SESSION['usuario']; ?>!</p>
    </div>
</body>
</html>

