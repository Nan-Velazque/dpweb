<div class="container mt-4">
    <div class="d-flex justify-content-between text-center p-3 mb-3 rounded shadow" style="background: linear-gradient(90deg, #f0e8e8ff, #dacaf4ff);">
        <h1 class="text-black fw-bold m-0" style="font-family: 'Arial'; font-size: 1rem;"> Productos Registrados</h1>
        <a href="<?php echo BASE_URL; ?>new-products" class="btn btn-outline-light fw-bold">+ </a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Fecha Venc.</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="content_products">
            <!-- Aquí se cargan los productos dinámicamente -->
        </tbody>
    </table>
</div>
<script src="<?php echo BASE_URL; ?>view/function/Products.js"></script>
