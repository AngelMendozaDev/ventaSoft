<?php
require_once "../classes/funciones.php";
$modelo = new funciones();

$action = $_POST['action'];

if ($action == "edit") {
        $estado = count($_POST) > 6 ? 1 : 0;
        echo $modelo->updateProd($_POST,$estado);
} else {
        $estado = count($_POST) > 6 ? 1 : 0;
        echo $modelo->newProd($_POST, $estado);
}
