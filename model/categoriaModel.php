<?php
    require_once "../librerias/conexion.php";
    class categoriaModel{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->connect();
        }

        // Todas las categorias
        public function obtener_categorias(){
            $arrRespuesta = array();
            $respuesta = $this->conexion->query("SELECT * FROM categoria WHERE estado = 1");
            while ($objeto = $respuesta->fetch_object()) {
                array_push($arrRespuesta, $objeto);
            }
            return $arrRespuesta;
        }

        // Por ID
        public function obtener_categoria($id){
            $respuesta = $this->conexion->query("SELECT * FROM categoria WHERE id='{$id}'");
            $objeto = $respuesta->fetch_object();
            return $objeto;
        }

        public function registrarCategoria($nombre, $detalle){
            // Orden de la base de datos
            $sql = $this->conexion->query("CALL registrar_categoria('{$nombre}', '{$detalle}')");
            return $sql;
        }
        
        public function verCategoria($id){
            $sql = $this->conexion->query("SELECT * FROM categoria WHERE id = '{$id}'");
            //convertimos la respuesta en un objeto
            $sql = $sql->fetch_object();
            return $sql;
        }

        public function actualizarCategoria($id_categoria, $nombre, $detalle){
            $sql = $this->conexion->query("CALL actualizar_categoria('{$id_categoria}','{$nombre}','{$detalle}')");
            $sql = $sql->fetch_object();
            return $sql;
        }

        public function eliminarCategoria($id){
            $sql = $this->conexion->query("CALL eliminar_categoria('{$id}')");
            return $sql;
        }
    }
?>
