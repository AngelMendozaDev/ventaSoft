<?php 
    require_once "../classes/ventas.php";
    $model = new Ventas();

    //print_r($_POST);
    echo($model->setVenta($_POST));
?>