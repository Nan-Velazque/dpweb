<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 w-100">

    <!-- Header pálido -->
    <div class="card-header text-center fs-4 fw-bold"
      style="background: #c9b7ff; color: white;">
      Lista de Clientes
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-hover text-center align-middle">
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

          <tbody id="content_clients">
            <!-- Contenido dinámico -->
          </tbody>

        </table>

      </div>
    </div>

  </div>
</div>

<script src="<?= BASE_URL ?>view/function/clients.js"></script>
<!-- <script>view_users();</script> -->