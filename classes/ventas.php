<?php
require_once "config.php";

class Ventas extends Config
{
    public function existSuc($suc)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("SELECT * FROM sucursal WHERE id_suc = ?");
        $query->bind_param('s',$suc);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        if($result->num_rows > 0){
            return 1;
        }

        return 0;
    }

    public function getAllPersonal()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("select * from getAllCajas");
        $query->execute();
        $result = $query->get_result();

        $query->close();

        return $result;
    }
}
