<div id="form-control">
    <form action="" id="formUpdateCategoria">
        <center><h3><b>Formulario de registro de categoria</b></h3></center>
        <input type="hidden" class="form-control" id="id_categoria" name="id_categoria" required>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de categoria: </label>
        <input type="text" class="form-control" id="nombre" placeholder="Nombre*" name="nombre">
    </div>

    <div class="mb-3">
        <label for="detalle" class="form-label">Detalle de la categoria: </label>
        <input type="text" class="form-control" id="detalle" placeholder="Detalles*" name="detalle">
    </div>
    <center>
        <button type="button" onclick="actualizar_categoria()" class="btn btn-danger">Actualizar</button>
        <a href="<?php echo BASE_URL; ?>/view-categoria-admin" type="reset" class="btn btn-dark">Cancelar</a>
    </center>
    </form>
</div>
<script>listar_categorias_admin();</script>
<script>
    const id_cat = <?php $pagina = explode("/", $_GET['views']);
                    echo $pagina['1'];
                    ?>;
    ver_categoria(id_cat);
</script>
