 <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 w-75">
        <div class="card-header text-white text-center fs-4 fw-bold"
        style="background-color: #E6D1F2; color: #4B2E83;">
      Editar Usuario
      <?php
      if (isset($_GET["views"])) {
        $ruta = explode("/", $_GET["views"]);
        echo " #" . $ruta[1];
      }
      ?>
    </div>

    <form id="frm_edit_user" action="" method="">
      <input type="hidden" name="id_persona" id="id_persona" value="<?= $ruta[1]; ?>">

      <div class="card-body">

        <div class="mb-3 row">
          <label for="nro_identidad" class="col-sm-3 col-form-label ">
            N° Documento
          </label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="nro_identidad" name="nro_identidad" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="razon_social" class="col-sm-3 col-form-label ">
            Nombre/Razón Social
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="razon_social" name="razon_social" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="telefono" class="col-sm-3 col-form-label ">
            Teléfono
          </label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="telefono" name="telefono" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="correo" class="col-sm-3 col-form-label ">
            Correo
          </label>
          <div class="col-sm-9">
            <input type="email" class="form-control" id="correo" name="correo" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="departamento" class="col-sm-3 col-form-label ">
            Departamento
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="departamento" name="departamento" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="provincia" class="col-sm-3 col-form-label ">
            Provincia
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="provincia" name="provincia" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="distrito" class="col-sm-3 col-form-label ">
            Distrito
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="distrito" name="distrito" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="cod_postal" class="col-sm-3 col-form-label ">
            Código Postal
          </label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="cod_postal" name="cod_postal" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="direccion" class="col-sm-3 col-form-label ">
            Dirección
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="direccion" name="direccion" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="rol" class="col-sm-3 col-form-label ">
            Rol
          </label>
          <div class="col-sm-9">
            <select class="form-select" id="rol" name="rol" required>
              <option value="" disabled selected>Seleccione</option>
              <option value="admin">Administrador</option>
              <option value="user">Usuario</option>
              <option value="proveedor">Proveedor</option>
            </select>
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary me-2">
            Actualizar
          </button>
          <a href="<?php echo BASE_URL; ?>users" class="btn btn-danger me-2">
            Cancelar
          </a>
        </div>

      </div>
    </form>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/user.js"></script>
<script>
  edit_user();
</script>