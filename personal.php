<?php require_once "head.php";?>
<link rel="stylesheet" href=".css">

<?php
require_once "classes/funciones.php";
$model = new funciones();
$model->getAllPersonal();
?>


<div class="cont-g">
    <h1>Control general de Productos</h1>

    <div class="alert alert-success" id="descrip" role="alert">
        <span class="btn-close" onclick="closeAlert()" style="cursor: pointer;"><i class="fas fa-times"></i></span>
        Dentro de este apartado podras, dar de alta, modificar o eliminar todo lo referente a
        los productos que maneja en su inventario.
    </div>



</div>

<?php require_once "foot.php"; ?>