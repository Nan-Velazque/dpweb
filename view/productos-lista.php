<div class="container mt-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white text-center fs-5 fw-bold">
      <i class="bi bi-box-seam text-warning me-2"></i> Lista de Productos
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center table-bordered">
          <thead class="table-primary">
            <tr>
              <th><i class="bi bi-hash"></i> Nro</th>
              <th><i class="bi bi-tag "></i> Código</th>
              <th><i class="bi bi-bag"></i> Nombre</th>
              <th><i class="bi bi-cash-coin"></i> Precio</th>
              <th><i class="bi bi-box2"></i> Stock</th>
              <th><i class="bi bi-tags"></i> Categoría</th>
              <th><i class="bi bi-truck"></i> Proveedor</th>
              <th><i class="bi bi-calendar-date"></i> Vencimiento</th>
              <th><i class="bi bi-upc-scan"></i> Código Barra</th>
              <th><i class="bi bi-gear"></i> Acciones</th>
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

