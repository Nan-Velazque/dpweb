<?php
$base = defined('BASE_URL') ? BASE_URL : '/';
?>

<div class="container py-3">

    <div class="row mb-3">
        <div class="col-4 mx-auto">
            <div class="border rounded shadow-sm bg-light">
                <input onkeyup="ListaProductosParaVenta();"
                    type="text" id="busqueda_venta" class="form-control" placeholder=" Escribe el nombre o código del producto...">
                    <input type="hidden" id="id_producto_venta">
                    <input type="hidden" id="producto_precio_venta">
                    <!-- se sabe que el valor ´por defecto es 1-->
                    <input type="hidden" id="producto_cantidad_venta" value="1">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="row g-2" id="productos_venta"></div>
        </div>

        <div class="col-md-4">
            <div id="carrito_grid" class="p-3 border rounded bg-light shadow-sm position-relative" style="min-height: 500px; display: flex; flex-direction: column;">

                <h5 class="text-center mb-3">🛒 Carrito de Compras</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead class="table-primary text-center">
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
                                <td colspan="5" class="py-3">
                                    01101000 01110101 01100010 01100101 01110010
                                </td>
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
                    <button type="submit" class="btn btn-danger w-10">Pagar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
<script src="<?php echo BASE_URL; ?>view/function/venta.js"></script>
<script>
    let input = document.getElementById("busqueda_venta");
    input.addEventListener('keydown', event => {
        if (event.key == 'Enter') {
            agregar_producto_temporal();
        }
    })
</script>