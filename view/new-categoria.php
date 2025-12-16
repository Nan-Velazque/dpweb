<!-- inicio de cuerpo de pagina -->
<div class="container mt-5" style="max-width: 700px;">
  <div class="card shadow-lg border-3  rounded-4">
  <div class="card-header text-center fs-4 fw-bold"
            style="background: #ebd7e1ff; color: #5e3b5e;">
            Nueva Categoría
        </div>

    <form id="frm_categorie" action="" method="">
      <div class="card-body">
        <div class="mb-3 row align-items-center">
          <label for="nombre" class="col-sm-3 col-form-label fw-semibold">Nombre:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre de la categoría" required
            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
          </div>
        </div>

        <div class="mb-3 row align-items-center">
          <label for="detalle" class="col-sm-3 col-form-label fw-semibold">Detalle:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Ingrese detalle o descripción" required>
          </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
          <button type="submit" class="btn btn-primary">
           Registrar
          </button>
          <button type="reset" class="btn btn-info text-white">
             Limpiar
          </button>
          <button type="button" class="btn btn-danger">
           Cancelar
          </button>
          <a href="<?php echo BASE_URL; ?>categorias-lista" class="btn btn-success">
            Ver
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- fin de cuerpo de pagina -->

<script src="<?php echo BASE_URL; ?>view/function/categoria.js"></script>
