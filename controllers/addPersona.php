<?php
    require_once "../classes/funciones.php";
    $model = new funciones();

    //print_r($_POST);

    $action = $_POST['action'];

    if($action == ""){
        echo $model->newPersonal($_POST);
    }
    else if($action == "edit"){
        echo $model->updatePersona($_POST);
    }
    else if( $action == "reset"){
        echo $model->updatePass($_POST);
    }

?>