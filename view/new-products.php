<div class="container mt-4">
    <div class="card">
        <h5 class="card-header">Registrar Nuevo Producto</h5>
        <form id="frm_products" action="" method="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="codigo" class="col-sm-4 col-form-label">Código:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nombre" class="col-sm-4 col-form-label">Nombre:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="detalle" class="col-sm-4 col-form-label">Detalle:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="detalle" name="detalle" placeholder="Detalle del producto" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="precio" class="col-sm-4 col-form-label">Precio:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="stock" class="col-sm-4 col-form-label">Stock:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock disponible" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="id_categoria" class="col-sm-4 col-form-label">Categoría:</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="id_categoria" name="id_categoria" required>
                            <option value="">Seleccione una categoría</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="fecha_vencimiento" class="col-sm-4 col-form-label">Fecha de Vencimiento:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                    </div>
                    <div class="mb-3 row">
                        <label for="imagen" class="col-sm-4 col-form-label">imagen:</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="imagen" name="imagen" accept=".jpg, .jpeg, .png" placeholder="imagen" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="id_persona" class="col-sm-4 col-form-label">proveedor:</label>
                        <div class="col-sm-8">
                            <select class="form-control" aria-label="default select example" id="id_persona" name="id_persona" required>
                                <option value="">Seleccione un proveedor</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div style="display: flex;justify-content: center; gap: 20px;">
        <button type="submit" class="btn btn-success">Registrar</button>
        <button type="reset" class="btn btn-info">Limpiar</button>
        <a href="<?php echo BASE_URL; ?>products" class="btn btn-danger">Cancelar</a>
    </div>
    </form>
</div>
</div>
<script src="<?php echo BASE_URL; ?>view/function/products.js"></script>
<script>
    cargar_categorias();
    cargarProveedores();
</script>