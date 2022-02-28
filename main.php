<?php require_once "head.php"; ?>
<link rel="stylesheet" href="css/main.css">

<div class="contenedor">
    <h1 class="title">Bienvenidos a VentaSoft</h1>
    <h4 class="subtitle">¡Hola <?php echo $_SESSION['NameUs']; ?> !</h4>
    <h5 class="fecha">Marzo 2022</h5>
    <hr class="separador">
    <p class="texto">
        Sistema punto de venta, desarrollado por LUMEGA-MX ESTUDIOS, si quieres ver mas sobre nuestros productos o servicios.
    </p>

    <center>
        <a class="myButton">
            Ver Mas <i class="fa fa-eye" aria-hidden="true"></i>
        </a>
    </center>

</div>

<?php require_once "foot.php" ?>