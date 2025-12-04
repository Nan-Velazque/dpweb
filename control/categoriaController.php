<?php
require_once("../model/CategoriaModel.php");

$objCategoria = new CategoriaModel();

$tipo = $_GET['tipo'];
if ($tipo == "registrar") {
    //print_r($_POST);
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];

    if ($nombre == "" || $detalle == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
    } else {
        //validacion si existe categoria con el mismo nombre
        $existeCategoria = $objCategoria->existeCategoria($nombre);
        if ($existeCategoria > 0) {
            $arrResponse = array('status' => false, 'msg' => 'Error, nombre de categoria ya existe');
        } else {

            $respuesta = $objCategoria->registrar($nombre, $detalle);
            if ($respuesta) {
                $arrResponse = array('status' => true, 'msg' => 'Registrado correctamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error, fallo en registro');
            }
        }
    }
    echo json_encode($arrResponse);
}

if ($tipo == "mostrar_categorias") {
   $categorias = $objCategoria->mostrarCategorias();
   $respuesta = array();
   if (!empty($categorias)) {
    $respuesta = array('status' => true, 'msg' => 'Categorias encontradas', 'data' => $categorias);
   }else {
    $respuesta = array('status' => false, 'msg' => 'No ahy categorias registradas', 'data' => array());
   }
   header('Content-Type: application/json');
   echo json_encode($respuesta);
}

if ($tipo == "ver") {
    $respuesta = array('status' => false, 'msg' => '');
    $id_categoria = $_POST['id_categoria'];
    $categoria = $objCategoria->ver($id_categoria);
    if($categoria){
        $respuesta ['status'] = true;
        $respuesta ['data'] = $categoria;
    }else {
        $respuesta['msg'] = "Error, categoria no existe";
    }
    echo json_encode($respuesta);
}

if ($tipo == "obtener_categoria") {
    header('Content-Type: application/json');
    $id = $_GET['id'];
    $modelo = new CategoriaModel();
    $categoria = $modelo->obtenerCategoriaPorId($id);
    echo json_encode($categoria);
    exit;
}

if ($tipo == "actualizar") {
    $id_categoria = $_POST['id_categoria'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];

    if ($id_categoria == "" || $nombre == "" || $detalle == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
    }else {
        $existeID = $objCategoria->ver($id_categoria);
        if(!$existeID){
            $arrResponse = array('status' =>false, 'msg' => 'Error, categoria no existe');
            echo json_encode($arrResponse);
            exit; 
        }else {
            $actualizar = $objCategoria->actualizar($id_categoria, $nombre, $detalle);
            if($actualizar){
                $arrResponse = array('status' => true, 'msg' => 'Actualizado correctamente');
                
            }else {
                $arrResponse = array('status' => false, 'msg' => $actualizar);  
            }
            echo json_encode($arrResponse);
            exit;
        }
    }
}

if($tipo == "eliminar"){
    $id_categoria = $_POST['id_categoria'];
    if($id_categoria == ""){
        $arrResponse = array('status' => false, 'msg' => 'Error, id vacio');
    }else{
        $eliminar = $objCategoria->eliminar($id_categoria);
        if ($eliminar) {
            $arrResponse = array('status' => true, 'msg' => 'Categoria eliminada');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'Error al eliminar categoria');
        }
        echo json_encode($arrResponse);
        exit;
    }
}