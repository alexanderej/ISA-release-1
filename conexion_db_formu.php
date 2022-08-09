<?php
//configuracion para acceder a la base de datos
function conn(){
$hostname = "localhost";
$usuariodb = "root";
$passworddb = "";
$dbname = "proyectos_de_grado";

 // generando la conexion con el servidor
 $conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);
 return $conectar;

}

?>