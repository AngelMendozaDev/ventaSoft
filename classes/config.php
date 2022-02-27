<?php 
class Config{
    public function conexion(){
        $host = "localhost";
        $user = "root";
        $pass = "LuisA5841@&";
        $db = "ventaSoft";
        $conexion=null;

        try{
        $conexion = mysqli_connect($host,$user,$pass,$db);
        }catch(mysqli_sql_exception $e){
            $e."";
        }

        if(!$conexion){
            return false;
        }
        mysqli_set_charset($conexion,"utf8");
        return $conexion;

    }
}
?>