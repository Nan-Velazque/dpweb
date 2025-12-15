<?php
require_once("../model/VentaModel.php");
require_once("../model/ProductsModel.php");
require_once("../model/UsuarioModel.php");

$objProducto = new ProductsModel();
$objVenta = new VentaModel();
$objPersona = new UsuarioModel();


$tipo = $_GET['tipo'];


if ($tipo == "registrarTemporal") {
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $id_producto = $_POST['id_producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $b_producto = $objVenta->buscarTemporal($id_producto);

    if ($b_producto) {
        $nueva_cantidad = $b_producto->cantidad + 1;
        $objVenta->actualizarCantidadTemporal($id_producto, $nueva_cantidad);
        $respuesta = array('status' => true, 'msg' => 'actualizado');
    } else {
        $registro = $objVenta->registrar_temporal($id_producto, $precio, $cantidad);
        $respuesta = array('status' => true, 'msg' => 'registrado');
    }
    echo json_encode($respuesta);
}
if ($tipo == "listarTemporal") {
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $b_producto = $objVenta->buscarTemporal($id_producto);
    if ($b_producto)
        $respuesta = array('status' => true, 'msg' => 'actualizado');
    echo json_encode($respuesta);
}




if ($tipo == "listar_venta_temporal") {
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $b_producto = $objVenta->buscarTemporales();
    if ($b_producto) {
        $respuesta = array('status' => true, 'data' => $b_producto);
    } else {
        $respuesta = array('status' => false, 'msg' => 'no se encontraron datos');
    }
    echo json_encode($respuesta);
}

if ($tipo == "actualizar_cantidad") {
    $id = $_POST['id'];
    $cantidad =  $_POST['cantidad'];
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $consulta = $objVenta->actualizarCantidadTemporalByid($id, $cantidad);
    if ($consulta) {
        $respuesta = array('status' => true, 'msg' => 'success');
    } else {
        $respuesta = array('status' => false, 'msg' => 'error');
    }
    echo json_encode($respuesta);
}

if ($tipo == "buscarCliente") {
    $dni = $_POST['dni'];
    $respuesta = array('status' => false, 'msg' => 'Cliente no encontrado');
    $cliente = $objPersona->buscarPersonaPorNroIdentidad($dni);
    if ($cliente) {
        $respuesta = array('status' => true, 'data' => $cliente);
    }
    echo json_encode($respuesta);
}

if ($tipo == "usuario_sesion") {
    session_start();
    $respuesta = array('status' => false, 'msg' => 'No hay usuario en sesión');
    if (isset($_SESSION['ventas_id']) && !empty($_SESSION['ventas_id'])) {
        $id_sesion = $_SESSION['ventas_id'];
        $usuario = $objPersona->obtenerUsuarioPorId($id_sesion);
        if ($usuario) {
            $respuesta = array('status' => true, 'data' => $usuario);
        }
    }
    echo json_encode($respuesta);

    if ($tipo == "registrar_venta") {
        $id_cliente = $_POST['id_cliente'];
        $fecha_venta = $_POST['fecha_venta'];
        $id_vendedor = $_SESSION['ventas_id'];
        $ultima_venta = $objVenta->buscar_ultima_venta();

        //logica para registrar la venta 
        $respuesta = array('status' => false, 'msg' => 'No se pudo registrar la venta');
            if ($ultima_venta) {
                $correlativo = $ultima_venta->codigo + 1;
            }else {
                $correlativo = 1;
            }
            //registrar la venta oficial
            $venta = $objVenta->registrar_venta($correlativo, $id_venta , $_cliente, $id_vendedor);
            if ($venta) {
                //registrar los detalles de la venta 
                $temporales = $objVenta->buscarTemporales();
                foreach ($temporales as $temporal) {
                    $objVenta->registrar_detalle_venta($venta, $temporal->id_producto, $temporal->precio, $temporal->cantidad);
                }
                //eliminar los temporales
                $objVenta->eliminarTemporales();            
                $respuesta = array('status' => true, 'msg' => 'Venta registrada con exito');
            }else {
                $respuesta = array('status' => false, 'msg' => 'Error al registrar la venta');
            }    
        echo json_encode($respuesta);    

    }
}
