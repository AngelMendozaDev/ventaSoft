<?php

use LDAP\Result;

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
        $query = $conexion->prepare("select * from getAllProd");
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
        $query = $conexion->prepare("select * from getAllProv");
        $query->execute();

        $result = $query->get_result();

        $query->close();

        return $result;
    }


    /*******************
     * Crud Productos
     */

    public function newProd($object, $edo)
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

        if ($response == 1 && $edo == 1) {
            $query = $conexion->prepare("CALL newProdMay(?,?,?)");
            $query->bind_param('sss', $object['codeBars'], $object['priceMay'], $object['cantMay']);
            $response = $query->execute();

            $query->close();
        }

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

        $query = $conexion->prepare('SELECT p.*, m.preciomay, m.cantMay FROM producto AS p LEFT JOIN prod_may AS m ON m.codigo = p.codigo WHERE p.codigo = ?');
        $query->bind_param('s', $code);
        $query->execute();

        $response = $query->get_result();

        $query->close();

        if ($response->num_rows > 0) {
            return json_encode($response->fetch_assoc());
        }
        return "err";
    }

    public function updateProd($object,$estado)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        $valorx = -1;
        $name = strtoupper($object['nameProduct']);
        $query = $conexion->prepare("CALL updateProd(?,?,?,?,?,?,?)");
        if($estado > 0)
            $query->bind_param('sssssss', $object['codeBars'], $name, $object['unidad'], $object['price'],$object['priceMay'],$object['cantMay'], $object['user']);
        else
            $query->bind_param('sssssss', $object['codeBars'], $name, $object['unidad'], $object['price'], $valorx,$valorx, $object['user']);

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
        $query->bind_param('ssss', $name, $empresa, $object['phone'], $object['user']);
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
        $query->bind_param('s', $prov);
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

    public function deleteProv($object)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare('Call deleteProv(?,?)');
        $query->bind_param('ss', $object['prov'], $object['user']);
        $result = $query->execute();

        $query->close();

        return $result;
    }


    /******************************+
     * CRUD NOTAS
     ***********************************************************************/

    public function getProvNames()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("select * from getAllProv");
        $query->execute();

        $result = $query->get_result();

        $query->close();

        while ($data = $result->fetch_assoc()) {
            $json[] = array(
                "id" => $data['id_prov'],
                "name" => $data['empresa']
            );
        }

        return json_encode($json);
    }

    public function getNotas()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("select * from getAllNotes");
        $query->execute();

        $result = $query->get_result();

        $query->close();

        return $result;
    }

    public function addNota($object)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;
        else if (self::cloneNote($object['n_nota']) == true)
            return "exist";

        $query = $conexion->prepare('call newNote(?,?,?)');
        $query->bind_param('sss', $object['user'], $object['n_nota'], $object['prov']);
        $result = $query->execute();
        $id = self::getLastId()['max(id_nota)'];
        $query->close();

        if ($result == 1) {
            $query = $conexion->prepare("call newNoteProd(?,?,?,?,?)");
            for ($i = 0; $i < count($object['codeNote']); $i++) {
                $query->bind_param('sssss', $id, $object['codeNote'][$i],$object['costProd'][$i], $object['cantProd'][$i], $object['user']);
                if ($query->execute() != 1)
                    return "err";
            }
            return "1";
        }
    }

    public function cloneNote($note)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("SELECT id_nota FROM notas WHERE n_nota = ?");
        $query->bind_param('s', $note);
        $query->execute();
        $result = $query->get_result();

        $query->close();

        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function getLastId()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("select * from lastNote");
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        $query->close();
        return $result;
    }

    public function getDetail($nota)
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("SELECT nn.n_nota, nn.prov, p.codigo, p.nombre, n.cantidad, p.unidad, p.precio FROM prod_nota AS n INNER JOIN producto AS p ON p.codigo = n.producto INNER JOIN notas AS nn ON nn.id_nota = n.nota WHERE n.nota = ?");
        $query->bind_param('s', $nota);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        while ($data = $result->fetch_assoc()) {
            $json[] = array(
                "code" => $data['codigo'],
                "name" => $data['nombre'],
                "cant" => $data['cantidad'] . "-" . $data['unidad'],
                "prov" => $data['prov'],
                "note" => $data['n_nota']
            );
        }

        return $json;
    }

    public function getAlmacen()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("SELECT * FROM getAlmacen");
        $query->execute();

        $result = $query->get_result();

        $query->close();

        return $result;
    }

    public function getFaltantes()
    {
        $conexion = config::conexion();

        if ($conexion == false)
            return 3;

        $query = $conexion->prepare("SELECT * FROM getFaltantes");
        $query->execute();

        $result = $query->get_result();

        $query->close();

        return $result;
    }
}
