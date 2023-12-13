<?php
require_once 'conexion.php';

class Empleados extends Conexion {
    public function seleccionarEmpleados() {
        $query = "SELECT * FROM empleados";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function seleccionarEmpleadoPorIdentificacion($identificacion) {
        $query = "SELECT * FROM empleados WHERE identificacion = :identificacion";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->bindParam(':identificacion', $identificacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function registrarEmpleado($datos) {
        $query = "INSERT INTO empleados (identificacion, NIT, tipo_documento, nombre, nombre2, apellido, apellido2, fecha_nacimiento, genero, estado_civil, telefono, correo) 
                  VALUES (:identificacion, :NIT, :tipo_documento, :nombre, :nombre2, :apellido, :apellido2, :fecha_nacimiento, :genero, :estado_civil, :telefono, :correo)";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute($datos);
    }
    
    public function actualizarEmpleado($datos) {
        $query = "UPDATE empleados 
                  SET tipo_documento = :tipo_documento, nombre = :nombre, nombre2 = :nombre2, apellido = :apellido, 
                      apellido2 = :apellido2, fecha_nacimiento = :fecha_nacimiento, genero = :genero, 
                      estado_civil = :estado_civil, telefono = :telefono, correo = :correo 
                  WHERE identificacion = :identificacion";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute($datos);
    }

    public function eliminarEmpleado($identificacion) {
        $query = "DELETE FROM empleados WHERE identificacion = :identificacion";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->bindParam(':identificacion', $identificacion, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function seleccionarEmpresas() {
        $query = "SELECT * FROM empresa";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function seleccionarEmpresaPorNIT($NIT) {
        $query = "SELECT * FROM empresa WHERE NIT = :NIT";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->bindParam(':NIT', $NIT, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function registrarEmpresa($datos) {
        $query = "INSERT INTO empresa (NIT, nombre_empresa, telefono, correo, municipio, barrio, nomenclatura, twitter, facebook, instagram, youtube) 
                  VALUES (:NIT, :nombre_empresa, :telefono, :correo, :municipio, :barrio, :nomenclatura, :twitter, :facebook, :instagram, :youtube)";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute($datos);
    }

    public function actualizarEmpresa($datos) {
        $query = "UPDATE empresa 
                  SET nombre_empresa = :nombre_empresa, telefono = :telefono, correo = :correo, municipio = :municipio, 
                      barrio = :barrio, nomenclatura = :nomenclatura, twitter = :twitter, facebook = :facebook, 
                      instagram = :instagram, youtube = :youtube 
                  WHERE NIT = :NIT";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute($datos);
    }

    public function eliminarEmpresa($NIT) {
        $query = "DELETE FROM empresa WHERE NIT = :NIT";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->bindParam(':NIT', $NIT, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function registrarCliente($identidad_usu, $tipo_docu_usu, $nombre_usu, $apellido_usu, $telefono_usu, $direccion_usu, $correo_usu, $usuario_sistema, $password_usu, $tipo_usu, $imagen)
    {
        $ruta_imagen = "";

        if (isset($imagen['name']) && $imagen['name']) {
            $ruta_destino = 'imagenes/' . $imagen['name'];
            if (move_uploaded_file($imagen['tmp_name'], $ruta_destino)) {
                $ruta_imagen = $imagen['name'];
            } else {
                die("Error al subir la imagen.");
            }
        }

        $password_encriptada = password_hash($password_usu, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (identidad_usu, tipo_docu_usu, nombre_usu, apellido_usu, telefono_usu, direccion_usu, correo_usu, usuario_sistema, password_usu, tipo_usu, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$identidad_usu, $tipo_docu_usu, $nombre_usu, $apellido_usu, $telefono_usu, $direccion_usu, $correo_usu, $usuario_sistema, $password_encriptada, $tipo_usu, $ruta_imagen]);
    }
    

    public function seleccionarClientePorID($id_usuario) 
    
    {
        $query = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function actualizarCliente($id_usuario, $identidad_usu, $tipo_docu_usu, $nombre_usu, $apellido_usu, $telefono_usu, $direccion_usu, $correo_usu, $usuario_sistema, $password_usu, $tipo_usu, $ruta_imagen)
    {
        if ($ruta_imagen) {
            $sql = "UPDATE usuario SET identidad_usu = ?, tipo_docu_usu = ?, nombre_usu = ?, apellido_usu = ?, telefono_usu = ?, direccion_usu = ?, correo_usu = ?, usuario_sistema = ?, password_usu = ?, tipo_usu = ?, img = ? WHERE id_usuario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$identidad_usu, $tipo_docu_usu, $nombre_usu, $apellido_usu, $telefono_usu, $direccion_usu, $correo_usu, $usuario_sistema, $password_usu, $tipo_usu, $ruta_imagen, $id_usuario]);
        } else {
            $sql = "UPDATE usuario SET identidad_usu = ?, tipo_docu_usu = ?, nombre_usu = ?, apellido_usu = ?, telefono_usu = ?, direccion_usu = ?, correo_usu = ?, usuario_sistema = ?, password_usu = ?, tipo_usu = ? WHERE id_usuario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$identidad_usu, $tipo_docu_usu, $nombre_usu, $apellido_usu, $telefono_usu, $direccion_usu, $correo_usu, $usuario_sistema, $password_usu, $tipo_usu, $id_usuario]);
        }
    }


    public function eliminarCliente($id_usuario) 
    
    {
        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
    }


    public function seleccionarClientes() 
    {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function seleccionarClientesConLimite($limit, $offset) 
    {
        $query = "SELECT * FROM usuario LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    public function contarClientes() 
    {
        $query = "SELECT COUNT(*) as total FROM usuario";
        $result = $this->pdo->query($query);
    
        return $result->fetch(PDO::FETCH_ASSOC)['total'];
    }


    public function buscarClientes($filtro, $valor) 
    {
        $query = "SELECT * FROM usuario WHERE $filtro LIKE :valor";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':valor', "%$valor%", PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
