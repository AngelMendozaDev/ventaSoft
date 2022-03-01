<?php
require_once "../classes/funciones.php";
$modelo = new funciones();

$action = $_POST['action'];

if($action = "edit")
        echo $modelo->updateProd($_POST);
else
        echo $modelo->newProd($_POST);

?>