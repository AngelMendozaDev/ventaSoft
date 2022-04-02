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
            return -1;

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

        return $ticket;
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

    function getVenta($ticket){
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        
        $query = $conexion->prepare("SELECT p.nombre, p.app, v.fecha_v, v.total FROM persona AS p INNER JOIN ventas AS v ON p.id_p = v.usuario WHERE v.folio_v = ?");
        $query->bind_param('s',$ticket);
        $query->execute();
        $result = $query->get_result();

        $query->close();

        return $result;
    }

    function getDetailVenta($ticket){
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        $query = $conexion->prepare("SELECT vp.producto, p.nombre, vp.precio_v, vp.cantidad_v FROM venta_prod AS vp INNER JOIN producto AS p ON p.codigo = vp.producto WHERE vp.ticket = ? ");
        $query->bind_param('s',$ticket);
        $query->execute();
        $result = $query->get_result();

        $query->close();

        return $result;
    }
}
