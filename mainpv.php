<?php
require_once "classes/ventas.php";
$model = new Ventas();
$sucursal = $_GET['suc'];
$_SESSION['suc'] = $sucursal;
$result = $model->existSuc($sucursal);
if ($result == 1) {
    session_start();
    $_SESSION['suc'] = $sucursal;
    $persons = $model->getAllPersonal();
    require_once "headv.php";
} else
    header('location:index.php');
?>
<link rel="stylesheet" href="css/esLogin.css">
<div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
        <h1 class="display-3">Ventas</h1>
        <p class="lead">Listos para Vender</p>
        <hr class="my-2">
        <div class="container-fluid">
            <div class="row">
                <?php while ($data = $persons->fetch_assoc()) { ?>
                    <div class="col-6 col-md-4 mb-5">
                        <div class="card" onclick="login('<?php echo $data['sexo'] ?>','<?php echo $data['usuario'] ?>')">
                            <div class="card-img">
                                <img src="media/images/<?php echo $data['sexo']; ?>.svg" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?php echo $data['nombre'] . " " . $data['app']; ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="login-container" id="Login">
    <label id="closeL" style="cursor: pointer; color: #fff; font-size: 25px; position: absolute; right: 20px;">
        <i class="fa fa-times-circle" aria-hidden="true"></i></label>
    <div class="login-img">
        <img src="media/images/F.svg" id="img-login" alt="">
    </div>
    <h1 class="title-log">VentaSoft (Caja)</h1>
    <hr class="separador">
    <form id="form-log" class="form-log" method="post" onsubmit="return logIn()">
        <label>Nombre de usuario:</label>
        <div class="campo-group">
            <span class="icon-campo">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            </span>
            <input type="text" name="us" id="us" class="campo" maxlength="60" placeholder="usuario@andic.org" readonly required>
        </div>

        <label>Contraseña:</label>
        <div class="campo-group">
            <span class="icon-campo">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <input type="password" name="pass" id="pass" class="campo" maxlength="20" placeholder="************" required>
        </div>

        <button type="submit" class="btn-start">Iniciar Sesión</button>
    </form>
    <h3 class="author-g">
        Copyright <a style="text-decoration: none; color: rgba(9,170,198,0.5);" href="https://lumega-mx.com/" target="_blank">LUMEGA-MX</a>
        <i class="fa fa-copyright" aria-hidden="true"></i>
        <span class="author">/ Diseño Mendoza G. Luis A.</span>
    </h3>
</div>

<?php require_once "footv.php" ?>
<script src="js/mainv.js"></script>