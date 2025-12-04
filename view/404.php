<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>failed</title>
    <style>
        body {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;

        }

        .error {
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            flex-direction: column;
        }

        .tex {
            font-size: 2rem;
            margin: 6px 0;
        }

        .boton {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            color: white;
            background: blue;
            padding: 15px;
            border-radius: 25px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
            transition: .4s;
        }

        .btn:hover {
            transform: translateY(-6px);
            box-shadow: 0 .5px 10px blue;
        }
    </style>
</head>

<body>
    <div class="error">
        <p class="tex">ERROR</p>
        <h1 class="tex">404</h1>
        <p class="tex">PAGE NOT FOUND</p>
        <br>
        <div class="boton">
            <button type="button" class="btn" href="login.php">Volver al Inicio</button>
        </div>
    </div>

</body>
</html>