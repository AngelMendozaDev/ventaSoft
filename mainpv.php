<?php
require_once "classes/ventas.php";
$model = new Ventas();
$sucursal= $_GET['suc'];
echo $sucursal;

$result = $model->existSuc($sucursal);
if($result == 1){
    session_start();
    $_SESSION['suc'] = $sucursal;
    $persons;
}
else
    header('location:index.php');

?>

