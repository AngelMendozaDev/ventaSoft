<?php
    require_once  "../classes/funciones.php";
    $model = new funciones();

    $action = $_POST['action'];

    if($action != "update"){
        echo( $model->newProv($_POST));
    }
    else{
        echo $model->updateProv($_POST);
    }
?>