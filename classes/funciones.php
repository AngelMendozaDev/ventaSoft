<?php
require_once "config.php";

class funciones extends config
{
    public function logIn($object)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        $query = $conexion->prepare("SELECT u.id_us, p.nombre, p.app FROM usuarios AS u INNER JOIN persona AS p ON p.id_p = u.id_us WHERE u.usuario = ? AND u.contra = ?");
        $query->bind_param('ss', $object['us'], $object['pass']);
        $query->execute();

        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            $_SESSION['ID'] = $data['id_us'];
            $_SESSION['NameUs'] = $data['nombre'] . " " . $data['app'];
            return 1;
        }

        $query->close();

        return 2;
    }

    public function getProductos()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        $query = $conexion->prepare("select * from allProducts");
        $query->execute();

        $result = $query->get_result();

        $query->close();

        return $result;
    }

    public function getProvs()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        $query = $conexion->prepare("select * from allProv");
        $query->execute();

        $result = $query->get_result();

        $query->close();

        return $result;
    }


    /*******************
     * Crud Productos
     */

    public function newProd($object)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        else if (self::existe($object['codeBars']) == 1) {
            return "exist";
        }

        $name = strtoupper($object['nameProduct']);

        $query = $conexion->prepare("CALL newProd(?,?,?,?,?)");
        $query->bind_param('sssss', $object['codeBars'], $name, $object['unidad'], $object['price'], $object['user']);
        $response = $query->execute();

        $query->close();

        return $response;
    }

    public function existe($codigo)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("SELECT codigo FROM producto WHERE codigo = ?");
        $query->bind_param('s', $codigo);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        if ($result->num_rows > 0) {
            return 1;
        }
        return 0;
    }

    public function getProduct($code)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare('SELECT * FROM producto WHERE codigo = ?');
        $query->bind_param('s', $code);
        $query->execute();

        $response = $query->get_result();

        $query->close();

        if ($response->num_rows > 0) {
            return json_encode($response->fetch_assoc());
        }
        return "err";
    }

    public function updateProd($object)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $name = strtoupper($object['nameProduct']);

        $query = $conexion->prepare("CALL updateProd(?,?,?,?,?)");
        $query->bind_param('sssss', $object['codeBars'], $name, $object['unidad'], $object['price'], $object['user']);
        $response = $query->execute();

        $query->close();

        return $response;
    }

    /**************************************
     * *****CRUD PROVEEDORES
     ******************/

    public function newProv($object)
    {
        $name = strtoupper($object['nombreP']);
        $empresa = strtoupper($object['empresa']);
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        else if (self::existeProv($object['phone']) == 1) {
            return "exist";
        }

        $query = $conexion->prepare("CALL newProv(?,?,?,?)");
        $query->bind_param('ssss',$name,$empresa,$object['phone'],$object['user']);
        $response = $query->execute();
        
        $query->close();

        return $response;
    }

    public function existeProv($phone)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("SELECT numero FROM proveedores WHERE numero = ?");
        $query->bind_param('s', $phone);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        if ($result->num_rows > 0) {
            return 1;
        }
        return 0;
    }

    public function getProv($prov)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        $query = $conexion->prepare("SELECT * FROM proveedores WHERE id_prov = ?");
        $query->bind_param('s',$prov);
        $query->execute();

        $result = $query->get_result()->fetch_assoc();

        $query->close();

        return json_encode($result);
    }

    public function updateProv($object)
    {
        $name = strtoupper($object['nombreP']);
        $empresa = strtoupper($object['empresa']);

        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("CALL updateProv(?,?,?,?,?)");
        $query->bind_param('sssss', $object['idProv'], $name, $empresa, $object['phone'], $object['user']);
        $response = $query->execute();

        $query->close();

        return $response;
    }

    public function deleteProv($object){
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        
        $query = $conexion->prepare('Call deleteProv(?,?,?)');
        $query->bind_param('sss',$object['prov'],$object['phone'],$object['user']);
        $result = $query->execute();

        $query->close();

        return $result;


    }

}
