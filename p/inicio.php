<?php
include 'conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conexion = new Conexion();
    $pdo = $conexion->getPdo(); 

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario_sistema = ?");
    $stmt->execute([$usuario]);
    $usuario_data = $stmt->fetch();

    if ($usuario_data && password_verify($password, $usuario_data['password_usu'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: menu.php");
        exit();
    } else {
        $mensaje = "El usuario u contraseña son incorrectos";
    }
}
?>
       
<!DOCTYPE html>
<html lang="es">
<link rel="icon" href="TFT.ico" type="image/x-icon">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            animation: movimientoFondo 10s infinite alternate;
            overflow: hidden;
            color: white;
        }

        video {
            min-width: 100%;
            min-height: 100%;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .container {
            background-color: rgba(153, 50, 204, 0.7);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .container input {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            padding: 8px;
            border-radius: 5px;
        }

        .container input:focus {
            outline: none;
        }

        h2 {
            font-weight: bold;
        }

    </style>
</head>
<body>
    <video autoplay muted loop>
        <source src="fondo2.mp4" type="video/mp4">
    </video>

    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form action="inicio.php" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <span id="showPassword" style="cursor: pointer;">👁️</span>
            <span id="hidePassword" style="cursor: pointer; display:none;">👁️‍🗨️</span><br><br>

            <input type="submit" value="Ingresar">
        </form>
        <?php if(isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
    </div>

    <script>
        document.getElementById("showPassword").addEventListener("click", function() {
            var passwordField = document.getElementById("password");
            var showIcon = document.getElementById("showPassword");
            var hideIcon = document.getElementById("hidePassword");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                showIcon.innerHTML = "👁️‍🗨️"; 
            } else {
                passwordField.type = "password";
                showIcon.innerHTML = "👁️"; 
            }
        });

        document.getElementById("hidePassword").addEventListener("click", function() {
            var passwordField = document.getElementById("password");
            var showIcon = document.getElementById("showPassword");
            var hideIcon = document.getElementById("hidePassword");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                showIcon.innerHTML = "👁️‍🗨️"; 
            } else {
                passwordField.type = "password";
                showIcon.innerHTML = "👁️"; 
            }
        });
    </script>
</body>
</html>
