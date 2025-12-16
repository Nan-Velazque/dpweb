<div class="container-fluid mt-4 row">

    <div class="col-7">
        <div class="card" style="background-color: transparent;">

            <div class="card-body row">
                <h5 class="card-title col-md-5">Busqueda de Productos</h5>
                <div class="col-md-7">
                    <input type="text" class="form-control col-md-12" placeholder="buscar producto por codigo o nombre" id="busqueda_venta" onkeyup="ListaProductosParaVenta();">
                    <input type="hidden" id="id_producto_venta">
                    <input type="hidden" id="producto_precio_venta">
                    <input type="hidden" id="producto_cantidad_venta" value="1">
                </div>
                <br>
                <br>
                <br>
                <div class="row container-fluid" id="productos_venta">
                    <!--<div class="card m-2 col-3">
                        <div class="card-body">
                            <img src="https://www.agenciaeplus.com.br/wp-content/uploads/2021/12/pagina-de-produto.jpg" alt="" width="100%" height="150px">
                            <p class="card-text">Descripcion del producto</p>
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Compra</h5>
                <div class="row" style="min-height: auto;">
                    <div class="col-12">
                        <table class="table-responsive table table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cant.</th>
                                    <th>P. Unit.</th>
                                    <th>SubTotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="lista_compra">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <h4>Subtotal : <label id="subtotal_general"></label></h4>
                        <h4>Igv : <label id="igv_general"></label></h4>
                        <h4>Total : <label id="total"></label></h4>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Realizar Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Venta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_venta">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="cliente_dni" class="form-label">DNI del Cliente</label>
                            <input type="text" class="form-control" id="cliente_dni" name="cliente_dni" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11">
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary mt-4" onclick="buscar_cliente_venta();">Buscar Cliente</button>
                        </div>
                        <div class="col-md-12">
                            <label for="cliente_nombre" class="form-label">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" readonly>
                            <input type="hidden" class="form-control" id="id_cliente_venta">
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_venta">fecha de venta</label>
                            <input type="datetime" class="form-control" id="fecha_venta" name="fecha_venta" value="<?= date('Y-m-d H:i') ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrarVenta();">Registrar Venta</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_URL ?>view/function/producto.js"></script>
<script src="<?= BASE_URL ?>view/function/venta.js"></script>

<script>
    let input = document.getElementById("busqueda_venta");
    input.addEventListener('keydown', (event) => {
        if (event.key == 'Enter') {
            agregar_producto_temporal();
        }
    });
    listar_temporales();
    act_subt_general();
</script>