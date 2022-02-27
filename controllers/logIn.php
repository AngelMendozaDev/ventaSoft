<?php
    session_start();
    require_once "../classes/funciones.php";
    $model = new funciones();

     echo $model->logIn($_POST);
?>