<?php 
require_once "head.php";
require_once "classes/ventas.php";
$model = new Ventas();

$result = $model->getUsers();
?>

