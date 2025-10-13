<div class="container">
    <h5 class="mt-3 mb-3 text-center">Lista de Clientes</h5>
    <a href="<?= BASE_URL ?>new-clients" class="btn btn-primary mb-3">Nuevo Cliente</a>
    <table class="table table table-striped-columns">
        <thead>
            <tr>
                <th>Nro</th>
                <th>DNI</th>
                <th>Nombres y Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="content_clients">

        </tbody>
    </table>
</div>
<script src="<?= BASE_URL ?>view/function/user.js"></script>
<!--<script>view_clients();</script>-->
