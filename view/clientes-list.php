<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 w-100">
    <div class="card-header bg-primary text-white text-center fs-4 fw-bold">
      <i class="bi bi-people-fill text-warning me-2"></i> Lista de Clientes
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover text-center align-middle border border-primary">
          <thead class="table-primary">
            <tr>
              <th>Nro</th>
              <th><i class="bi bi-person-vcard text-primary"></i> DNI</th>
              <th><i class="bi bi-person-lines-fill text-success"></i> Nombres y Apellidos</th>
              <th><i class="bi bi-envelope text-warning"></i> Correo</th>
              <th><i class="bi bi-person-gear text-info"></i> Rol</th>
              <th><i class="bi bi-check2-circle text-success"></i> Estado</th>
              <th><i class="bi bi-gear text-danger"></i> Acciones</th>
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
