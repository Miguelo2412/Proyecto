<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>
<?php
require_once 'clases.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['identificacion'])) {
    $identificacion = $_GET['identificacion'];

    $empleadosObj = new Empleados();
    $empleado = $empleadosObj->seleccionarEmpleadoPorIdentificacion($identificacion);

    if (!$empleado) {
        echo "Empleado no encontrado.";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $datos = [
        'identificacion' => $_POST['identificacion'],
        'tipo_documento' => $_POST['tipo_documento'],
        'nombre' => $_POST['nombre'],
        'nombre2' => $_POST['nombre2'],
        'apellido' => $_POST['apellido'],
        'apellido2' => $_POST['apellido2'],
        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
        'genero' => $_POST['genero'],
        'estado_civil' => $_POST['estado_civil'],
        'telefono' => $_POST['telefono'],
        'correo' => $_POST['correo'],
    ];

    $empleadosObj = new Empleados();
    $empleadosObj->actualizarEmpleado($datos);

    header("Location: empleados.php");
    exit();
} else {
    echo "Identificación de empleado no proporcionada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
</head>
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
    </style>
<body>
    <h1>Editar Empleado</h1>
    <form method="post">
        <input type="hidden" name="identificacion" value="<?= $empleado['identificacion'] ?>">

        <label for="tipo_documento">Tipo Documento:</label>
        <select name="tipo_documento" required>
            <option value="C.C" <?= ($empleado['tipo_documento'] === 'C.C') ? 'selected' : '' ?>>C.C</option>
            <option value="T.I" <?= ($empleado['tipo_documento'] === 'T.I') ? 'selected' : '' ?>>T.I</option>
            <option value="C.E" <?= ($empleado['tipo_documento'] === 'C.E') ? 'selected' : '' ?>>C.E</option>
        </select>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $empleado['nombre'] ?>" required>

        <label for="nombre2">Segundo Nombre:</label>
        <input type="text" name="nombre2" value="<?= $empleado['nombre2'] ?>">

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="<?= $empleado['apellido'] ?>" required>

        <label for="apellido2">Segundo Apellido:</label>
        <input type="text" name="apellido2" value="<?= $empleado['apellido2'] ?>">

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= $empleado['fecha_nacimiento'] ?>" required>

        <label for="genero">Género:</label>
        <select name="genero" required>
            <option value="Hombre" <?= ($empleado['genero'] === 'Hombre') ? 'selected' : '' ?>>Hombre</option>
            <option value="Mujer" <?= ($empleado['genero'] === 'Mujer') ? 'selected' : '' ?>>Mujer</option>
            <option value="Indefinido" <?= ($empleado['genero'] === 'Indefinido') ? 'selected' : '' ?>>Indefinido</option>
        </select>

        <label for="estado_civil">Estado Civil:</label>
        <select name="estado_civil" required>
            <option value="soltero(a)" <?= ($empleado['estado_civil'] === 'soltero(a)') ? 'selected' : '' ?>>Soltero(a)</option>
            <option value="casado(a)" <?= ($empleado['estado_civil'] === 'casado(a)') ? 'selected' : '' ?>>Casado(a)</option>
            <option value="viudo(a)" <?= ($empleado['estado_civil'] === 'viudo(a)') ? 'selected' : '' ?>>Viudo(a)</option>
            <option value="divorciado(a)" <?= ($empleado['estado_civil'] === 'divorciado(a)') ? 'selected' : '' ?>>Divorciado(a)</option>
        </select>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="<?= $empleado['telefono'] ?>" required>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" value="<?= $empleado['correo'] ?>" required>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
