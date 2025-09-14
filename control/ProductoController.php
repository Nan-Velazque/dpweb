<?php
    require_once('../model/productoModel.php');
    require_once('../model/categoriaModel.php');
    require_once('../model/personaModel.php');
    $tipo = $_REQUEST['tipo'];

    // Intanciar la clase modeloproducto
    $objProducto = new ProductoModel();
    $objCategoria = new categoriaModel();
    $objPersona = new personaModel();

    if ($tipo == 'listar') {
        //respuesta
        $arr_Respuesta = array('status'=>false, 'contenido'=>'');
        $arr_Productos = $objProducto->obtener_productos();
        if (!empty($arr_Productos)) {
            // Recorremos el array para agregar las opciones den las categorias
            for ($i=0; $i < count($arr_Productos); $i++) {
                $id_categoria = $arr_Productos[$i]->id_categoria;
                $r_categoria = $objCategoria->obtener_categoria($id_categoria);
                $arr_Productos[$i]->categoria=$r_categoria;

                $id_persona = $arr_Productos[$i]->id_proveedor;
                $r_persona = $objPersona->obtener_persona($id_persona);
                $arr_Productos[$i]->proveedor=$r_persona;

                $idProducto = $arr_Productos[$i]->id;
                $producto = $arr_Productos[$i]->nombre;
                                     //Redirigir al archivo editar-producto                                                  //Llamar a la funcion eliminar_producto()
                $opciones = '<a href="'.BASE_URL.'/editar-producto/'.$idProducto.'"><i class="fas fa-edit"></i>Editar</a>    <button onclick="eliminar_producto('.$idProducto.');">Eliminar</button>';
                $arr_Productos[$i]->options = $opciones;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_Productos;
        }
    
        echo json_encode($arr_Respuesta);
    }

    if ($tipo == 'registrar') {
        //echo $_FILES['imagen1']['name'];
        /* echo $_FILES['imagen2']['name'];
        echo $_FILES['imagen3']['name'];
        echo $_FILES['imagen4']['name']; */

        if ($_POST) {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $detalle = $_POST['detalle'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $idCategoria = $_POST['idCategoria'];
            $fechaVencimiento = $_POST['fechaVencimiento'];
            /* $imagen1 = $_POST['imagen1']; */
            $imagen1 = 'imagen1';
            $idProveedor = $_POST['idProveedor'];
            if ($codigo == "" || $nombre == "" || $detalle == "" || $precio == "" || $stock == "" || $idCategoria == "" || $fechaVencimiento == "" || $imagen1 == "" || $idProveedor == "") {
                // respuesta
                $arr_Respuesta = array('status'=>false,'mensaje'=>'Error, campos vacíos');
            }else{
                //cargar archivos
                $archivo = $_FILES['imagen1']['tmp_name'];
                $destino = '../assets/img_productos/';
                $tipo_archivo = strtolower(pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION));
                // Aqui se guardará la respuesta del modelo
                $arrProducto = $objProducto->registrarProducto(
                    $codigo, $nombre, $detalle, $precio, $stock, $idCategoria , $fechaVencimiento, $imagen1, $idProveedor, $tipo_archivo);

                if ($arrProducto->id_n > 0) {
                    $newid = $arrProducto->id_n;
                    $arr_Respuesta = array('status'=>true,'mensaje'=>'Registro exitoso.');
                    $nombre = $arrProducto->id_n . "." . $tipo_archivo;

                    if (move_uploaded_file($archivo, $destino . '' . $nombre)) {
                    } else {
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso, error al subir imagen');
                    }

                }else{
                    $arr_Respuesta = array('status'=>false,'mensaje'=>'Error al registrar producto.');
                }
                echo json_encode($arr_Respuesta);
            }

        }
    }

     if ($tipo == 'listarP') {
        //respuesta
        $arr_Respuesta = array('status'=>false, 'contenido'=>'');
        $arr_Productos = $objProducto->obtener_productos();
        if (!empty($arr_Productos)) {
            // Recorremos el array para agregar las opciones den las categorias
            for ($i=0; $i < count($arr_Productos); $i++) {
                $idCategoria = $arr_Productos[$i]->id;
                $categoria = $arr_Productos[$i]->nombre;
                $opciones = '';
                $arr_Productos[$i]->options = $opciones;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_Productos;
        }
    
        echo json_encode($arr_Respuesta);
    }

    if ($tipo == 'ver') {
        $id_producto = $_POST['id_producto'];
        $arr_Respuesta = $objProducto->verProducto($id_producto);
        /* print_r($arr_Respuesta); */
        if (empty($arr_Respuesta)) {
            $response = array('status' => false, 'mensaje' => "Error, no hay informacion.");
        }else {
            $response = array('status' => true, 'mensaje' => "Datos encontrados", 'contenido' => $arr_Respuesta);
        }
        echo json_encode($response);
    }

    if ($tipo == "actualizar") {
        /* print_r($_POST); */

        $id_producto = $_POST['id_producto'];
        $img = $_POST['img'];
        $nombre = $_POST['nombre'];
        $detalle = $_POST['detalle'];
        $precio = $_POST['precio'];
        $idCategoria = $_POST['idCategoria'];
        $idProveedor = $_POST['idProveedor'];
        if ($id_producto ==  "" || $nombre == "" || $detalle == "" || $precio == "" || $idCategoria == "" || $idProveedor == "") {
            //repuesta
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            $arrProducto = $objProducto->actualizarProducto(
                $id_producto, $nombre, $detalle, $precio, $idCategoria, $idProveedor);
                
            if ($arrProducto->p_id > 0) {
                $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
    
                if ($_FILES['imagen1']['tmp_name'] != "") {
                    unlink('../assets/img_productos/' . $img);
    
                    //cargar archivos
                    $archivo = $_FILES['imagen1']['tmp_name'];
                    $destino = '../assets/img_productos/';
                    $tipo_archivo = strtolower(pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION));
                    if (move_uploaded_file($archivo, $destino . '' . $id_producto.'.'.$tipo_archivo)) {

                    }
                }
            } else {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar producto');
            }
        }
        echo json_encode($arr_Respuesta);
    }

    if ($tipo == 'eliminar') {
        $id_producto = $_POST['id_producto'];
        $arr_Respuesta = $objProducto->eliminarProducto($id_producto);
        /* print_r($arr_Respuesta); */
        if (empty($arr_Respuesta)) {
            $response = array('status' => false);
        }else {
            $response = array('status' => true);
        }
        echo json_encode($response);
    }

?>
