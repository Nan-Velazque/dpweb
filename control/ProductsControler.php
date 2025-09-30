<?php
require_once("../model/ProductsModel.php");
$objProducto = new ProductsModel(); 

$tipo = $_GET['tipo'] ?? '';

switch($tipo) {

    // REGISTRAR PRODUCTO
    case "registrar":
        $codigo = $_POST['codigo'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $detalle = $_POST['detalle'] ?? '';    
        $precio = $_POST['precio'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? null;

        $imagen = null;
        if(!empty($_FILES['imagen_file']['name'])){
            $nombreArchivo = time().'_'.$_FILES['imagen_file']['name'];
            move_uploaded_file($_FILES['imagen_file']['tmp_name'], "../uploads/".$nombreArchivo);
            $imagen = "uploads/".$nombreArchivo;
        } elseif(!empty($_POST['imagen_url'])){
            $imagen = $_POST['imagen_url'];
        }

        if ($codigo == "" || $nombre == "" || $detalle == "" || $precio == "" || $stock == "") {
            $arrResponse = ['status'=>false, 'msg'=>'Error: Campos vacíos'];
        } else {
            $existe = $objProducto->existeProducto($codigo);
            if ($existe > 0) {
                $arrResponse = ['status'=>false, 'msg'=>'Error: Código de producto ya existe'];
            } else {
                $respuesta = $objProducto->registrar($codigo,$nombre,$detalle,$precio,$stock,$fecha_vencimiento,$imagen);
                $arrResponse = $respuesta ? 
                    ['status'=>true, 'msg'=>'Producto registrado correctamente'] : 
                    ['status'=>false, 'msg'=>'Error al registrar el producto'];
            }
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    break;


    // LISTAR PRODUCTOS
    case "listar":
        $data = $objProducto->getProducts();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    break;

    // VER UN PRODUCTO
    case "ver":
        $id = intval($_GET['id']);
        $data = $objProducto->getProduct($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    break;

    // ACTUALIZAR PRODUCTO
    case "actualizar":
        $id = intval($_POST['id'] ?? 0);
        $codigo = $_POST['codigo'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $detalle = $_POST['detalle'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? null;

        // Manejar imagen: archivo o URL
        $imagen = null;
        if(!empty($_FILES['imagen_file']['name'])){
            $nombreArchivo = time().'_'.$_FILES['imagen_file']['name'];
            move_uploaded_file($_FILES['imagen_file']['tmp_name'], "../uploads/".$nombreArchivo);
            $imagen = "uploads/".$nombreArchivo;
        } elseif(!empty($_POST['imagen_url'])){
            $imagen = $_POST['imagen_url'];
        } else {
            // Mantener imagen actual
            $producto = $objProducto->getProduct($id);
            $imagen = $producto['imagen'] ?? null;
        }

        if($codigo=="" || $nombre=="" || $detalle=="" || $precio=="" || $stock==""){
            $arrResponse = ['status'=>false,'msg'=>'Error: Campos vacíos'];
        } else {
            $r = $objProducto->actualizar($id,$codigo,$nombre,$detalle,$precio,$stock,$fecha_vencimiento,$imagen);
            $arrResponse = $r ? ['status'=>true,'msg'=>'Producto actualizado correctamente'] : ['status'=>false,'msg'=>'Error al actualizar'];
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    break;

    // ELIMINAR PRODUCTO
    case "eliminar":
        $id = intval($_POST['id'] ?? 0);
        $r = $objProducto->eliminar($id);
        $arrResponse = $r ? ['status'=>true,'msg'=>'Producto eliminado correctamente'] : ['status'=>false,'msg'=>'Error al eliminar'];
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    break;

    default:
        echo json_encode(['status'=>false,'msg'=>'Acción no válida'], JSON_UNESCAPED_UNICODE);
    break;
}