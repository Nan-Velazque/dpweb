<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 w-100">

    <!-- Header pálido -->
    <div class="card-header text-white text-center fs-4 fw-bold"
      style="background: #c9b7ff;">
      Lista de Proveedores
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-striped table-hover text-center align-middle">

          <thead>
            <tr>
              <th>Nro</th>
              <th>DNI</th>
              <th>Nombres y Apellidos</th>
              <th>Correo</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody id="content_proveedor">
            <!-- Filas dinámicas generadas con JavaScript -->
          </tbody>

        </table>

      </div>
    </div>

  </div>
</div>

<script src="<?= BASE_URL ?>view/function/proveedor.js"></script>