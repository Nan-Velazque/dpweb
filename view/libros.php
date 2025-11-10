<div class="container-fluid mt-4 row">
  <h2>Librería Virtual</h2>

  <!-- Sección de libros -->
  <div class="col-9">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Búsqueda de Libros</h5>
        <div class="row container-fluid" id="libros_venta">
          <!-- Los libros se cargarán dinámicamente desde JS -->
        </div>
      </div>
    </div>
  </div>

  <!-- Sección del carrito -->
  <div class="col-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Carrito de Compra</h5>
        <div class="row" style="min-height: 500px;">
          <div class="col-12">
            <table class="table">
              <thead>
                <tr>
                  <th>Libro</th>
                  <th>Cant.</th>
                  <th>Precio</th>
                  <th>Total</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody id="lista_carrito">
                <!-- Aquí se agregarán los libros seleccionados -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-end">
            <h5>Subtotal: <span id="subtotal">$0.00</span></h5>
            <h5>IGV (18%): <span id="igv">$0.00</span></h5>
            <h4>Total: <span id="total">$0.00</span></h4>
            <button class="btn btn-success mt-2" id="btn_realizar_venta">Finalizar Compra</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Enlace al JS -->
<script src="<?= BASE_URL ?>view/function/libros.js"></script>
