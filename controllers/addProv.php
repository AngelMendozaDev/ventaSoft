<?php
    require_once  "../classes/funciones.php";
    $model = new funciones();

    $action = $_POST['action'];

    
    if($action == "delProv"){
        echo $model->deleteProv($_POST);
    }
    else if($action == ""){
        echo( $model->newProv($_POST));
    }
    else{
        echo $model->updateProv($_POST);
    }
   //print_r($_POST);
?>