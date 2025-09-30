
<!-- Cuerpo de la pagina-->
    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header">Registrar Nueva Categoría</h5>
            <form id="frm_category" action="" method="">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="nombre" class="col-sm-4 col-form-label">Nombre de Categoría:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="detalle" class="col-sm-4 col-form-label">Detalle:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="detalle" name="detalle" placeholder="Detalle de la categoría" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar</button>
                    <button type="reset" class="btn btn-info">Limpiar</button>
                    <a href="<?php echo BASE_URL; ?>categories" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
<!-- Fin de cuerpo de la pagina-->
<script src="<?php echo BASE_URL; ?>view/function/Categories.js"></script>