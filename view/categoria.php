<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nan_Velazque</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css">
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
</head>

<body>

    </nav>
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"> Registro de Categoria</h5>
            <form id="frm_categoria" action="" method="">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="nombre" class="col-sm-4 col-form-label">nombre:</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-nombre" id="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="detalle" class="col-sm-4 col-form-label">detalle:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-detalle" id="detalle" name="detalle" required>
                        </div>
                    </div>




                    <button type="submint" class="btn btn-info">Registrar</button>
                    <button type="reset" class="btn btn-danger">Limpiar</button>
                    <button type="button" class="btn btn-success">Cancelar</button>

                </div>
            </form>
        </div>
    </div>
    <script src="<?php echo BASE_URL; ?>view/function/categoria.js"></script>
    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.js"></script>

</html>