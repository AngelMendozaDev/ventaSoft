<?php
    require_once "config.php";
    
class funciones extends config{
    public function logIn($object){
        $conexion = config::conexion();
        
        if($conexion == false)
            return 3;
        $query = $conexion->prepare("SELECT u.id_us, p.nombre, p.app FROM usuarios AS u INNER JOIN persona AS p ON p.id_p = u.id_us WHERE u.usuario = ? AND u.contra = ?");
        $query->bind_param('ss',$object['us'],$object['pass']);
        $query->execute();

        $result = $query->get_result();

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();

            $_SESSION['ID'] = $data['id_us'];
            $_SESSION['NameUs'] = $data['nombre']." ".$data['app'];
            return 1;
        }

        $query->close();

        return 2;
    }
}
?>