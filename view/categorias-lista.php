<div class="container mt-5" style="max-width: 900px;">
  <div class="card shadow-lg border-0 rounded-4">

    <!-- Header pálido -->
    <div class="card-header text-center fw-bold fs-4" 
         style="background: #c9b7ff; color: white;">
      Lista de Categorías
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-hover align-middle text-center">
          <thead>
            <tr>
              <th>Nro</th>
              <th>Nombre</th>
              <th>Detalle</th>
              <th>Acciones</th>
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

<script src="<?php echo BASE_URL; ?>view/function/categoria.js"></script>
