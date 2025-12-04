<!-- inicio de cuerpo de pagina -->
<div class="container mt-5" style="max-width: 900px;">
  <div class="card shadow-lg border-3 border-primary rounded-4">
    <div class="card-header bg-primary text-white text-center fw-bold fs-4">
      <i class="bi bi-tags-fill me-2"></i> Lista de Categorías
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle text-center">
          <thead class="table-primary">
            <tr>
              <th scope="col">Nro</th>
              <th scope="col">Nombre</th>
              <th scope="col">Detalle</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody id="content_categorias">
            <!-- Contenido dinámico -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- fin de cuerpo de pagina -->

<script src="<?php echo BASE_URL; ?>view/function/categoria.js"></script>
