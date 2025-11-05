<?php
require_once("../model/usuarioModel.php");

// Mostrar errores PHP (útil para depuración)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$objUsuario = new UsuarioModel();
$tipo = $_GET['tipo'] ?? '';

switch ($tipo) {

    // 🔹 REGISTRAR USUARIO
    case 'registrar':
        $nro_identidad = $_POST['nro_identidad'] ?? '';
        $razon_social  = $_POST['razon_social'] ?? '';
        $telefono      = $_POST['telefono'] ?? '';
        $correo        = $_POST['correo'] ?? '';
        $departamento  = $_POST['departamento'] ?? '';
        $provincia     = $_POST['provincia'] ?? '';
        $distrito      = $_POST['distrito'] ?? '';
        $cod_postal    = $_POST['cod_postal'] ?? '';
        $direccion     = $_POST['direccion'] ?? '';
        $rol           = $_POST['rol'] ?? '';

        if (
            $nro_identidad == '' || $razon_social == '' || $telefono == '' || $correo == '' ||
            $departamento == '' || $provincia == '' || $distrito == '' || $cod_postal == '' ||
            $direccion == '' || $rol == ''
        ) {
            echo json_encode(['status' => false, 'msg' => 'Error, campos vacíos']);
            exit;
        }

        if ($objUsuario->existePersona($nro_identidad) > 0) {
            echo json_encode(['status' => false, 'msg' => 'Error, nro de documento ya existe']);
            exit;
        }

        $password = password_hash($nro_identidad, PASSWORD_DEFAULT);
        $registrado = $objUsuario->registrar($nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $password);

        echo json_encode($registrado ?
            ['status' => true, 'msg' => 'Registrado Correctamente'] :
            ['status' => false, 'msg' => 'Error, fallo en registro']
        );
        exit;

    // 🔹 INICIAR SESIÓN
    case 'iniciar_sesion':
        $nro_identidad = $_POST['username'] ?? '';
        $password      = $_POST['password'] ?? '';

        if ($nro_identidad == '' || $password == '') {
            echo json_encode(['status' => false, 'msg' => 'Error, campos vacíos']);
            exit;
        }

        $persona = $objUsuario->buscarPersonaPorNroIdentidad($nro_identidad);

        if (!$persona) {
            echo json_encode(['status' => false, 'msg' => 'Error, usuario no registrado']);
            exit;
        }

        // Verificamos según el tipo de dato devuelto
        $hash = is_array($persona) ? $persona['password'] : $persona->password;

        if (password_verify($password, $hash)) {
            session_start();
            $_SESSION['ventas_id'] = is_array($persona) ? $persona['id'] : $persona->id;
            $_SESSION['ventas_usuario'] = is_array($persona) ? $persona['razon_social'] : $persona->razon_social;
            echo json_encode(['status' => true, 'msg' => 'Ingresar al sistema']);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Error, contraseña incorrecta']);
        }
        exit;

    // 🔹 VER USUARIOS
    case 'ver_usuarios':
        $usuarios = $objUsuario->verUsuario();
        echo json_encode($usuarios);
        exit;

    // 🔹 VER USUARIO POR ID
    case 'ver':
        $id_persona = $_POST['id_persona'] ?? '';
        $usuario = $objUsuario->ver($id_persona);
        echo json_encode($usuario ?
            ['status' => true, 'data' => $usuario] :
            ['status' => false, 'msg' => 'Error, usuario no existe']
        );
        exit;

    // 🔹 ACTUALIZAR USUARIO
    case 'actualizar':
        $id_persona = $_POST['id_persona'] ?? '';
        $nro_identidad = $_POST['nro_identidad'] ?? '';
        $razon_social  = $_POST['razon_social'] ?? '';
        $telefono      = $_POST['telefono'] ?? '';
        $correo        = $_POST['correo'] ?? '';
        $departamento  = $_POST['departamento'] ?? '';
        $provincia     = $_POST['provincia'] ?? '';
        $distrito      = $_POST['distrito'] ?? '';
        $cod_postal    = $_POST['cod_postal'] ?? '';
        $direccion     = $_POST['direccion'] ?? '';
        $rol           = $_POST['rol'] ?? '';

        if (
            $id_persona == '' || $nro_identidad == '' || $razon_social == '' || $telefono == '' || $correo == '' ||
            $departamento == '' || $provincia == '' || $distrito == '' || $cod_postal == '' || $direccion == '' || $rol == ''
        ) {
            echo json_encode(['status' => false, 'msg' => 'Error, campos vacíos']);
            exit;
        }

        $existeID = $objUsuario->ver($id_persona);
        if (!$existeID) {
            echo json_encode(['status' => false, 'msg' => 'Error, usuario no existe en BD']);
            exit;
        }

        $actualizado = $objUsuario->actualizar($id_persona, $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol);
        echo json_encode($actualizado ?
            ['status' => true, 'msg' => 'Actualizado correctamente'] :
            ['status' => false, 'msg' => 'Error al actualizar']
        );
        exit;

    // 🔹 VER PROVEEDORES
    case 'ver_proveedores':
        $proveedores = $objUsuario->verProveedores();
        echo json_encode([
            'status' => count($proveedores) > 0,
            'data' => $proveedores
        ]);
        exit;

    // 🔹 VER CLIENTES
    case 'ver_clients':
        $clientes = $objUsuario->verUsuario();
        echo json_encode([
            'status' => count($clientes) > 0,
            'data' => $clientes
        ]);
        exit;

    default:
        echo json_encode(['status' => false, 'msg' => 'Tipo de operación no válida']);
        exit;
}
