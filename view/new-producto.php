<!-- inicio de cuerpo de pagina -->
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 w-75">
    <div class="card-header bg-primary text-white text-center fs-4 fw-bold">
      <i class="bi bi-box-seam me-2"></i> Registrar Producto
    </div>

    <form id="frm_product" action="" method="" enctype="multipart/form-data">
      <div class="card-body">

        <div class="mb-3 row">
          <label for="codigo" class="col-sm-2 col-form-label ">
            <i class="bi bi-tag "></i> Código
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="codigo" name="codigo" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="nombre" class="col-sm-2 col-form-label ">
            <i class=" bi bi-bag"></i> Nombre
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="detalle" class="col-sm-2 col-form-label ">
            <i class="bi bi-card-text"></i> Detalle
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="detalle" name="detalle" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="precio" class="col-sm-2 col-form-label ">
            <i class="bi bi-cash-coin"></i> Precio
          </label>
          <div class="col-sm-10">
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="stock" class="col-sm-2 col-form-label ">
            <i class="bi bi-stack"></i> Stock
          </label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="stock" name="stock" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="id_categoria" class="col-sm-2 col-form-label ">
            <i class="bi bi-list"></i> Categoría
          </label>
          <div class="col-sm-10">
            <select class="form-select" id="id_categoria" name="id_categoria" required>
              <option value="">Seleccione una categoría</option>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="fecha_vencimiento" class="col-sm-2 col-form-label ">
            <i class="bi bi-calendar-event"></i> Vencimiento
          </label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="imagen" class="col-sm-2 col-form-label ">
            <i class="bi bi-image"></i> Imagen
          </label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/png.jpg.jpeg">
          </div>
        </div>

        <div class="mb-3 row">
          <label for="id_proveedor" class="col-sm-2 col-form-label ">
            <i class="bi bi-truck"></i> Proveedor
          </label>
          <div class="col-sm-10">
            <select class="form-select" id="id_proveedor" name="id_proveedor" required>
              <option value="">Seleccione un proveedor</option>
            </select>
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary me-2">
            <i class="bi bi-save"></i> Registrar
          </button>
          <button type="reset" class="btn btn-info text-white me-2">
            <i class="bi bi-eraser"></i> Limpiar
          </button>
          <button type="button" class="btn btn-danger me-2">
            <i class="bi bi-x-circle"></i> Cancelar
          </button>
          <a href="<?php echo BASE_URL; ?>productos-lista" class="btn btn-success">
            <i class="bi bi-eye"></i> Ver
          </a>
        </div>

      </div>
    </form>
  </div>
</div>
<!-- fin de cuerpo de pagina -->

<script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    cargar_categorias();
    cargar_proveedores();
  });
</script>
