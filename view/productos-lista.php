<div class="container mt-5">
  <div class="card shadow-lg border-0">

    <!-- Header pálido -->
    <div class="card-header text-center fs-5 fw-bold"
      style="background: #c9b7ff; color: white;">
      Lista de Productos
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-hover align-middle text-center"
          style="border: none !important;">

          <thead style="background:#e6dcff; color:#5e4a80;">
            <tr>
              <th style="border:none;">Nro</th>
              <th style="border:none;">Código</th>
              <th style="border:none;">Nombre</th>
              <th style="border:none;">Precio</th>
              <th style="border:none;">Stock</th>
              <th style="border:none;">Categoría</th>
              <th style="border:none;">Proveedor</th>
              <th style="border:none;">Vencimiento</th>
              <th style="border:none;">Código Barra</th>
              <th style="border:none;">Acciones</th>
            </tr>
          </thead>

          <tbody id="content_productos">
            <!-- Filas dinámicas generadas con JavaScript -->
          </tbody>

        </table>

      </div>
    </div>

  </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
<script src="<?php echo BASE_URL; ?>view/function/JsBarcode.all.min.js"></script>