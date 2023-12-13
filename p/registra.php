<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>
<?php
require_once 'clases.php';

$crud = new Empleados();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identidad_usu = $_POST['identidad_usu'];
    $tipo_docu_usu = $_POST['tipo_docu_usu'];
    $nombre_usu = $_POST['nombre_usu'];
    $apellido_usu = $_POST['apellido_usu'];
    $telefono_usu = $_POST['telefono_usu'];
    $direccion_usu = $_POST['direccion_usu'];
    $correo_usu = $_POST['correo_usu'];
    $usuario_sistema = $_POST['usuario_sistema'];
    $password_usu = $_POST['password_usu'];
    $tipo_usu = $_POST['tipo_usu'];
    $imagen = $_FILES['imagen'];

    $crud->registrarCliente($identidad_usu, $tipo_docu_usu, $nombre_usu, $apellido_usu, $telefono_usu, $direccion_usu, $correo_usu, $usuario_sistema, $password_usu, $tipo_usu, $imagen);
    header("Location: clientes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="AkaliGE.ico" type="image/x-icon">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Usuario</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        body::before {
            content: "";
            background-image: url('descarga.jpeg');
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.5; 
            z-index: -1;
        }

        .container {
            text-align: center;
            max-width: 800px;
            margin: auto;
            padding: 5px;
            background-color: rgba(51, 51, 51, 0.7);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            opacity: 1;
        }

        h2 {
            color: pink;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            background-color: transparent;
            border: 2px transparent;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        input[type="text"], input[type="password"] {
            background-color: rgba(255, 182, 193, 0.7);
            border: none;
            border-radius: 5px;
            width: 250px;
            padding: 5px;
            color: black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        input[type="file"] {
            margin-bottom: 0px;
            background-color: rgba(51, 51, 51, 0.7);
            color: white
        }

        th {
            background-color: transparent;
            color: pink;
        }

        label[for="imagen"] {
            color: pink;
        }

        button {
            background-color: pink;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        select {
            background-color: rgba(255, 182, 193, 0.7);
            border: none;
            padding: 5px;
            width: 250px;
            border-radius: 5px;
        }

        button:hover {
            background-color: pink;
        }
    </style>
</head>
<img src="descarga.jpeg" alt="Imagen de fondo" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;">
<body>
    <div class="container">
        <h2>Registrar Nuevo Usuario</h2>
        <form method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th><label for="identidad_usu">Numero de documento</label></th>
                    <td><input type="text" id="identidad_usu" name="identidad_usu" required pattern="\d{1,10}" title="Ingresa un número de documento válido (máximo 10 dígitos)"></td>
                </tr>

                <tr>
                    <th><label for="tipo_docu_usu">Tipo de documento</label></th>
                    <td>
                        <select id="tipo_docu_usu" name="tipo_docu_usu" required>
                            <option value="TI">T.I</option>
                            <option value="CC">C.C</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th><label for="nombre_usu">Nombres</label></th>
                    <td><input type="text" id="nombre_usu" name="nombre_usu" required></td>
                </tr>

                <tr>
                    <th><label for="apellido_usu">Apellidos</label></th>
                    <td><input type="text" id="apellido_usu" name="apellido_usu" required></td>
                </tr>

                <tr>
                    <th><label for="telefono_usu">Telefono</label></th>
                    <td><input type="text" id="telefono_usu" name="telefono_usu" required pattern="\d{10}" title="Ingresa un número de teléfono válido (10 dígitos)"></td>
                </tr>

                <tr>
                    <th><label for="direccion_usu">Direccion del usuario</label></th>
                    <td><input type="text" id="direccion_usu" name="direccion_usu" required></td>
                </tr>

                <tr>
                    <th><label for="correo_usu">Correo del usuario</label></th>
                    <td><input type="text" id="correo_usu" name="correo_usu" required></td>
                </tr>

                <tr>
                    <th><label for="usuario_sistema">Usuario en el sistema</label></th>
                    <td><input type="text" id="usuario_sistema" name="usuario_sistema" required></td>
                </tr>

                <tr>
                    <th><label for="password_usu">Contraseña del usuario</label></th>
                    <td>
                        <div style="position: relative;">
                            <input type="password" id="password_usu" name="password_usu" required pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" title="La contraseña debe tener al menos 8 caracteres y contener al menos un número y una letra" style="background-color: rgba(255, 182, 193, 0.7); border: none; border-radius: 5px; width: 250px; padding: 5px; color: black;">
                            <span id="togglePassword" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); cursor: pointer; color: black;">👁️</span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th><label for="tipo_usu">Tipo de usuario</label></th>
                    <td>
                        <select id="tipo_usu" name="tipo_usu" required>
                            <option value="Asociado">Asociado</option>
                            <option value="Socio">Socio</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th><label for="imagen">Imagen:</label></th>
                    <td><input type="file" id="imagen" name="imagen" required></td>
                </tr>

            </table>

            <button class="registrar" type="submit">Registrar</button>
            <a href="clientes.php">
            <button class="cancelar" type="button">Cancelar</button>
            </a>

        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password_usu');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '👁️‍🗨️';
        });
    </script>
</body>
</html>
