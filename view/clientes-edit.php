<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 w-75">
        <div class="card-header bg-primary text-white text-center fs-4 fw-bold">
            <i class="bi bi-person-plus-fill text-warning me-2"></i> Editar Cliente
            <?php
            if (isset($_GET["views"])) {
                $ruta = explode("/", $_GET["views"]);
                echo $ruta[1];
            }
            ?>

        </div>

        <form id="frm_edit_user" action="" method="">
            <input type="hidden" name="id_persona" id="id_persona" value="<?= $ruta[1]; ?>">

            <div class="card-body">

                <div class="mb-3 row">
                    <label for="nro_identidad" class="col-sm-3 col-form-label ">
                        <i class="bi bi-credit-card text-primary"></i> N° Documento
                    </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="nro_identidad" name="nro_identidad" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="razon_social" class="col-sm-3 col-form-label ">
                        <i class="bi bi-person-badge text-success"></i> Nombre/Razón Social
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="razon_social" name="razon_social" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="telefono" class="col-sm-3 col-form-label ">
                        <i class="bi bi-telephone text-info"></i> Teléfono
                    </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="telefono" name="telefono" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="correo" class="col-sm-3 col-form-label ">
                        <i class="bi bi-envelope text-warning"></i> Correo
                    </label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="departamento" class="col-sm-3 col-form-label ">
                        <i class="bi bi-geo-alt text-danger"></i> Departamento
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="departamento" name="departamento" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="provincia" class="col-sm-3 col-form-label ">
                        <i class="bi bi-map text-success"></i> Provincia
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="provincia" name="provincia" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="distrito" class="col-sm-3 col-form-label ">
                        <i class="bi bi-geo text-primary"></i> Distrito
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="distrito" name="distrito" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="cod_postal" class="col-sm-3 col-form-label ">
                        <i class="bi bi-signpost text-warning"></i> Código Postal
                    </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="cod_postal" name="cod_postal" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="direccion" class="col-sm-3 col-form-label ">
                        <i class="bi bi-house-door text-info"></i> Dirección
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="rol" class="col-sm-3 col-form-label ">
                        <i class="bi bi-person-gear text-danger"></i> Rol
                    </label>
                    <div class="col-sm-9">
                        <select class="form-select" aria-label="Default select example" id="rol" name="rol">
                            <option value="administrador" selected>Administrador</option>
                            <option value="proveedor" selected>Proveedor</option>
                            <option value="cliente" selected>Cliente</option>
                            <option value="almacen" selected>Almacen</option>
                            <option value="usuario" selected>Usuario</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content:center; gap:20px">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="<?php echo BASE_URL; ?>clientes-list" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/user.js"></script>
<script>
    edit_user();
</script>



<!--<div class="container" style="margin-top: 100px;">
    <div class="card">
        <div class="card-header" style="text-align:center;">
            Editar Cliente
            <?php
            if (isset($_GET["views"])) {
                $ruta = explode("/", $_GET["views"]);
                echo $ruta[1];
            }
            ?>
        </div>
        <form id="frm_edit_user" action="" method="">
            <input type="hidden" name="id_persona" id="id_persona" value="<?= $ruta[1]; ?>">
            <div class="card-body">

                <div class="mb-3 row">
                    <label for="nro_identidad" class="col-sm-2 col-form-label">Nro de Documento</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nro_identidad" name="nro_identidad" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="razon_social" class="col-sm-2 col-form-label">Nombre/Razon Social</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="razon_social" name="razon_social" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="telefono" name="telefono" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="departamento" class="col-sm-2 col-form-label">Departamento</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="departamento" name="departamento" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="provincia" class="col-sm-2 col-form-label">Provincia</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="provincia" name="provincia" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="distrito" class="col-sm-2 col-form-label">Distrito</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="distrito" name="distrito" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="cod_postal" class="col-sm-2 col-form-label">Codigo Postal</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="cod_postal" name="cod_postal" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="rol" name="rol">
                            <option value="cliente">Cliente</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content:center; gap:20px">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="<?php echo BASE_URL; ?>clientes-list" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/user.js"></script>
<script>
    edit_user();
</script> -->