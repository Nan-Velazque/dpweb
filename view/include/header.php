<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Huber Araujo</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <script>
    const base_url = '<?php echo BASE_URL; ?>';
  </script>

  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background: linear-gradient(to right, #4c4ae2ff, #cf13feff);
    }


    /* Estilo de barra de navegación */
    .navbar {
      background-color: #0d6efd !important;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: 600;
    }

    .navbar-nav .nav-link {
      color: #fff !important;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 12px;
      transition: background-color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.15);
      border-radius: 6px;
    }

    .navbar .bi {
      color: #fff;
      font-size: 1rem;
    }

    .dropdown-menu {
      border: none;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item:hover {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
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
              <a class="nav-link" href="<?= BASE_URL ?>productos">
                <i class="bi bi-box-seam"></i> View-Client
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
              <a class="nav-link" href="#">
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