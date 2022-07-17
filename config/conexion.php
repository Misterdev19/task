<?php 
require_once "global.php";
$conexion = new mysqli(BD_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query( $conexion , 'SET NAME "'.DB_ENCODE.'"');

//si tenemos un posible error en la conexion de la base de datos 
if(mysqli_connect_error()){
    printf("Fallo conexion a la base de datos: %\n",mysqli_connect_error());
    print_r(mysqli_connect_error());
    exit();
}

if(!function_exists('ejecutarConsulta')){
    function ejecutarConsulta($sql){
        global $conexion;
        $query = $conexion->query($sql);
        return $query;
    }

    function ejecutarConsultaSimplementeFila($sql){
        global $conexion;
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }

    function ejecutarConsulta_retonarID($sql){
        global $conexion;
        $query = $conexion->query($sql);
        return $conexion->insert_id;
    }
    
    function limpiarCadena($str){
        global $conexion;
        $str = mysqli_real_escape_string($conexion,trim($str));
        return htmlspecialchars($str);

    }
}

?>