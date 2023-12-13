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
        'identificacion' => $_POST['identificacion'],
        'NIT' => $_POST['NIT'],
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
    $empleadosObj->registrarEmpleado($datos);

    header("Location: empleados.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empleado</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Empleado</h1>
        <form method="post">
            <label for="identificacion">Identificación:</label>
            <input type="text" name="identificacion" required>

            <label for="NIT">NIT:</label>
            <select name="NIT" required>
                <?php
                    $empresasObj = new Empleados();
                    $empresas = $empresasObj->seleccionarEmpresas();

                    foreach ($empresas as $empresa) {
                        echo "<option value='{$empresa['NIT']}'>{$empresa['NIT']} - {$empresa['nombre_empresa']}</option>";
                    }
                ?>
            </select>

            <label for="tipo_documento">Tipo Documento:</label>
            <select name="tipo_documento" required>
                <option value="C.C">C.C</option>
                <option value="T.I">T.I</option>
                <option value="C.E">C.E</option>
            </select>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" name="nombre2">

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" required>

            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" name="apellido2">

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" required>

            <label for="genero">Género:</label>
            <select name="genero" required>
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
                <option value="Indefinido">Indefinido</option>
            </select>

            <label for="estado_civil">Estado Civil:</label>
            <select name="estado_civil" required>
                <option value="soltero(a)">Soltero(a)</option>
                <option value="casado(a)">Casado(a)</option>
                <option value="viudo(a)">Viudo(a)</option>
                <option value="divorciado(a)">Divorciado(a)</option>
            </select>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" required>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" required>

            <button style="background-color: #FFA500; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;" onclick="window.location.href='empleados.php'">Volver</button>
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
