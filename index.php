<?php
session_start();
$_SESSION['ID'] = "";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.:LUMEGA-MX:.</title>
    <link rel="icon" href="media/icons/Logo.png">
    <link rel="stylesheet" href="lib/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/esLogin.css">
</head>

<body>

    <div class="login-container">
        <div class="login-img">
            <img src="media/images/F.svg" alt="">
        </div>
        <h1 class="title-log">VentaSoft</h1>
        <hr class="separador">
        <form id="form-log" class="form-log" method="post" onsubmit="return logIn()">
            <label>Nombre de usuario:</label>
            <div class="campo-group">
                <span class="icon-campo">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </span>
                <input type="text" name="us" class="campo" maxlength="60" placeholder="usuario@andic.org" required>
            </div>

            <label>Contraseña:</label>
            <div class="campo-group">
                <span class="icon-campo">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
                <input type="password" name="pass" class="campo" maxlength="20" placeholder="************" required>
            </div>

            <button type="submit" class="btn-start">Iniciar Sesión</button>

            <h3 class="author-v" onclick="ventas()">
                Click aqui:
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                <span class="author">Ventas</span>
            </h3>
        </form>
        <h3 class="author-g">
            Copyright <a style="text-decoration: none; color: rgba(9,170,198,0.5);" href="https://lumega-mx.com/" target="_blank">LUMEGA-MX</a>
            <i class="fa fa-copyright" aria-hidden="true"></i>
            <span class="author">/ Diseño Mendoza G. Luis A.</span>
        </h3>
    </div>

    <!-- Scripts -->
    <script src="lib/jquery.js"></script>
    <script src="lib/bootstrap-5/js/bootstrap.min.js"></script>
    <script src="lib/fontawesome/js/all.min.js"></script>
    <script src="lib/sweetalert.js"></script>
    <script src="js/login.js"></script>
</body>

</html>