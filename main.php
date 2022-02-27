<?php require_once "head.php"; ?>
<link rel="stylesheet" href="css/main.css">

<div class="contenedor">
    <h1 class="title">Bienvenidos a ANDICApp</h1>
    <h4 class="subtitle">¡Hola <?php echo $_SESSION['NameUs']; ?> !</h4>
    <h5 class="fecha">Marzo 2022</h5>
    <hr class="separador">
    <p class="texto">
        El sistema fue logrado con la colaboracion del TecNM campus Tláhuac
        y ANDIC A.C. que con ayuda de los alumnos de la institucion se logro
        dicho proyecto.
    </p>

    <center>
        <a class="myButton">
            Ver Mas <i class="fa fa-eye" aria-hidden="true"></i>
        </a>
    </center>

</div>

<?php require_once "foot.php" ?>