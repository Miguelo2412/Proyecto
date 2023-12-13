<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>
<?php
require_once 'clases.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    // Manejar la eliminación aquí
    $empleadosObj = new Empleados();
    $empleadosObj->eliminarEmpleado($_GET['id']);

    header("Location: empleados.php");
    exit();
}

$empleadosObj = new Empleados();
$empleados = $empleadosObj->seleccionarEmpleados();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
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

        .icon {
            font-size: 18px;
            cursor: pointer;
            margin-right: 5px;
            transition: color 0.3s; 
        }

        .icon:hover {
            color: DodgerBlue; 
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            text-align: center;
        }
        .modal-content-logout {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
        }

        .modal-content-logout p {
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

    <h1>Lista de Empleados</h1>

    <button onclick="window.location.href='registrar_empleado.php'">Registrar Nuevo Empleado</button>

    <table border="1">
        <tr>
            <th>Identificación</th>
            <th>NIT</th> 
            <th>Tipo Documento</th>
            <th>Nombre</th>
            <th>Segundo Nombre</th>
            <th>Apellido</th>
            <th>Segundo Apellido</th>
            <th>Fecha Nacimiento</th>
            <th>Género</th>
            <th>Estado Civil</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($empleados as $empleado): ?>
            <tr>
                <td><?= $empleado['identificacion'] ?></td>
                <td><?= $empleado['NIT'] ?></td> 
                <td><?= $empleado['tipo_documento'] ?></td>
                <td><?= $empleado['nombre'] ?></td>
                <td><?= $empleado['nombre2'] ?></td>
                <td><?= $empleado['apellido'] ?></td>
                <td><?= $empleado['apellido2'] ?></td>
                <td><?= $empleado['fecha_nacimiento'] ?></td>
                <td><?= $empleado['genero'] ?></td>
                <td><?= $empleado['estado_civil'] ?></td>
                <td><?= $empleado['telefono'] ?></td>
                <td><?= $empleado['correo'] ?></td>
                <td>
                    <i class="icon edit-icon fas fa-edit" onclick="window.location.href='editar_empleado.php?identificacion=<?= $empleado['identificacion'] ?>'"></i>
                    <i class="icon delete-icon fas fa-trash-alt" onclick="confirmarEliminar('<?= $empleado['identificacion'] ?>')"></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div id="modalConfirmacion" class="modal">
        <div class="modal-content">
            <p id="mensajeConfirmacion"></p>
            <button onclick="confirmarEliminarEmpleado()">Sí</button>
            <button onclick="cancelarEliminar()">No</button>
        </div>
    </div>

    <div id="modalCerrarSesion" class="modal">
        <div class="modal-content modal-content-logout">
            <p id="mensajeCerrarSesion">¿Estás seguro de cerrar sesión?</p>
            <button onclick="cerrarSesion()">Sí</button>
            <button onclick="cancelarCerrarSesion()">No</button>
        </div>
    </div>

    <script>

        function confirmarEliminar(identificacion) {
            var mensaje = "¿Seguro que desea eliminar este empleado?";
            mostrarModalConfirmacion(mensaje, identificacion);
        }

        function mostrarModalConfirmacion(mensaje, identificacion) {
            var modal = document.getElementById("modalConfirmacion");
            var mensajeConfirmacion = document.getElementById("mensajeConfirmacion");

            mensajeConfirmacion.innerHTML = mensaje;
            modal.style.display = "block";

            var botonSi = document.querySelector("#modalConfirmacion button:first-of-type");
            botonSi.setAttribute("data-identificacion", identificacion);
        }

        function confirmarEliminarEmpleado() {
            var identificacion = document.querySelector("#modalConfirmacion button:first-of-type").getAttribute("data-identificacion");
            window.location.href = 'empleados.php?accion=eliminar&id=' + identificacion;
        }

        function cancelarEliminar() {
            document.getElementById("modalConfirmacion").style.display = "none";
        }


        function confirmarCerrarSesion() {
            var modalCerrarSesion = document.getElementById("modalCerrarSesion");
            modalCerrarSesion.style.display = "block";
        }

        function cerrarSesion() {
            window.location.href = 'inicio.php';
        }

        function cancelarCerrarSesion() {
            var modalCerrarSesion = document.getElementById("modalCerrarSesion");
            modalCerrarSesion.style.display = "none";
        }

    </script>
</body>
</html>
