<?php
require_once("../library/conexion.php");

class CategoriaModel {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function registrar($nombre, $detalle) {
        $consulta = "INSERT INTO categoria (nombre, detalle) VALUES ('$nombre', '$detalle')";
        $sql = $this->conexion->query($consulta);
        return $sql ? $this->conexion->insert_id : 0;
    }

    public function existeCategoria($nombre) {
        $consulta = "SELECT * FROM categoria WHERE nombre = '$nombre'";
        $sql = $this->conexion->query($consulta);
        return $sql ? $sql->num_rows : 0;
    }
}
