<?php
require_once("../model/proveedor.Model.php");
$proveedor = new UsuarioModel();

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

switch ($tipo) {

    //  Registrar proveedor
    case 'registrar':
        if (!empty($_POST['nro_identidad']) && !empty($_POST['razon_social'])) {
            $nro_identidad = $_POST['nro_identidad'];
            $razon_social  = $_POST['razon_social'];
            $telefono      = $_POST['telefono'];
            $correo        = $_POST['correo'];
            $departamento  = $_POST['departamento'];
            $provincia     = $_POST['provincia'];
            $distrito      = $_POST['distrito'];
            $cod_postal    = $_POST['cod_postal'];
            $direccion     = $_POST['direccion'];
            $rol           = $_POST['rol'];
            $password      = '';

            $res = $proveedor->registrar($nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $password);

            if ($res > 0) {
                echo json_encode(["status" => true, "msg" => "Proveedor registrado correctamente."]);
            } else {
                echo json_encode(["status" => false, "msg" => "Error al registrar proveedor."]);
            }
        } else {
            echo json_encode(["status" => false, "msg" => "Faltan campos obligatorios."]);
        }
        break;

    //  Ver todos los proveedores
    case 'ver_proveedores':
        $data = $proveedor->verUsuario(); // usa la tabla persona
        echo json_encode($data);
        break;

    //  Ver un proveedor específico
    case 'ver':
        $id = $_POST['id_persona'];
        $data = $proveedor->ver($id);
        if ($data) {
            echo json_encode(["status" => true, "data" => $data]);
        } else {
            echo json_encode(["status" => false, "msg" => "Proveedor no encontrado."]);
        }
        break;

    //  Actualizar proveedor
    case 'actualizar':
        $id_persona   = $_POST['id_persona'];
        $nro_identidad = $_POST['nro_identidad'];
        $razon_social  = $_POST['razon_social'];
        $telefono      = $_POST['telefono'];
        $correo        = $_POST['correo'];
        $departamento  = $_POST['departamento'];
        $provincia     = $_POST['provincia'];
        $distrito      = $_POST['distrito'];
        $cod_postal    = $_POST['cod_postal'];
        $direccion     = $_POST['direccion'];
        $rol           = $_POST['rol'];

        $res = $proveedor->actualizar($id_persona, $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol);

        if ($res) {
            echo json_encode(["status" => true, "msg" => "Proveedor actualizado correctamente."]);
        } else {
            echo json_encode(["status" => false, "msg" => "Error al actualizar proveedor."]);
        }
        break;

    //  Eliminar proveedor
    case 'eliminar':
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $conexion = new Conexion();
            $db = $conexion->connect();
            $sql = $db->query("DELETE FROM persona WHERE id='$id'");
            if ($sql) {
                echo json_encode(["status" => true, "msg" => "Proveedor eliminado correctamente."]);
            } else {
                echo json_encode(["status" => false, "msg" => "Error al eliminar proveedor."]);
            }
        } else {
            echo json_encode(["status" => false, "msg" => "ID no recibido."]);
        }
        break;

    default:
        echo json_encode(["status" => false, "msg" => "Acción no válida."]);
        break;


//editar proveedor
case 'editar':  
    if (!empty($_POST['id_persona']) && !empty($_POST['nro_identidad']) && !empty($_POST['razon_social'])) {
        $id_persona   = $_POST['id_persona'];
        $nro_identidad = $_POST['nro_identidad'];
        $razon_social  = $_POST['razon_social'];
        $telefono      = $_POST['telefono'];
        $correo        = $_POST['correo'];
        $departamento  = $_POST['departamento'];
        $provincia     = $_POST['provincia'];
        $distrito      = $_POST['distrito'];
        $cod_postal    = $_POST['cod_postal'];
        $direccion     = $_POST['direccion'];
        $rol           = $_POST['rol'];

        $res = $proveedor->actualizar($id_persona, $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol);

        if ($res) {
            echo json_encode(["status" => true, "msg" => "Proveedor actualizado correctamente."]);
        } else {
            echo json_encode(["status" => false, "msg" => "Error al actualizar proveedor."]);
        }
    } else {
        echo json_encode(["status" => false, "msg" => "Faltan campos obligatorios."]);
    }
    break;
    }