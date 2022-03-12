<?php
require_once "config.php";

class Ventas extends Config
{
    public function getUsers()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("SELECT * FROM getAllusers");
        $query->execute();
        $result = $query->get_result();
        $query->close();
        return $result;
    }
}
