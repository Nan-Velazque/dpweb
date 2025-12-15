<?php
$base = defined('BASE_URL') ? BASE_URL : '/';
?>

<div class="container py-3">
    <div class="row">

        <!-- Columna izquierda: Buscador + Productos -->
        <div class="col-md-8">
            <div class="border rounded p-3" style="border-width: 2px !important;">

                <!-- Buscador -->
                <div class="row mb-3">
                    <div class="col-12">
                        <input onkeyup="ListaProductosParaVenta();"
                            type="text" id="busqueda_venta" class="form-control" placeholder=" Buscar producto por  nombre o código .....">
                        <input type="hidden" id="id_producto_venta">
                        <input type="hidden" id="producto_precio_venta">
                        <input type="hidden" id="producto_cantidad_venta" value="1">
                    </div>
                </div>

                <!-- Productos -->
                <div class="row g-2" id="productos_venta">
                    <!-- Ejemplo de producto -->
                    <div class="col-md-4">
                        <div class="card p-2 border rounded shadow-sm">
                            <div class="border rounded p-2 bg-light d-flex justify-content-center">
                                <img src="https://images.unsplash.com/photo-1606813909135-0e36269c67be?auto=format&fit=crop&w=400&q=80"
                                    alt="Producto ejemplo" class="img-fluid rounded">
                            </div>
                            <div class="card-body text-center">
                                <h6>Producto ejemplo</h6>
                                <p><strong>Precio:</strong> $15.00</p>
                                <p><small>Categoría: Ejemplo</small></p>
                                <button class="btn btn-success btn-sm">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <!-- Productos dinámicos se insertan aquí -->
                </div>

            </div>
        </div>

        <!-- Columna derecha: Carrito de compras -->
        <div class="col-md-4">
            <div id="carrito_grid" class="p-3 border rounded bg-light shadow-sm position-relative" style="min-height: 500px; display: flex; flex-direction: column;">
                <h5 class="text-center mb-3">Carrito</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead class=" text-center">
                            <tr>
                                <th>Producto</th>
                                <th>Cant.</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaCarrito">
                            <tr>
                                <td colspan="5" class="py-3"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-end">
                            <h5>Subtotal: <label id="">$20.00</label></h5>
                            <h5>IGV: <label id="">$3.60</label></h5>
                            <h5>Total: <label id="">$23.60</label></h5>
                        </div>
                    </div>
                </div>

                <div class="position-absolute bottom-0 start-0 end-0 p-3 text-center" style="background-color: #f8f9fa; border-top: 1px solid #ccc;">
                    <button type="submit" class="btn btn-danger w-10">Realizar Venta</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Realizar venta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
<script src="<?php echo BASE_URL; ?>view/function/venta.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ListaProductosParaVenta();
        listarTemporal();
    });
</script>