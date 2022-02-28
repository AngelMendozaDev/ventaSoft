<?php
 require_once "../classes/funciones.php";
 $model = new funciones();

//print_r($_POST);

 $accion = $_POST['Tipo'];

 switch($accion){
     case "gp" :
        echo $model->getProduct($_POST['codeBar']);
        break;
 }


?>