<div class="container mt-4">
    <div class="d-flex justify-content-between text-center p-3 mb-3 rounded shadow" style="background: linear-gradient(90deg, #f0e8e8ff, #dacaf4ff);">
        <h1 class="text-black fw-bold m-0" style="font-family: 'Arial'; font-size: 1rem;"> Categorías Registradas</h1>
        <a href="<?php echo BASE_URL; ?>new-categories" class="btn btn-outline-light fw-bold">
            
        </a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="content_categories">
            <!-- Aquí se cargan las categorías dinámicamente -->
        </tbody>
    </table>
</div>

<!-- Script para manejar las categorías -->
<script src="<?php echo BASE_URL; ?>view/function/Categories.js"></script>
