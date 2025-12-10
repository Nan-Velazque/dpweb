<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velzqu3</title>

  <style>
    
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }

  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: #f3e7ff; /* Lila pastel suave */
  }

  .login-wrapper {
    width: 380px;
    padding: 30px;
    background: white;
    border-radius: 12px;
    border: 2px solid #d6b7ff; /* Lila suave */
  }

  h2 {
    text-align: center;
    color: #a463ff; /* Lila más fuerte */
    margin-bottom: 20px;
  }

  .field {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
  }

  .field label {
    font-size: 14px;
    color: #6a4d8a;
    margin-bottom: 5px;
  }

  .field input {
    padding: 10px;
    border: 1px solid #c9a8ff;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
  }

  .field input:focus {
    border-color: #a463ff;
  }

  .btn {
    width: 100%;
    padding: 10px;
    border: none;
    background: #b98bff;
    color: white;
    font-size: 15px;
    border-radius: 8px;
    cursor: pointer;
  }

  .btn:hover {
    background: #a463ff;
  }

  .login-logo {
    margin-top: 20px;
    text-align: center;
  }

  .login-logo img {
    width: 90px;
  }
</style>


  </style>

  <script>
    const base_url = '<?= BASE_URL;?>';
  </script>
</head>

<body>

  <!-- Fondo animado -->
  <div class="bg-circles">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <div class="login-wrapper">
    <h2>Tienda</h2>

    <form id="frm_login">

      <div class="field">
        <input type="text" id="nro_identidad" name="nro_identidad" required>
        <label>Usuario</label>
      </div>

      <div class="field">
        <input type="password" id="password" name="password" required>
        <label>Contraseña</label>
      </div>

      <button class="btn" type="button" onclick="iniciar_sesion();">
        Iniciar Sesión
      </button>
    </form>

    
  </div>

  <script src="<?= BASE_URL; ?>view/function/user.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
