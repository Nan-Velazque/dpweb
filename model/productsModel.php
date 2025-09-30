<?php
require_once("../library/conexion.php");

class ProductsModel 


{
    private $conexion;

    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function registrar($codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento) {
        $consulta = "INSERT INTO producto (codigo, nombre, detalle, precio, stock, id_categoria, fecha_vencimiento) 
                     VALUES ('$codigo', '$nombre', '$detalle', '$precio', '$stock', '$id_categoria', '$fecha_vencimiento')";
        $sql = $this->conexion->query($consulta);
        return $sql ? $this->conexion->insert_id : 0;
    }

    public function existeProducto($codigo) {
        $consulta = "SELECT * FROM producto WHERE codigo = '$codigo'";
        $sql = $this->conexion->query($consulta);
        return $sql->num_rows;
    }

    public function getProducts() {
        $consulta = "SELECT * FROM producto";
        $sql = $this->conexion->query($consulta);
        $data = [];
        while ($row = $sql->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getProduct($id) {
        $consulta = "SELECT * FROM producto WHERE id = $id LIMIT 1";
        $sql = $this->conexion->query($consulta);
        return $sql->fetch_assoc();
    }

    public function actualizar($id, $codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento) {
        $consulta = "UPDATE producto 
                     SET codigo = '$codigo', nombre = '$nombre', detalle = '$detalle', 
                         precio = '$precio', stock = '$stock', id_categoria = '$id_categoria',
                         fecha_vencimiento = '$fecha_vencimiento'
                     WHERE id = $id";
        $sql = $this->conexion->query($consulta);
        return $sql ? true : false;
    }

    public function eliminar($id) {
        $consulta = "DELETE FROM producto WHERE id = $id";
        $sql = $this->conexion->query($consulta);
        return $sql ? true : false;
    }
}
