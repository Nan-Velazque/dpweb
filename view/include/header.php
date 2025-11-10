<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>velazque</title>
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
</head>



<nav class="navbar navbar-expand-lg info" style="background-color: plum;">
    <div class="container-fluid">
        <!-- hace visible y funcional el carrito de Bootstrap Icons dentro de tu barra de navegación -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="bi bi-cart-fill me-2"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>users ">users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;  ?>products ">products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;  ?>categories ">categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;  ?>clients ">clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;  ?>proveedores">proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">shops</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;  ?>libros">libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">save</a>
            </ul>
            <form class="d-flex" role="search">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</nav>