<?php
    require_once "../classes/funciones.php";
    $model = new funciones();
    print_r($_POST);

    $action = $_POST['action'];

    if($action == ""){
        echo $model->addNota($_POST);
    }

?>