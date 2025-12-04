<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 w-100">
    <div class="card-header bg-primary text-white text-center fs-4 fw-bold">
      <i class="bi bi-truck text-warning me-2"></i> Lista de Proveedores
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover text-center align-middle border border-primary">
          <thead class="table-primary">
            <tr>
              <th><i class="bi bi-hash text-secondary"></i> Nro</th>
              <th><i class="bi bi-credit-card text-success"></i> DNI</th>
              <th><i class="bi bi-person-badge text-info"></i> Nombres y Apellidos</th>
              <th><i class="bi bi-envelope text-warning"></i> Correo</th>
              <th><i class="bi bi-person-gear text-danger"></i> Rol</th>
              <th><i class="bi bi-toggle-on text-success"></i> Estado</th>
              <th><i class="bi bi-gear text-dark"></i> Acciones</th>
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
