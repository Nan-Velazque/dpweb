<div class="container mt-4">
  <div class="card shadow-lg border-0 rounded-3">

    <!-- Header pálido -->
    <div class="card-header text-center fw-semibold fs-5" 
         style="background: #c9b7ff; color: white;">
      LISTA DE USUARIOS
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">

        <table class="table table-hover align-middle text-center mb-0">
          <thead>
            <tr>
              <th>N°</th>
              <th>DNI</th>
              <th>Nombres y Apellidos</th>
              <th>Correo</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody id="content_users">
            <!-- Se cargan los usuarios dinámicamente -->
          </tbody>
        </table>

      </div>
    </div>

  </div>
</div>

<script src="<?= BASE_URL ?>view/function/user.js"></script>
