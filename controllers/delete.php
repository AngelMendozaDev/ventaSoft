<?php 
    require_once "../classes/funciones.php";
    $model = new funciones();


    echo $model->deleteMay($_POST['code']);

?>