<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 w-100">

    <!-- Header pálido -->
    <div class="card-header text-white text-center fs-4 fw-bold" 
         style="background: #c9b7ff;">
      Lista de Proveedores
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-striped table-hover text-center align-middle"
               style="border: none !important;">
          
          <thead style="background:#e6dcff; color:#5e4a80;">
            <tr>
              <th style="border: none;">Nro</th>
              <th style="border: none;">DNI</th>
              <th style="border: none;">Nombres y Apellidos</th>
              <th style="border: none;">Correo</th>
              <th style="border: none;">Rol</th>
              <th style="border: none;">Estado</th>
              <th style="border: none;">Acciones</th>
            </tr>
          </thead>

          <tbody id="content_proveedor">
            <!-- Filas dinámicas generadas con JavaScript -->
          </tbody>

        </table>

      </div>
    </div>

  </div>
</div>

<script src="<?= BASE_URL ?>view/function/proveedor.js"></script>
