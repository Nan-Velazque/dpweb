<?php
require_once("../model/categoriaModel.php");
header('Content-Type: application/json');

$objcategoria = new CategoriaModel();
$tipo = $_GET['tipo'] ?? '';

if ($tipo == "registrar") {
    $nombre = trim($_POST['nombre'] ?? '');
    $detalle = trim($_POST['detalle'] ?? '');

    if ($nombre === '' || $detalle === '') {
        echo json_encode(['status' => false, 'msg' => 'Error: campos vacíos']);
        exit;
    }

    $existe = $objcategoria->existeCategoria($nombre);
    if ($existe > 0) {
        echo json_encode(['status' => false, 'msg' => 'Error: la categoría ya existe']);
        exit;
    }

    $respuesta = $objcategoria->registrar($nombre, $detalle);
    if ($respuesta > 0) {
        echo json_encode(['status' => true, 'msg' => 'Categoría registrada correctamente']);
    } else {
        echo json_encode(['status' => false, 'msg' => 'Error al registrar en base de datos']);
    }
}