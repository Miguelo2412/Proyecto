<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<link rel="icon" href="LoL.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<head>
    <title>Listado de Usuarios</title>
    <style>
        h1 {
            text-align: center;
            color: white;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 300px;
            background-color: #333;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .registrar-nuevo {
            text-align: center;
            padding: 20px;
            border: 1px solid #28a745;
            border-radius: 5px;
            background-color: #000;
            margin: 0 auto;
            width: 50%;
        }

        h1 {
            margin-top: 0;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: white;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #28a745;
            border-radius: 5px;
            font-size: 16px;
        }

        #limit {
            background-color: #28a745;
            color: #ffffff;
        }

        input[type="submit"] {
            background-color: #007bff; 
            color: #ffffff; 
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
            border: 2px solid #28a745; 
        }

        th, td {
            border: 1px solid #28a745; 
            padding: 8px;
            text-align: center;
            color: white;
        }

        th {
            background-color: #28a745; 
        }

        tr:nth-child(even) {
            background-color: #000;
        }

        tr:nth-child(even) {
            background-color: #222;
        }

        .table-container {
            text-align: left;
            margin-top: 20px;
            margin-right: 20px;
        }

        .editar, .borrar, .generar-informe, .generar-informe-general {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            cursor: pointer;
        }

        .editar {
            background-color: #007bff;
        }

        .borrar {
            background-color: #dc3545;
        }

        .generar-informe, .generar-informe-general {
            background-color: #28a745;
        }

        .generar-informe-general {
            margin-left: 10px;
        }

        .generar-informe:hover, .generar-informe-general:hover {
            background-color: #0056b3;
        }

        .registrar-nuevo button,
        .generar-informe-general {
            padding: 10px 25px; 
        }

        #buscar {
            width: 150px; 
        }

        select {
            color: #ffffff; 
            background-color: #28a745;
        }

        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            border-radius: 5px;
        }

        .menu li {
            float: right;
        }

        .menu li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .menu li a:hover {
            background-color: #111;
        }

        .menu .active {
            background-color: #4CAF50;
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

<?php
require_once 'clases.php';

$crud = new Empleados();

$limit = 20;
$paginaActual = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_usuario'])) {
        $id_usuario = $_POST['id_usuario'];

        if (isset($_POST['accion']) && $_POST['accion'] === 'Borrar') {
            $crud->eliminarCliente($id_usuario);
        }
    }

    if (isset($_POST['limit'])) {
        $limit = (int)$_POST['limit'];
    }

    if (isset($_POST['pagina'])) {
        $paginaActual = (int)$_POST['pagina'];
    }

    if (isset($_POST['filtro']) && isset($_POST['valor_buscar'])) {
        $filtro = $_POST['filtro'];
        $valor_buscar = $_POST['valor_buscar'];
        $usuarios = $crud->buscarClientes($filtro, $valor_buscar);
    }
}

$offset = ($paginaActual - 1) * $limit;

if (!isset($usuarios)) {
    $usuarios = $crud->seleccionarClientesConLimite($limit, $offset);
}

$totalUsuarios = $crud->contarClientes();
$totalPaginas = ceil($totalUsuarios / $limit);
?>

<br><br><br>
<h1>Listado de Usuarios</h1>

<form method="POST" style="text-align: center;">
    <label for="limit">Datos por página:</label>
    <select name="limit" id="limit">
        <option value="20" <?php if ($limit == 20) echo "selected"; ?>>20</option>
        <option value="15" <?php if ($limit == 15) echo "selected"; ?>>15</option>
        <option value="7" <?php if ($limit == 7) echo "selected"; ?>>7</option>
    </select>
    <input type="submit" value="Aplicar">
</form>

<div id="info-datos"></div>

<div class="table-container">
    
    
    <class="pagination" style="float: center; margin-top: 20px;">
        <button onclick="cambiarPagina(<?php echo max($paginaActual - 1, 1); ?>)" <?php if ($paginaActual == 1) echo 'disabled'; ?>>&lt;</button>
        <span>Página <?php echo $paginaActual; ?> de <?php echo $totalPaginas; ?></span>
        <button onclick="cambiarPagina(<?php echo min($paginaActual + 1, $totalPaginas); ?>)" <?php if ($paginaActual == $totalPaginas) echo 'disabled'; ?>>&gt;</button>

    <button>Registrar Nuevo</button>
</a></a>
    
    <form method="POST" action="clientes.php" style="float: right; margin-top: 20px;">
        <select name="filtro" id="filtro">
            <option value="identidad_usu" <?php if (isset($filtro) && $filtro == 'identidad_usu') echo 'selected'; ?>>Documento</option>
            <option value="nombre_usu" <?php if (isset($filtro) && $filtro == 'nombre_usu') echo 'selected'; ?>>Nombre</option>
            <option value="apellido_usu" <?php if (isset($filtro) && $filtro == 'apellido_usu') echo 'selected'; ?>>Apellido</option>
            <option value="telefono_usu" <?php if (isset($filtro) && $filtro == 'telefono_usu') echo 'selected'; ?>>Teléfono</option>
            <option value="correo_usu" <?php if (isset($filtro) && $filtro == 'correo_usu') echo 'selected'; ?>>Correo</option>
        </select>
        <input type="text" name="valor_buscar" id="buscar" value="<?php if (isset($valor_buscar)) echo $valor_buscar; ?>">
        <button type="submit">Buscar</button>
    </form>

</div>

<table>
    <tr>
        <th>Id usuario</th>
        <th>Numero de Documento</th>
        <th>Tipo de documento del usuario</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Correo del usuario</th>
        <th>Usuario en el sistema</th>
        <th>Contraseña</th>
        <th>Tipo de usuario</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $usuario) : ?>
        <tr>
            <td><?php echo $usuario['id_usuario']; ?></td>
            <td><?php echo $usuario['identidad_usu']; ?></td>
            <td><?php echo $usuario['tipo_docu_usu']; ?></td>
            <td><?php echo $usuario['nombre_usu']; ?></td>
            <td><?php echo $usuario['apellido_usu']; ?></td>
            <td><?php echo $usuario['telefono_usu']; ?></td>
            <td><?php echo $usuario['direccion_usu']; ?></td>
            <td><?php echo $usuario['correo_usu']; ?></td>
            <td><?php echo $usuario['usuario_sistema']; ?></td>
            <td><?php echo $usuario['password_usu']; ?></td>
            <td><?php echo $usuario['tipo_usu']; ?></td>
            <td><img class="imagen-usuario" src="imagenes/<?php echo $usuario['img']; ?>" alt="Imagen de Usuario" width="70"></td>
            <td class="actions">
                <a class="editar" href="editarcli.php?id=<?php echo $usuario['id_usuario']; ?>">Editar</a>
                <form method="POST" style="display: inline-block;">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
                    <input type="hidden" name="accion" value="Borrar"> 
                    <button class="borrar" type="submit">Borrar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<form id="filtroForm" method="POST" style="display:none;">
    <input type="hidden" name="limit" id="limit" value="<?php echo $limit; ?>">
    <input type="hidden" name="pagina" id="pagina" value="<?php echo $paginaActual; ?>">
</form>

<div id="modalCerrarSesion" class="modal">
    <div class="modal-content modal-content-logout">
        <p id="mensajeCerrarSesion">¿Estás seguro de cerrar sesión?</p>
        <button onclick="cerrarSesion()">Sí</button>
        <button onclick="cancelarCerrarSesion()">No</button>
    </div>
</div>

    
    <script>
    let filtroSeleccionado = "<?php echo isset($filtro) ? $filtro : 'identidad_usu'; ?>";

    function cambiarPagina(pagina) {
        document.getElementById('pagina').value = pagina;
        document.getElementById('filtroForm').submit();
    }

    function establecerFiltroSeleccionado() {
        const filtroElement = document.getElementById('filtro');
        filtroElement.value = filtroSeleccionado;
    }

    function actualizarInfoDatos() {
        var totalMostrados = <?php echo count($usuarios); ?>;
        var totalRegistros = <?php echo $totalUsuarios; ?>;
        var infoElement = document.getElementById('info-datos');
        infoElement.textContent = "Mostrando " + totalMostrados + " datos de " + totalRegistros + " totales";
    }

    window.onload = function () {
        establecerFiltroSeleccionado();
        actualizarInfoDatos();
    };

    function confirmarCerrarSesion() {
        var modalCerrarSesion = document.getElementById("modalCerrarSesion2");
        modalCerrarSesion.style.display = "block";
    }

    function cerrarSesion() {
        window.location.href = 'inicio.php';
        return false; 

    function cancelarCerrarSesion() {
        var modalCerrarSesion = document.getElementById("modalCerrarSesion");
        modalCerrarSesion.style.display = "none";
    }

</script>
</script>

</body>
</html>
