<div class="container">
    <h5 class="mt-3 mb-3 text-center">Lista de Proveedores</h5>
    <a href="<?= BASE_URL ?>new-proveedores" class="btn btn-primary mb-3">Nuevo Proveedor</a>
    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th>Nro</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="content_proveedores"></tbody>

    </table>
</div>

<script src="<?= BASE_URL ?>view/function/proveedor.js"></script>
<script>view_proveedores();</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Llama a la función para cargar los proveedores cuando el DOM esté completamente cargado
        view_proveedores();
    });
    

</script>
