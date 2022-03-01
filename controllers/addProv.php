<?php
    require_once  "../classes/funciones.php";
    $model = new funciones();

    $action = $_POST['action'];

    if($action != ""){
        echo "El If";
    }
    else{
        echo $model->newProv($_POST);
    }
?>