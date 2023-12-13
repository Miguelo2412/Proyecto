<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>
<?php
require_once 'clases.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['NIT'])) {
    $NIT = $_GET['NIT'];

    $empresasObj = new Empresa();
    $empresa = $empresasObj->seleccionarEmpresaPorNIT($NIT);

    if (!$empresa) {
        echo "Empresa no encontrada.";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    $empresasObj = new Empresa();
    $empresasObj->actualizarEmpresa($datos);

    header("Location: empresa.php");
    exit();
} else {
    echo "NIT de empresa no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empresa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 20px;
}

h1 {
    color: #333;
    text-align: center;
}

form {
    max-width: 400px;
    margin: 20px auto;
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
    <h1>Editar Empresa</h1>
    <form method="post">
        <input type="hidden" name="NIT" value="<?= $empresa['NIT'] ?>">

        <label for="nombre_empresa">Nombre Empresa:</label>
        <input type="text" name="nombre_empresa" value="<?= $empresa['nombre_empresa'] ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="<?= $empresa['telefono'] ?>" required>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" value="<?= $empresa['correo'] ?>" required>

        <label for="municipio">Municipio:</label>
        <input type="text" name="municipio" value="<?= $empresa['municipio'] ?>" required>

        <label for="barrio">Barrio:</label>
        <input type="text" name="barrio" value="<?= $empresa['barrio'] ?>" required>

        <label for="nomenclatura">Nomenclatura:</label>
        <input type="text" name="nomenclatura" value="<?= $empresa['nomenclatura'] ?>" required>

        <label for="twitter">Twitter:</label>
        <input type="text" name="twitter" value="<?= $empresa['twitter'] ?>">

        <label for="facebook">Facebook:</label>
        <input type="text" name="facebook" value="<?= $empresa['facebook'] ?>">

        <label for="instagram">Instagram:</label>
        <input type="text" name="instagram" value="<?= $empresa['instagram'] ?>">

        <label for="youtube">YouTube:</label>
        <input type="text" name="youtube" value="<?= $empresa['youtube'] ?>">

        <button type="submit">Actualizar</button>
        <button class="back-button" onclick="window.location.href='empresa.php'">Volver</button>
    </form>
</body>
</html>
