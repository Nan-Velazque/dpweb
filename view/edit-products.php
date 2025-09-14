<div id="form-control">
    <form action="" id="formUpdateProducto">
        <center><h3><b>Editar datos de producto</b></h3></center>
        <input type="hidden" name="id_producto" id="id_producto">
        <input type="hidden" name="img" id="img">
    <div class="mb-3">
        <label for="codigo" class="form-label">Código: </label>
        <input type="text" class="form-control" id="codigo" placeholder="Código de producto*" name="codigo" disabled>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre: </label>
        <input type="text" class="form-control" id="nombre" placeholder="Nombre de producto*" name="nombre">
    </div>

    <div class="mb-3">
        <label for="detalle" class="form-label">Detalle: </label>
        <input type="text" class="form-control" id="detalle" placeholder="Detalles del producto*" name="detalle">
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio: </label>
        <input type="number" class="form-control" id="precio" min="1" max="90000" step="0.10" placeholder="Precio*" name="precio">
    </div>
    
    <div class="mb-3">
        <label for="idCategoria" class="form-label">Categoria: </label>
        <select class="form-control" name="idCategoria" id="idCategoria" required>
        <option disabled>Seleccione</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="imagen1" class="form-label">Imagen de producto 1: </label>
        <input type="file" class="form-control" id="imagen1" name="imagen1">
    </div>

    <div class="mb-3">
        <label for="idProveedor" class="form-label">Proveedor: </label>
        <select class="form-control" name="idProveedor" id="idProveedor" required>
        <option disabled>Seleccione</option>
        </select>
    </div>
    <center>
        <button type="button" onclick="actualizar_producto()" class="btn btn-danger">Actualizar</button>
        <a href="<?php echo BASE_URL; ?>/view-producto-admin" type="reset" class="btn btn-dark">Cancelar</a>
    </center>
    </form>
</div>

<script>listar_categorias();</script>
<script>listar_proveedores();</script>
<script>
    const id_p = <?php
                    $pagina = explode("/", $_GET['views']);
                    echo $pagina['1'];
                 ?>;
    ver_producto(id_p);
</script>
