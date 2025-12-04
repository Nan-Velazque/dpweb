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
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: radial-gradient(circle at top, #8b078bff, #000);
      background-color:  #2c777cff;
      background-size: cover;
      background-repeat: no-repeat;
      background-blend-mode: overlay;
      
    }

    .container {
      position: relative;
      width: 750px;
      height: 450px;
      border: 2px solid #00aaff;
      box-shadow: 0 0 25px #00aaff;
      border-radius: 20px;
      overflow: hidden;
      backdrop-filter: blur(6px);
    }

    .form-box {
      position: absolute;
      top: 0;
      left: 0;
      padding: 0 40px;
      width: 50%;
      height: 100%;
      display: flex;
      justify-content: center;
      flex-direction: column;
      background: rgba(0, 0, 0, 0.4);
    }

    .form-box h2 {
      font-size: 2rem;
      text-align: center;
      color: #00aaff;
      text-shadow: 0 0 8px #00aaff;
    }

    .input-box {
      position: relative;
      width: 100%;
      height: 50px;
      margin-top: 25px;
      color: white;
      font-size: 1.1rem;
    }

    .input-box input {
      width: 100%;
      height: 100%;
      background: transparent;
      border: none;
      outline: none;
      font-size: 1rem;
      color: #e6f7ff;
      border-bottom: 2px solid #00aaff;
      padding-right: 24px;
    }

    .input-box label {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      pointer-events: none;
      transition: .5s;
      color: #aaa;
    }

    .input-box input:focus~label,
    .input-box input:valid~label {
      top: -5px;
      color: #00aaff;
      font-size: 0.9rem;
    }

    .btn {
      position: relative;
      width: 100%;
      height: 45px;
      background: linear-gradient(90deg, #00aaff, #0077ff);
      border: none;
      border-radius: 40px;
      cursor: pointer;
      font-weight: 600;
      color: white;
      letter-spacing: 1px;
      transition: 0.3s;
      margin-top: 20px;
    }

    .btn:hover {
      box-shadow: 0 0 15px #00aaff;
      transform: scale(1.03);
    }

    .info-content {
      position: absolute;
      top: 0;
      right: 0;
      height: 100%;
      width: 50%;
      display: flex;
      justify-content: center;
      flex-direction: column;
      text-align: right;
      padding: 0 40px 60px 100px;
      color: #e6f7ff;
      background: linear-gradient(135deg, #002233, #001a26);
    }

    .info-content h2 {
      color: #00aaff;
      text-transform: uppercase;
      font-size: 2rem;
      line-height: 1.3;
      text-shadow: 0 0 10px #00aaff;
    }

    .info-content p {
      margin-top: 15px;
      font-size: 1rem;
      color: #b8dfff;
    }

    .info-content img {
      width: 160px;
      align-self: flex-end;
      margin-top: 20px;
      filter: drop-shadow(0 0 10px #00aaff);
    }

    .contai {
      position: absolute;
      right: 0;
      top: -5px;
      height: 600px;
      width: 850px;
      background: linear-gradient(450deg, #002233, #00aaff);
      transform: rotate(10deg) skewY(40deg);
      transform-origin: bottom right;
      opacity: 0.2;
    }
  </style>

  <script>
    const base_url = '<?= BASE_URL;?>';
  </script>
</head>

<body>
  <div class="container">
    <div class="contai"></div>
    <div class="form-box Login">
      <h2>Acceso HuberStore</h2>
      <form id="frm_login">

        <div class="input-box">
          <input type="text" id="username" name="username" required>
          <label for="">Usuario</label>
        </div>

        <div class="input-box">
          <input type="password" id="password" name="password" required>
          <label for="">Contraseña</label>
        </div>

        <div class="input-box">
          <button class="btn" type="button" onclick="iniciar_sesion();">Iniciar Sesión</button>
        </div>

      </form>
    </div>

    <div class="info-content">
      <h2>Bienvenido a HuberStore</h2>
      <p>Tu sistema de gestión para la venta de computadoras, accesorios y tecnología avanzada.</p>
      <img src="https://static.vecteezy.com/system/resources/previews/006/244/213/non_2x/initial-letter-m-b-logo-design-graphic-alphabet-symbol-for-corporate-business-identity-vector.jpg" alt="Logo HuberStore">
    </div>
  </div>

  <script src="<?= BASE_URL; ?>view/function/user.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
