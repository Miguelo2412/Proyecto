<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<link rel="icon" href="AkaliGE.ico" type="image/x-icon">
<head>
    <title>Editar Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('descarga.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            text-align: center;
            max-width: 400px;
            margin: 50px auto 0;
            padding: 30px;
            background-color: rgba(51, 51, 51, 0.7);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        h1 {
            margin-top: 0;
            font-size: 24px;
            color: pink;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: pink;
        }

        input[type="text"], select {
            width: calc(100% - 22px);
            padding: 9px;
            margin-bottom: 15px;
            border: 1px solid rgba(51, 51, 51, 0.7);
            border-radius: 5px;
            font-size: 16px;
            background-color: white;
            color: black;
            display: inline-block;
        }

        input[type="file"] {
            margin-bottom: 20px;
            background-color: rgba(51, 51, 51, 0.7);
            color: white
        }

        input[type="text"], select {
            background-color: rgba(255, 182, 193, 0.7);
            border: none;
            padding: 5px;
            border-radius: 5px;
        }

        button {
            background-color: rgba(255, 182, 193, 0.7);
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        
        button:hover {
            background-color: rgba(255, 182, 193, 0.7);
        }
        
        .form-group {
            display: flex;
            justify-content: space-between;
        }

        .form-group label,
        .form-group input,
        .form-group select {
            width: 45%;
        }
    </style>
</head>
<body>
    <?php
    require_once 'clases.php';

    $crud = new Empleados();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id_usuario']) && isset($_POST['identidad_usu'])&& isset($_POST['tipo_docu_usu']) && isset($_POST['nombre_usu']) && isset($_POST['apellido_usu'])&& isset($_POST['telefono_usu']) && isset($_POST['direccion_usu']) && isset($_POST['correo_usu'])&& isset($_POST['usuario_sistema'])&& isset($_POST['password_usu'])&& isset($_POST['tipo_usu'])&& isset($_FILES['imagen'])) {
            $id_usuario = $_POST['id_usuario'];
            $tipo_docu_usu = $_POST['tipo_docu_usu'];
            $identidad_usu = $_POST['identidad_usu'];
            $nombre_usu = $_POST['nombre_usu'];
            $apellido_usu = $_POST['apellido_usu'];
            $telefono_usu = $_POST['telefono_usu'];
            $direccion_usu= $_POST['direccion_usu'];
            $correo_usu = $_POST['correo_usu'];
            $usuario_sistema = $_POST['usuario_sistema'];
            $password_usu = $_POST['password_usu'];
            $tipo_usu = $_POST['tipo_usu'];

            if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != '') {
                $imagen_name = $_FILES['imagen']['name'];
                $imagen_temp = $_FILES['imagen']['tmp_name'];
                $imagen_destino = "imagenes/" . $imagen_name;

                if (move_uploaded_file($imagen_temp, $imagen_destino)) {
                    $ruta_imagen = $imagen_name;
                } else {
                    echo "Error al subir la imagen.";
                }
            } else {
                $ruta_imagen = $_POST['imagen_actual'];
            }

            $crud->actualizarCliente($id_usuario, $identidad_usu, $tipo_docu_usu , $nombre_usu, $apellido_usu, $telefono_usu, $direccion_usu, $correo_usu, $usuario_sistema, $password_usu, $tipo_usu, $ruta_imagen);

            header("Location: clientes.php");
            exit();
        }
    }

    $idusuario = $_GET['id'];

    if (isset($idusuario)) {
        $usuario = $crud->seleccionarClientePorID($idusuario);
    }
    ?>

    <div class="container">
        <h1>Editar Cliente</h1>
        <form method="POST" enctype="multipart/form-data">
            <?php if(isset($usuario) && is_array($usuario) && count($usuario) > 0): ?>
                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

                <label for="identidad_usu">Identidad del usuario:</label>
                <input type="text" id="identidad_usu" name="identidad_usu" value="<?php echo $usuario['identidad_usu']; ?>" required>

                <label for="tipo_docu_usu">Tipo de documento:</label>
                <select id="tipo_docu_usu" name="tipo_docu_usu" required>
                    <option value="TI" <?php if($usuario['tipo_docu_usu'] == 'TI') echo 'selected'; ?>>T.I</option>
                    <option value="CC" <?php if($usuario['tipo_docu_usu'] == 'CC') echo 'selected'; ?>>C.C</option>
                </select>

                <label for="nombre_usu">nombre del usuario:</label>
                <input type="text" id="nombre_usu" name="nombre_usu" value="<?php echo $usuario['nombre_usu']; ?>" required>

                <label for="apellido_usu">apellido del usuario:</label>
                <input type="text" id="apellido_usu" name="apellido_usu" value="<?php echo $usuario['apellido_usu']; ?>" required>

                <label for="telefono_usu">telefono del usuario:</label>
                <input type="text" id="telefono_usu" name="telefono_usu" value="<?php echo $usuario['telefono_usu']; ?>" required>

                <label for="direccion_usu">direccion del usuario:</label>
                <input type="text" id="direccion_usu" name="direccion_usu" value="<?php echo $usuario['direccion_usu']; ?>" required>

                <label for="correo_usu">correo del usuario:</label>
                <input type="text" id="correo_usu" name="correo_usu" value="<?php echo $usuario['correo_usu']; ?>" required>
                
                <label for="usuario_sistema">usuario del sistema:</label>
                <input type="text" id="usuario_sistema" name="usuario_sistema" value="<?php echo $usuario['usuario_sistema']; ?>" required>

                <label for="password_usu">contraseña del usuario:</label>
                <input type="text" id="password_usu" name="password_usu" value="<?php echo $usuario['password_usu']; ?>" required>

                <label for="tipo_usu">Tipo de usuario:</label>
                <select id="tipo_usu" name="tipo_usu" required>
                    <option value="Asociado" <?php if($usuario['tipo_usu'] == 'Asociado') echo 'selected'; ?>>Asociado</option>
                    <option value="Socio" <?php if($usuario['tipo_usu'] == 'Socio') echo 'selected'; ?>>Socio</option>
                </select>

                <label for="imagen">Imagen del usuario:</label>
                <input type="file" id="imagen" name="imagen">

                <input type="hidden" name="imagen_actual" value="<?php echo $usuario['img']; ?>">

                <button type="submit">Guardar Cambios</button>
            <?php else: ?>
                <p>No se encontró ningún usuario con ese ID.</p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>