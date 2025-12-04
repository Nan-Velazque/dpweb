<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HuberStore</title>

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
      background: linear-gradient(135deg, #0a0f1f, #051122, #02050a);
      overflow: hidden;
    }

    /* Fondo animado */
    .bg-circles span {
      position: absolute;
      border-radius: 50%;
      background: rgba(0, 170, 255, 0.12);
      animation: float 12s infinite ease-in-out;
    }

    .bg-circles span:nth-child(1) {
      width: 260px;
      height: 260px;
      top: -50px;
      left: -80px;
    }

    .bg-circles span:nth-child(2) {
      width: 180px;
      height: 180px;
      right: -40px;
      top: 120px;
    }

    .bg-circles span:nth-child(3) {
      width: 300px;
      height: 300px;
      bottom: -90px;
      left: 50%;
      transform: translateX(-50%);
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0) scale(1);
      }
      50% {
        transform: translateY(-30px) scale(1.05);
      }
    }

    /* Caja principal */
    .login-wrapper {
      width: 420px;
      padding: 40px;
      background: rgba(0, 0, 0, 0.45);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      border: 1px solid rgba(0, 170, 255, 0.3);
      box-shadow: 0 0 35px rgba(0, 170, 255, 0.2);
      animation: fadeIn 0.8s ease both;
      z-index: 10;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-wrapper h2 {
      text-align: center;
      color: #00ff15ff;
      margin-bottom: 25px;
      font-size: 2rem;
      letter-spacing: 2px;
      text-shadow: 0 0 10px #ea00ffff;
    }

    /* Campos */
    .field {
      margin-bottom: 22px;
      position: relative;
    }

    .field input {
      width: 100%;
      padding: 12px 15px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(0, 170, 255, 0.3);
      border-radius: 10px;
      color: #e9f6ff;
      font-size: 1rem;
      outline: none;
      transition: 0.3s;
    }

    .field input:focus {
      border-color: #00c3ff;
      background: rgba(0, 170, 255, 0.1);
      box-shadow: 0 0 12px rgba(0, 170, 255, 0.3);
    }

    .field label {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #aad7ff;
      pointer-events: none;
      transition: 0.3s;
      opacity: 0.7;
    }

    .field input:focus + label,
    .field input:valid + label {
      top: -8px;
      font-size: 0.75rem;
      color: #00c3ff;
      background: #051122;
      padding: 0 5px;
      opacity: 1;
    }

    /* Botón */
    .btn {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      border: none;
      background: linear-gradient(90deg, #00c6ff, #008dff);
      color: white;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      letter-spacing: 1px;
      transition: 0.3s;
    }

    .btn:hover {
      box-shadow: 0 0 15px #00baff;
      transform: scale(1.02);
    }

    /* Logo inferior */
    .login-logo {
      margin-top: 25px;
      text-align: center;
    }

    .login-logo img {
      width: 110px;
      filter: drop-shadow(0 0 10px #00c3ff);
    }

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

    <div class="login-logo">
      <img src="https://th.bing.com/th/id/OIP.Y-t7GEC9ubF9gNHPQDdrKgHaHa?w=203&h=202&c=7&r=0&o=7&cb=ucfimg2&pid=1.7&rm=3&ucfimg=1" alt="Logo">
    </div>
  </div>

  <script src="<?= BASE_URL; ?>view/function/user.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
