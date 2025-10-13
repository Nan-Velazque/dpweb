<?php
require_once("../model/UsuarioModel.php");

$objPersona = new UsuarioModel();

$tipo = $_GET['tipo'];

if ($tipo == 'registrar') {
   // print_r ($_POST);
   $nro_identidad = $_POST['nro_identidad'];
   $razon_social = $_POST['razon_social'];
   $telefono = $_POST['telefono'];
   $correo = $_POST['correo'];
   $departamento = $_POST['departamento'];
   $provincia = $_POST['provincia'];
   $distrito = $_POST['distrito'];
   $cod_postal = $_POST['cod_postal'];
   $direccion = $_POST['direccion'];
   $rol = $_POST['rol'];
   //ENCRIPTANDO DNI nro_identidad PARA UTILIZARLO COMO CONTRASEÑA
   $password = password_hash($nro_identidad, PASSWORD_DEFAULT);

   if ($nro_identidad == "" || $razon_social == "" || $telefono == "" || $correo == "" || $departamento == "" || $provincia == "" || $distrito == "" || $cod_postal == "" || $direccion == "" || $rol == "") {
      $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
   } else {
      //validacion si existe la misma persona con el mismo dni
      $existePersona = $objPersona->existePersona($nro_identidad);
      if ($existePersona > 0) {
         $arrResponse = array('status' => false, 'msg' => 'Error, nro de documento ya existe');
      } else {

         $respuesta = $objPersona->registrar($nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $password);
         if ($respuesta) {
            // Registro exitoso
            $arrResponse = array('status' => true, 'msg' => 'Registrado Correctamente');
         } else {
            // Error al registrar
            $arrResponse = array('status' => false, 'msg' => 'Error, fallo en registro');
         }
      }
   }
   echo json_encode($arrResponse); // Devuelve la respuesta en formato JSON
}
// Si se solicita iniciar sesión
if ($tipo == "iniciar_sesion") {
   // Captura los datos del formulario
   $nro_identidad = $_POST['username'];
   $password = $_POST['password'];
   if ($nro_identidad == "" || $password == "") { // Verifica si hay campos vacíos
      $respuesta = array('status' => false, 'msg' => 'Error, campos vacios');
   } else {
      // Verifica si el usuario existe en la base de datos
      $existePersona = $objPersona->existePersona($nro_identidad);
      if (!$existePersona) {

         // Usuario no encontrado
         $respuesta = array('status' => false, 'msg' => 'Error, usuario no registrado');
      } else {
         // Obtiene los datos del usuario
         $persona = $objPersona->buscarPersonaPorNroIdentidad($nro_identidad);
         //print_r($persona);
         ($nro_identidad);
         // Verifica si la contraseña es correcta
         if (password_verify($password, $persona->password)) {
            session_start();
            // Inicia sesión y guarda variables en $_SESSION
            $_SESSION['ventas_id'] = $persona->id;
            $_SESSION['ventas_usuario'] = $persona->razon_social;

            $respuesta = array('status' => true, 'msg' => 'Ingresar al sistema');
         } else {
            // Contraseña incorrecta
            $respuesta = array('status' => false, 'msg' => 'Error,contraseña incorrecto');
         }
      }
   }
   echo json_encode($respuesta); // Devuelve respuesta JSON
}

if ($tipo == "ver_usuarios") {
   $consulta = "SELECT * FROM persona WHERE NOT rol = 'Proveedor' AND NOT rol = 'Cliente'";
   $usuarios = $objPersona->verUsuario();
   header('Content-Type: application/json');
   echo json_encode($usuarios);
}

if ($tipo == "ver") {
   //print_r($_POST);
   $respuesta = array('status' => false, 'msg' => 'Error');
   $id_persona = $_POST['id_persona'];
   $usuario = $objPersona->ver($id_persona);
   if ($usuario) {
      $respuesta['status'] = true;
      $respuesta['data'] = $usuario;
   } else {
      $respuesta['msg'] = 'Error , usuario no existe';
   }
   echo json_encode($respuesta);
}
if ($tipo == "actualizar") {
   //print_r($_POST);
   $id_persona = $_POST['id_persona'];
   $nro_identidad = $_POST['nro_identidad'];
   $razon_social = $_POST['razon_social'];
   $telefono = $_POST['telefono'];
   $correo = $_POST['correo'];
   $departamento = $_POST['departamento'];
   $provincia = $_POST['provincia'];
   $distrito = $_POST['distrito'];
   $cod_postal = $_POST['cod_postal'];
   $direccion = $_POST['direccion'];
   $rol = $_POST['rol'];
   if ($id_persona == "" || $nro_identidad == "" || $razon_social == "" || $telefono == "" || $correo == "" || $departamento == "" || $provincia == "" || $distrito == "" || $cod_postal == "" || $direccion == "" || $rol == "") {
      $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
   } else {
      $existeID  = $objPersona->ver($id_persona);
      if (!$existeID) {
         //devolver mensaje
         $arrResponse = array('status' => false, 'msg' => 'Error, usuario no existe en BD');
         echo json_encode($arrResponse);
         //Cerrar funcion
         exit;
      } else {
         //actualizar
         $actualizar = $objPersona->actualizar($id_persona, $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol);
         if ($actualizar) {
            $arrResponse = array('status' => true, 'msg' => "Actualizado correctamente");
         } else {
            $arrResponse = array('status' => true, 'msg' => $actualizar);
         }
         echo json_encode($arrResponse);
         exit;
      }

      //eliminar 

   }
}
// cargar proveedor
$tipo = $_GET['tipo'] ?? '';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$objUsuario = new UsuarioModel();

if ($tipo == "ver_proveedores") {
   $proveedores = $objUsuario->verProveedores();
   $respuesta = ['status' => false, 'data' => []];
   if (count($proveedores) > 0) $respuesta = ['status' => true, 'data' => $proveedores];
   header('Content-Type: application/json');
   echo json_encode($respuesta);
   exit;
}



if ($tipo == "ver_clients") {
   $clientes = $objUsuario->ver_client();
   $respuesta = ['status' => false, 'data' => []];
   if (count($clientes) > 0) $respuesta = ['status' => true, 'data' => $clientes];
   header('Content-Type: application/json');
   echo json_encode($respuesta);
   exit;
}

  