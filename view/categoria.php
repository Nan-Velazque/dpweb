<?php
require_once('../model/categoriaModel.php');
$tipo = $_REQUEST['tipo'];
$objCategoria = new categoriaModel();

if ($tipo == 'listar') {
    
    $arr_Respuesta = array('status'=>false, 'contenido'=>'');
    $arr_Categorias = $objCategoria->obtener_categorias();
    if (!empty($arr_Categorias)) {
        
        for ($i=0; $i < count($arr_Categorias); $i++) {
            $idCategoria = $arr_Categorias[$i]->id;
            $categoria = $arr_Categorias[$i]->nombre;
            $opciones = '<a href="'.BASE_URL.'/editar-categoria/'.$idCategoria.'"><i class="fas fa-edit"></i>Editar</a>    <button onclick="eliminar_categoria('.$idCategoria.');">Eliminar</button>';
            $arr_Categorias[$i]->options = $opciones;
        }
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['contenido'] = $arr_Categorias;
    }

    echo json_encode($arr_Respuesta);
}

if ($tipo == 'registrar') {

    if ($_POST) {
        $nombre = $_POST['nombre'];
        $detalle = $_POST['detalle'];
        if ($nombre == "" || $detalle == "") {
            
            $arr_Respuesta = array('status'=>false,'mensaje'=>'Error, campos vacíos');
        }else{
            
            $arrCategoria = $objCategoria->registrarCategoria(
                $nombre, $detalle);

            if ($arrCategoria->id>0) {
                $arr_Respuesta = array('status'=>true,'mensaje'=>'Registro exitoso.');

            }else{
                $arr_Respuesta = array('status'=>false,'mensaje'=>'Error al registrar producto.');
            }
            echo json_encode($arr_Respuesta);
        }

    }
}

if($tipo == 'ver'){
   
    $id_categoria = $_POST['id_categoria'];
 
    $arr_Respuesta = $objCategoria->verCategoria($id_categoria);
  
    if (empty($arr_Respuesta)) {
        $response = array('status'=>false, 'mensaje'=>"Error, no hay información");
    }else{
        $response = array('status'=>true, 'mensaje'=>"Datos encontrados", 'contenido'=>$arr_Respuesta);
    }
    echo json_encode($response);

}

if ($tipo == "actualizar") {
    $id_categoria = $_POST['id_categoria'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    if ($id_categoria == "" || $nombre == "" || $detalle == "") {
        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
    } else {
        $arrCategoria = $objCategoria->actualizarCategoria($id_categoria, $nombre, $detalle);
        if ($arrCategoria->p_id > 0) {
            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
        } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar categoria');
        }
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo == "eliminar") {
    
   $id_categoria = $_POST['id_categoria'];
 
   $arr_Respuesta = $objCategoria->eliminarCategoria($id_categoria);
   
   if (empty($arr_Respuesta)) {
       $response = array('status' => false);
   } else {
       $response = array('status' => true);
   }
   echo json_encode($response);
}

?>
