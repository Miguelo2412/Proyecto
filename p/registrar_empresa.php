<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>
<?php
require_once 'clases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'NIT' => $_POST['NIT'],
        'nombre_empresa' => $_POST['nombre_empresa'],
        'telefono' => $_POST['telefono'],
        'correo' => $_POST['correo'],
        'municipio' => $_POST['municipio'],
        'barrio' => $_POST['barrio'],
        'nomenclatura' => $_POST['nomenclatura'],
        'twitter' => $_POST['twitter'],
        'facebook' => $_POST['facebook'],
        'instagram' => $_POST['instagram'],
        'youtube' => $_POST['youtube']
    ];

    $empresasObj = new Empleados();
    $empresasObj->registrarEmpresa($datos);

    header("Location: empresa.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empresa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-button {
            background-color: #FFA500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Empresa</h1>
        <form method="post">
            <label for="NIT">NIT:</label>
            <input type="text" name="NIT" required>

            <label for="nombre_empresa">Nombre Empresa:</label>
            <input type="text" name="nombre_empresa" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" required>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" required>

            <label for="municipio">Municipio:</label>
            <input type="text" name="municipio" required>

            <label for="barrio">Barrio:</label>
            <input type="text" name="barrio" required>

            <label for="nomenclatura">Nomenclatura:</label>
            <input type="text" name="nomenclatura" required>

            <label for="twitter">Twitter:</label>
            <input type="text" name="twitter">

            <label for="facebook">Facebook:</label>
            <input type="text" name="facebook">

            <label for="instagram">Instagram:</label>
            <input type="text" name="instagram">

            <label for="youtube">YouTube:</label>
            <input type="text" name="youtube">

            <button class="back-button" onclick="window.location.href='empresa.php'">Volver</button>
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
