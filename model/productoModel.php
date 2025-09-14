<?php
    require_once "../librerias/conexion.php";
class ProductoModel{

    private $conexion;
    function __construct(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function registrarProducto($codigo, $nombre, $detalle, $precio, $stock, $idCategoria, $fechaVencimiento, $imagen1, $idProveedor, $tipo_archivo){
        // Orden de la base de datos
        $sql = $this->conexion->query("CALL registrar_producto('{$codigo}', '{$nombre}', '{$detalle}', '{$precio}', '{$stock}', '{$idCategoria}', '{$fechaVencimiento}', '{$imagen1}', '{$idProveedor}', '{$tipo_archivo}')");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function actualizarProducto($id, $nombre, $detalle, $precio, $idProveedor, $idCategoria){
        $sql = $this->conexion->query("CALL actualizar_producto('{$id}','{$nombre}','{$detalle}','{$precio}','{$idProveedor}', '{$idCategoria}')");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function actualizar_imagen($id, $imagen1){
        $sql = $this->conexion->query("UPDATE producto SET imagen_1 = '{$imagen1}' WHERE id = '{$id}'");
        return 1;
    }

    public function obtener_productos(){
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM producto WHERE estado = 1");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }

    //Obtener productos por id (Administrador)
    public function obtener_producto_id($id){
        $respuesta = $this->conexion->query("SELECT nombre FROM producto WHERE id = '{$id}'");
        $objeto = $respuesta->fetch_object();
        return $objeto;
    }

    public function verProducto($id){
        $sql = $this->conexion->query(" SELECT * FROM producto WHERE id = '{$id}'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function eliminarProducto($id){
        $sql = $this->conexion->query("CALL eliminar_producto('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
}

?>
