<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nan-Vlzqu3</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <script>
    const base_url = '<?php echo BASE_URL; ?>';
  </script>


</head>
<style>
  body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: linear-gradient(to right, #e2daf0ff);
  }

  /* Navbar estilo femenino pastel */
  .navbar {
    background: #ebd8e8ff !important;
    
  }

  .navbar-brand {
    color: #171718ff !important;
    font-weight: 600;
    font-size: 1.2rem;
  }

  .navbar-nav .nav-link {
    color: #1b1b1bff !important;
    font-weight: 500;
    padding: 10px 14px;
    font-size: 0.95rem;
  }
  
  /* Dropdown pastel */
  .dropdown-menu {
    background: #ffffff;
  }

  .dropdown-item .bi {
    color: #a87bd6 !important;
    margin-right: 6px;
  }

  .dropdown-item.text-danger {
    color: #d96a72 !important;
  }

  .dropdown-item.text-danger:hover {
    background: #ffe6e9;
    color: #c9555f !important;
  }

  /* Ícono usuario */
  .navbar .dropdown-toggle {
    color: #171718ff !important;
    font-weight: 600;
  }

  .navbar-toggler {
    border-color: #141414ff !important;
  }

  .navbar-toggler-icon {
    filter: hue-rotate(45deg) brightness(1.4);
  }
</style>


<body>
  <header>
    <nav class="navbar navbar-expand-lg" data-bs-theme="light">

      <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="bi bi-house-door me-1"></i> LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="new-user">
                <i class="bi bi-house-door"></i> Home
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= BASE_URL ?>users">
                <i class="bi bi-person-square"></i> Users
              </a>
            </li>

            

            <li class="nav-item">
              <a class="nav-link" href="<?= BASE_URL ?>new-producto">
                <i class="bi bi-box-seam"></i> Products
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= BASE_URL ?>new-categoria">
                <i class="bi bi-menu-button-wide-fill"></i> Categories
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= BASE_URL ?>clientes-new">
                <i class="bi bi-people"></i> Clients
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-shop"></i> Shops
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= BASE_URL ?>productos">
                <i class="bi bi-cart3"></i> Sales
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= BASE_URL ?>proveedor-new">
                <i class="bi bi-file-person"></i> Proveedor
              </a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-person-circle me-1"></i> Usuario
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Ajustes</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>