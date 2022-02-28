<?php
    require_once "../classes/funciones.php";
    $modelo = new funciones();

    echo $modelo->newProd($_POST);

?>