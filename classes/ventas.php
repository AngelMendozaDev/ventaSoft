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
        $query->bind_param('s', $suc);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        if ($result->num_rows > 0) {
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

    public function setVenta($objects)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("call newVenta1(?,?)");
        $query->bind_param('ss', $objects['user'], $objects['total']);
        $result = $query->execute();

        $query->close();

        $ticket = self::getLastTicket()['max(folio_v)'];

        for ($i = 0; $i < count($objects['code']); $i++) {
            $query = $conexion->prepare("call newVentaProd1(?,?,?,?,?)");
            $query->bind_param('sssss', $ticket, $objects['code'][$i], $objects['preciov'][$i], $objects['cant'][$i], $objects['user']);
            $result = $query->execute();
        }

        return $result;
    }

    public function getLastTicket()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        $query = $conexion->prepare("SELECT * FROM lastVenta");
        $query->execute();
        $result = $query->get_result()->fetch_assoc();

        $query->close();

        return $result;
    }
}
