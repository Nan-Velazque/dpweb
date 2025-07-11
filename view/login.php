<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Creativo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(120deg, #a6c0fe, #f68084);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px 30px;
      border-radius: 20px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
      width: 350px;
      position: relative;
      color: #fff;
      animation: floatIn 1.2s ease-out;
    }

    @keyframes floatIn {
      0% {
        transform: translateY(-50px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: 600;
    }

    .input-field {
      position: relative;
      margin-bottom: 25px;
    }

    .input-field input {
      width: 100%;
      padding: 12px 45px 12px 40px;
      border: none;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      transition: 0.3s;
    }

    .input-field input::placeholder {
      color: #eee;
    }

    .input-field input:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.4);
    }

    .input-field i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #fff;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      background: #fff;
      color: #333;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    .login-btn:hover {
      background: #f1f1f1;
      transform: scale(1.02);
    }

    .extra-text {
      text-align: center;
      margin-top: 20px;
      font-size: 0.9em;
      color: #eee;
    }

    .extra-text a {
      color: #fff;
      text-decoration: underline;
    }
  </style>
  <script src="https://kit.fontawesome.com/a2e8a4d44b.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="login-container">
    <h2>Bienvenido 🌟</h2>
    <form action="procesar_login.php" method="POST">
      <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" name="usuario" placeholder="Usuario" required>
      </div>
      <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Contraseña" required>
      </div>
      <button type="submit" class="login-btn">Iniciar Sesión</button>
    </form>
    <div class="extra-text">
      ¿No tienes cuenta? <a href="#">Regístrate</a>
    </div>
  </div>
</body>
</html>
