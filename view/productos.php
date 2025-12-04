<?php
$base = defined('BASE_URL') ? BASE_URL : '/';
?>

<style>
    /* Contenedor para cada imagen de producto */
    .producto-img-container {
        border: 2px solid #d1c4e9;
        /* borde lila pálido */
        border-radius: 8px;
        padding: 6px;
        width: fit-content;
        /* ajusta al tamaño imagen */
        margin: 0 auto 10px auto;
        /* centrado y margen abajo */
        box-shadow: 0 0 6px rgba(209, 196, 233, 0.4);
        /* sombra suave */
        background-color: #faf8ff;
        transition: box-shadow 0.3s ease;
    }

    .producto-img-container img {
        display: block;
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .producto-img-container:hover {
        box-shadow: 0 0 12px rgba(209, 196, 233, 0.7);
    }
</style>

<div class="container py-3">

    <div class="row mb-3">
        <div class="col-4 mx-auto">
            <div class="border rounded shadow-sm bg-light">
                <input onkeyup="ListaProductosParaVenta();"
                    type="text" id="busqueda_venta" class="form-control" placeholder=" Escribe el nombre o código del producto...">
                <input type="hidden" id="id_producto_venta">
                <input type="hidden" id="producto_precio_venta">
                <input type="hidden" id="producto_cantidad_venta" value="1">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="row g-2" id="productos_venta">

                <!-- EJEMPLO ESTÁTICO de producto para mostrar la imagen dentro del contenedor -->
                <div class="col-md-4">
                    <div class="card p-2">
                        <div class="producto-img-container">
                            <img src="https://images.unsplash.com/photo-1606813909135-0e36269c67be?auto=format&fit=crop&w=400&q=80" alt="Producto ejemplo">
                        </div>
                        <div class="card-body text-center">
                            <h6>Nombre Producto</h6>
                            <p><strong>Precio:</strong> $15.00</p>
                            <p><small>Categoría: Ejemplo</small></p>
                            <button class="btn btn-success btn-sm">Agregar al carrito</button>
                        </div>
                    </div>
                </div>

                <!-- Aquí se agregan más productos dinámicamente -->
            </div>
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

    // EJEMPLO para agregar producto dinámico con contenedor de imagen
    function agregarProducto(producto) {
        const contenedor = document.getElementById('productos_venta');
        const productoHTML = `
        <div class="col-md-4">
          <div class="card p-2">
            <div class="producto-img-container">
              <img src="${producto.imagen}" alt="${producto.nombre}">
            </div>
            <div class="card-body text-center">
              <h6>${producto.nombre}</h6>
              <p><strong>Precio:</strong> $${producto.precio}</p>
              <p><small>Categoría: ${producto.categoria}</small></p>
              <button class="btn btn-success btn-sm">Agregar al carrito</button>
            </div>
          </div>
        </div>`;
        contenedor.insertAdjacentHTML('beforeend', productoHTML);
    }
</script>