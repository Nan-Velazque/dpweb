<div class="container mt-5">
  <div class="card shadow-lg border-0">
    <div class="card-header text-center fs-5 fw-bold">
      Lista de Productos
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center table-bordered">
          <thead class="table-primary">
            <tr>
              <th>Nro</th>
              <th>Código</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Categoría</th>
              <th>Proveedor</th>
              <th>Vencimiento</th>
              <th>Código Barra</th>
              <th>Acciones</th>
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
