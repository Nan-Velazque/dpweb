<?php

require_once("../model/CategoriesModel.php");
$objCategoria = new CategoriesModel();

$tipo = $_GET['tipo'];

if ($tipo == "registrar") {
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];

    if ($nombre == "" || $detalle == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error: Campos vacíos');
    } else {
        $existe = $objCategoria->existeCategoria($nombre);
        if ($existe > 0) {
            $arrResponse = array('status' => false, 'msg' => 'Error: Categoría ya existe');
        } else {
            $respuesta = $objCategoria->registrar($nombre, $detalle);
            if ($respuesta) {
                $arrResponse = array('status' => true, 'msg' => 'Categoría registrada correctamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al registrar la categoría');
            }
        }
    }

    echo json_encode($arrResponse);
}



// Obtener todas las categorías
if ($tipo == "listar") {
    $data = $objCategoria->getCategories();
    $arrResponse = array('status' => true, 'msg' => '', 'data' => $data);
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}




// Obtener datos de una categoría por ID (para editar)
if ($tipo == "ver") {
    $id = intval($_GET['id']);
    $data = $objCategoria->getCategory($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

// Actualizar categoría
if ($tipo == "actualizar") {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];

    if ($nombre == "" || $detalle == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error: Campos vacíos');
    } else {
        $respuesta = $objCategoria->actualizar($id, $nombre, $detalle);
        if ($respuesta) {
            $arrResponse = array('status' => true, 'msg' => 'Categoría actualizada correctamente');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Error al actualizar la categoría');
        }
    }
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}

// Eliminar categoría
if ($tipo == "eliminar") {
    $id = intval($_POST['id']);
    $respuesta = $objCategoria->eliminar($id);

    if ($respuesta) {
        $arrResponse = array('status' => true, 'msg' => 'Categoría eliminada correctamente');
    } else {
        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría');
    }
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    

}