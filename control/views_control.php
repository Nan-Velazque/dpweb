<?php
// Incluye el archivo del modelo que contiene la lógica para obtener las vistas
require_once "./model/view_model.php";
// Define la clase 'viewsControl' 
class viewsControl extends viewModel
{
    public function getPlantillaControl() // Método que carga la plantilla principal del sistema 
    {
        return require_once "./view/plantilla.php";
    }
    // Método que determina qué vista mostrar según la sesión y la URL
    public function getViewControl()
    {
        // Inicia la sesión para acceder a variables de sesión
        session_start();
        // Inicia la sesión para acceder a variables de sesión
        if (isset($_SESSION['ventas_id'])) {

            // Verifica si hay un parámetro GET llamado "views"
            if (isset($_GET["views"])) {
                $ruta = explode("/", $_GET["views"]);
                $response = viewModel::get_view($ruta[0]);
            } else {
                $response = "index.php";
            }
        } else {
            $response = "login";// Si no hay sesión iniciada, se redirige al login
        }
        return  $response;// Retorna el nombre del archivo que se debe cargar como vista
    }
}
