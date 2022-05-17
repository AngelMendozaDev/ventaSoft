<?php 
    require_once "../classes/funciones.php";
    $model = new funciones();

    if($_POST['types'] == 'N'){
        echo $model->setMay($_POST);
    }
    else if($_POST['types'] == 'M'){
        echo $model->upMay($_POST);
    }

?>