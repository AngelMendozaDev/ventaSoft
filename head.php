<?php
session_start();

if (!$_SESSION['ID'] || $_SESSION['ID'] == "")
    header("location:index.php");
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VentaSoft-<?php echo $_SESSION['NameUs'] ?></title>
    <link rel="icon" href="media/icons/Logo.png">
    <link rel="stylesheet" href="lib/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="lib/datatable/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/menus.css">
</head>

<body>

    <!-- Menu Superior -->
    <div class="nav-cont">
        <div class="name-cont">
            <input type="checkbox" id="menu-status" hidden>
            <label for="menu-status"><i class="fas fa-bars icon-menu"></i></label>
            <label class="name-us">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
                <?php echo $_SESSION['NameUs']  ?>
            </label>
        </div>
        <div class="option-cont">
            <ul class="opciones">
                <li class="nav-option">
                    <a href="main.php">Home</a>
                </li>
                <li class="nav-option">
                    <a href="mainpv.php">Ventas</a>
                </li>
                <li class="nav-option">
                    <a href="controllers/close.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>


    <!--Menú principal -->
    <div class="menu-box" id="my-menu">
        <label class="exit-btn" for="menu-status">
            <i class="fa fa-times-circle" aria-hidden="true"></i>
        </label>
        <div class="menu-head">
            <div class="menu-img">
                <img src="media/images/<?php echo $_SESSION['Picture'] ?>.svg" alt="">
            </div>
            <br>
            <h6 class="name-menu"><?php echo $_SESSION['NameUs']  ?></h6>
        </div>
        <hr>
        <div class="menu-body">
            <div class="accordion" id="accordeon">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-box-open"></i>
                            &nbsp;
                            Productos
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordeon">
                        <div class="accordion-body">
                            <ul class="sub-menu">
                                <li class="sub-menu-item">
                                    <a href="products.php">
                                        <i class="fas fa-boxes"></i>
                                        &nbsp; Administrar Productos
                                    </a>
                                </li>
                                <li class="sub-menu-item">
                                    <a href="prov.php">
                                        <i class="fas fa-address-book"></i>
                                        &nbsp; Catalogo Proveedores
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fas fa-dolly-flatbed"></i>
                            &nbsp;
                            Inventarios
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordeon">
                        <div class="accordion-body">
                            <ul class="sub-menu">
                                <li class="sub-menu-item">
                                    <a href="inputs.php">
                                        <i class="fas fa-truck-loading"></i>
                                        &nbsp;
                                        Entradas
                                    </a>
                                </li>
                                <li class="sub-menu-item">
                                    <a href="almacen.php">
                                        <i class="fas fa-boxes"></i>
                                        &nbsp;
                                        Almacen
                                    </a>
                                </li>
                                <li class="sub-menu-item">
                                    <a href="faltantes.php">
                                    <i class="fas fa-exclamation-circle"></i>
                                        &nbsp;
                                        Faltantes
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFor">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFor" aria-expanded="false" aria-controls="collapseFor">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            &nbsp;
                            Personal
                        </button>
                    </h2>
                    <div id="collapseFor" class="accordion-collapse collapse" aria-labelledby="headingFor" data-bs-parent="#accordeon">
                        <div class="accordion-body">
                            <ul class="sub-menu">
                                <li class="sub-menu-item">
                                    <a href="personal.php">
                                        <i class="fas fa-id-card"></i>
                                        &nbsp;
                                        Administrar Personal
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fas fa-chart-line"></i>
                            &nbsp;
                            Reportes
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordeon">
                        <div class="accordion-body">
                            <ul class="sub-menu">
                                <li class="sub-menu-item">
                                    <a href="">
                                        <i class="fas fa-chart-line"></i>
                                        &nbsp;
                                        Generar Reporte
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin accordeon -->


        </div>
        <hr style="margin: auto; width: 50%;">
        <div class="menu-foot">
            <h3 class="author-g">
                Copyright TecNM Campus Tláhuac
                <i class="fa fa-copyright" aria-hidden="true"></i>
                <span class="author">/ Diseño Mendoza G. Luis A.</span>
            </h3>
        </div>
    </div>